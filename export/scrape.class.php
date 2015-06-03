<?php header("Content-Type: text/html; charset=UTF-8"); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
</head>
<body>
<?php

require('vendor/autoload.php');
require($_SERVER['DOCUMENT_ROOT'] . '/wp-load.php');
use Goutte\Client;

/**
 * ExportSite
 *
 * This class will crawl all specified links of a given website
 * and export/import for WordPress
 *
 * @package ExportSite
 * @author  Toby Schrapel <https://github.com/schrapel>
 * @version 1.0.0
 */
class ScrapeSite
{
  /**
   * The CSV files used to import URLs
   * @var string
   */
  protected $csv;
  /**
   * The JSON file used to export data
   * @var string
   */
  protected $json;
  /**
   * Should we import the JSON?
   * @var boolean
   */
  protected $import;

  /**
   * Constructor
   * @param string    $csv
   * @param string    $json
   */
  public function __construct($csv, $json, $import)
  {
    $this->csv = $csv;
    $this->json = $json;
    $this->import = $import;
    $this->scrape($this->loadUrls());
    $this->import();
  }

  /**
   * Initiates the scrape of URLs
   * @param array    $urls
   */
  protected function scrape($urls)
  {
    $scrape = [];
    foreach($urls as $url) {
      $result = $this->crawl($url);
      if(!empty($result)) {
        if (is_array($result[0])) {
          $scrape = array_merge($scrape, $result);
        } else {
          $scrape[] = $result;
        }
      }
    }

    if(count($urls) != count($scrape)) {
      print "The URL count does not equal the scrape count...<br>";
    }

    if(!empty($scrape)) {
      usort($scrape, function($a, $b) {
        return strcmp($a['post_parent'], $b['post_parent']);
      });
      foreach ($scrape as $index => $array) {
        if(empty($array['post_parent'])) {
          $scrape = array($index => $scrape[$index]) + $scrape;
        }
      }
      $this->saveJson($scrape);
    } else {
      print "The scrape does not contain any posts/pages...<br>";
      die();
    }
  }

  /**
   * Load URLs from CSV file
   */
  protected function loadUrls()
  {
    $csv_file = fopen($this->csv, "r");
    $csv_contents = fread($csv_file, filesize($this->csv));
    $urls = explode("\n", $csv_contents);
    print "URLs loaded successfully...<br>";
    return $urls;
  }

  /**
   * Saves scraped content to JSON file
   * @param array     $scrape
   */
  protected function saveJson($scrape)
  {
    $json_file = fopen("export.json", "w");
    fwrite($json_file, json_encode($scrape));
    fclose($json_file);
    print "JSON has been saved successfully...<br>";
  }

  /**
   * Crawl a individual page
   * @param string    $url
   */
  protected function crawl($url)
  {
    try {
      $client = new Client();
      $client->followRedirects();

      $crawler = $client->request('GET', $url);
      $status_code = $client->getResponse()->getStatus();

      if($status_code === 200) {
        $content_type = $client->getResponse()->getHeader('Content-Type');
        if (strpos($content_type, 'text/html') !== false) {

          $post_type = $this->postType($url);
          //$this->checkSidebar($crawler, $url);
          if($post_type == "page") {
            $parent = $this->postParent($url);
            $scrape = [
              "post_title" => $this->postTitle($crawler, $parent),
              "post_content" => $this->postContent($crawler, $post_type),
              "post_name" => $this->postName($url),
              "post_date" => $this->pageDate($crawler),
              "post_parent" => $parent,
              "post_type" => $post_type
            ];
          } elseif($post_type == "archive") {
            //$this->getExternal($crawler);
            $scrape = $this->newsArchive($crawler);
          } elseif($post_type == "post") {
            $scrape = [
              "post_title" => $this->postTitle($crawler, $parent),
              "post_content" => $this->postContent($crawler, $post_type),
              "post_name" => $this->postName($url),
              "post_date" => $this->postDate($crawler),
              "post_type" => $post_type,
            ];
          } elseif($post_type == "events") {
            // Let's just do this manually...
          }

          if(!empty($scrape)) {
            print "Saved: " . $url . "<br>";
            return $scrape;
          } else {
            print "Error Saving: " . $url . "<br>";
          }
        }
      }
    } catch(Exception $e) {
      print "Fatal Error";
      die();
    }
  }

  /**
   * Check for sidebar widget
   * @param DomCrawler $crawler
   */
  protected function checkSidebar($crawler, $url)
  {
    $crawler->filter('#right')->each(function ($node, $i) use (&$url) {
      print "Sidebar on: " . $url . "<br>";
    });
  }

  /**
   * Get external news posts
   * @param DomCrawler $crawler
   */
  protected function getExternal($crawler)
  {
    $crawler->filter('#wide h2 a')->each(function ($node, $i) {
      $url = $node->attr('href');
      preg_match("/http(s|):\/\/.*/ /*", $url, $matches);
      preg_match("/news\/.*/ /*", $url, $matches2);
      if(!empty($matches) || empty($matches2)) {
        print $node->text() . "&nbsp; &nbsp; &nbsp; " . $url . "<br>";
      }
    });
  }

  /**
   * Scrape the news archive posts
   * @param DomCrawler $crawler
   */
  protected function newsArchive($crawler)
  {
    $crawler->filter('#wide')->each(function ($node, $i) use (&$scrape) {
      $html = str_replace("<hr />", "<hr>", $node->html());
      $posts = explode("<hr>", $html);
      array_shift($posts);

      $scrape = [];
      foreach ($posts as $post) {
        preg_match("/<h2>\X+<\/h2>/", $post, $titles);
        $title = "";
        if(!empty($titles[0])) {
          $title = trim(strip_tags($titles[0]));
          $title = preg_replace('/\s+/', ' ', $title);
          $title = str_replace("&amp;", "&", $title);
        }

        $date = "";
        preg_match("/<strong>\d{1,2}\s+[A-Za-z]+\s+\d{4}<\/strong>/", $post, $dates);
        if(!empty($dates[0])) {
          $date = trim(strip_tags($dates[0]));
          $date = DateTime::createFromFormat('j F Y', $date);
          $date = $date->format('Y-m-d H:i:s');
        }

        $post = preg_replace("/<h2>\X+<\/h2>/", "", $post);
        $post = preg_replace("/<p><strong>\d{1,2}\s+[A-Za-z]+\s+\d{4}<\/strong><\/p>/", "", $post);
        $post = preg_replace("/<!--.*-->/", "", $post);

        $scrape[] = [
          "post_title" => $title,
          "post_content" => $post,
          "post_date" => $date,
          "post_type" => "post"
        ];
      }
    });
    return $scrape;
  }

  /**
   * Scrape the post title
   */
  protected function postTitle($crawler, $parent)
  {
    $crawler->filter('#mid h1, #wide h1, #mid h2, #wide h2, #mid h3, #wide h3')->each(function ($node, $i) use (&$post_title) {
      preg_match("/<!-- InstanceBeginEditable name=\"(titleofpage|page-header|main-header|pagetitle)\" -->/", $node->html(), $matches);
      if(!empty($matches) && !empty($node->text())) {
        $post_title = $node->text();
      } elseif($node->text() == "60 seconds with...") {
        $post_title = "60 seconds with...";
      }
    });
    return $post_title;
  }

  /**
   * Scrape the post content
   */
  protected function postContent($crawler, $post_type)
  {
    $crawler->filter('#mid, #wide')->each(function ($node, $i) use (&$post_content, &$post_type) {
      $post_content = $node->html();

      $start = '<!-- InstanceBeginEditable name="content" -->';
      $end = '<!-- InstanceEndEditable -->';

      $post_content = stristr($post_content, $start);
      $dapost_contentta = substr($post_content, strlen($start));
      $stop = stripos($post_content, $end);
      $post_content = substr($post_content, 0, $stop);
      $post_content = preg_replace("/<!--.*-->/", "", $post_content);
      $post_content = preg_replace("/http:\/\/intranet.justice.gsi.gov.uk\/joew/", "/", $post_content);

      $post_content = preg_replace_callback(
        "#(<\s*a\s+[^>]*href\s*=\s*[\"'])(?!http|mailto|javascript|\#)([^\"'>]+)([\"'>]+)#",
        function($matches) {
          $matches[2] = str_replace(".htm", "", $matches[2]);
          $matches[2] = preg_replace("/(..\/|\/|)+docs\//", "/wp-content/uploads/", $matches[2]);
          $matches[2] = preg_replace("/(..\/|\/|)+images\//", "/wp-content/uploads/", $matches[2]);
          if(is_numeric($matches[2])) {
            $matches[2] .= "-2";
          }
          return $matches[1] . $matches[2] . $matches[3];
        },
        $post_content
      );

      $post_content = preg_replace_callback(
        "#(<\s*img\s+[^>]*src\s*=\s*[\"'])(?!http|mailto|javascript|\#)([^\"'>]+)([\"'>]+)#",
        function($matches) {
          $matches[2] = preg_replace("/(..\/|\/|)+images\//", "/wp-content/uploads/", $matches[2]);
          return $matches[1] . $matches[2] . $matches[3];
        },
        $post_content
      );

      if($post_type == "post") {
        $post_content = preg_replace("/<p><strong>([0-9]{1,2} [A-Za-z]+ [0-9]{4})<\/strong><\/p>/", "", $post_content);
      }

      $post_content = iconv("UTF-8", "ISO-8859-1//TRANSLIT", $post_content);
      $post_content = mb_convert_encoding($post_content, 'HTML-ENTITIES', 'iso-8859-1');
      $post_content = utf8_encode($post_content);

    });
    return $post_content;
  }

  /**
   * Calculate the post type
   */
  protected function postType($url)
  {
    if(strpos($url, '/news/')) {
      return "post";
    } elseif(strpos($url, 'archived-news')) {
      return "archive";
    } elseif(strpos($url, 'calendar')) {
      return "events";
    } else {
      return "page";
    }
  }

  /**
   * Scrape a post parent
   */
  protected function postParent($url)
  {
    $parsed_url = parse_url($url);
    $path = str_replace("/export/dump/joew/", "", $parsed_url['path']);
    $directories = explode('/', $path);
    if(count($directories) > 1) {
      if(end($directories) == "index.htm" ||
         end($directories) == "l-d.htm" ||
         end($directories) == "jud-gov-homepage.htm" ||
         end($directories) == "bite-size-learning.htm" ||
         end($directories) == "l-d-project-team.htm") {
        unset($directories[count($directories)-1]);
        unset($directories[count($directories)-1]);
        $slug = implode("/", $directories);
      } else {
        unset($directories[count($directories)-1]);
      }
      $slug = implode("/", $directories);
      return $slug;
    }
  }

  /**
   * Scrape a post slug
   */
  protected function postName($url)
  {
    $parsed_url = parse_url($url);
    $path = $parsed_url['path'];
    $directories = explode('/', $path);
    $file_name = str_replace(".htm", "", end($directories));
    $up_level = $directories[count($directories)-2];

    if(strpos($path, "/joew/index.htm")) {
      $post_name = "index";
    } elseif($file_name == "index" || $file_name == "l-d" || $file_name == "jud-gov-homepage" || $file_name == "l-d-project-team") {
      $post_name = $up_level;
    } else {
      $post_name = $file_name;
    }
    if(is_numeric($matches[2])) {
      $matches[2] .= "-2";
    }
    return $post_name;
  }

  /**
   * Scrape a page date
   */
  protected function pageDate($crawler)
  {
    $crawler->filter('.FR')->each(function ($node, $i) use (&$page_date) {
      preg_match("/\d{2}-[a-zA-z]{3}-\d{4}/", "19-Mar-2015", $matches);
      if(!empty($matches[0])) {
        $date = DateTime::createFromFormat('d-M-Y', $matches[0]);
        $page_date = $date->format('Y-m-d H:i:s');
      }
    });
    return $page_date;
  }

  /**
   * Scrape a post date
   */
  protected function postDate($crawler)
  {
    $post_date = $crawler->filter('#wide p strong')->each(function ($node, $i) {
      preg_match("/^[0-9]{1,2}\s+[A-Za-z]+\s+[0-9]{4}/", $node->text(), $matches);
      if(!empty($matches[0])) {
        $matches[0] = preg_replace('/\s+/', ' ', $matches[0]);
        $matches[0] = str_replace("Febrary", "February", $matches[0]);
        $date = DateTime::createFromFormat('j F Y', $matches[0]);
        return $date->format('Y-m-d H:i:s');
      }
    });
    return $post_date[0];
  }

  /**
   * Import JSON file into WordPress
   */
  protected function import()
  {
    $json = file_get_contents( $this->json );
    $pages = json_decode( $json );
    foreach ($pages as $page) {
      $post = array(
        'post_content' => $page->post_content,
        'post_title' => $page->post_title,
        'post_name' => $page->post_name,
        'post_date' => $page->post_date,
        'post_date_gmt' => $page->post_date,
        'post_type' => $page->post_type,
        'post_status' => 'publish',
        'post_parent' => $this->getID($page->post_parent),
      );
      if($this->import == true) {
        wp_insert_post( $post, $error );
      }

      if(!empty($error)) {
        print "There was an error importing the posts.";
        die();
      }
    }
  }

  protected function getID($slug) {
    if(empty($slug)) {
      return;
    }
    $page = get_page_by_path($slug);
    if ($page) {
      return $page->ID;
    } else {
      print "Failed to find Slug: " . $slug . "<br>";
      return null;
    }
  }
}

$export = new ScrapeSite("internal_html.csv", "export.json", false);
?>
</body>
</html>
