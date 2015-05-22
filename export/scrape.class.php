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
   * Constructor
   * @param string    $csv
   * @param string    $json
   */
  public function __construct($csv, $json)
  {
    $this->csv = $csv;
    $this->json = $json;
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
        $scrape[] = $result;
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
      die("The scrape does not contain any posts/pages...<br>");
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
          if($post_type == "page") {
            $scrape = [
              "post_title" => $this->postTitle($crawler),
              "post_content" => $this->postContent($crawler),
              "post_name" => $this->postName($url),
              "post_date" => $this->postDate($crawler),
              "post_parent" => $this->postParent($url),
              "post_type" => $post_type,
              "url" => $url
            ];
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
      die("Fatal Error");
    }
  }

  /**
   * Scrape the post title
   */
  protected function postTitle($crawler)
  {
    $crawler->filter('.column.grid_12 h1, .column.grid_9 h1, .column.grid_12 h2, .column.grid_9 h2')->each(function ($node, $i) use (&$post_title) {
      $post_title = $node->text();
    });
    return $post_title;
  }

  /**
   * Scrape the post content
   */
  protected function postContent($crawler)
  {
    $crawler->filter('.column.grid_12, .column.grid_9')->each(function ($node, $i) use (&$post_content) {
      $post_content = $node->html();
      $post_content = preg_replace("/<!--.*-->/", "", $post_content);
      $post_content = preg_replace_callback(
        "#(<\s*a\s+[^>]*href\s*=\s*[\"'])(?!http|mailto|javascript|\#)([^\"'>]+)([\"'>]+)#",
        function($matches) {
          $matches[2] = str_replace(".htm", "", $matches[2]);
          $matches[2] = str_replace("docs/", "wp-content/uploads/", $matches[2]);
          if(is_numeric($matches[2])) {
            $matches[2] .= "-2";
          }
          return $matches[1] . '/' . $matches[2] . $matches[3];
        },
        $post_content
      );
      // Update internal links
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
   * Scrape a post date
   */
  protected function postDate($crawler)
  {
    $crawler->filter('.FR')->each(function ($node, $i) use (&$post_date) {
      preg_match("/\d{2}-[a-zA-z]{3}-\d{4}/", $node->text(), $matches);
      if(!empty($matches[0])) {
        $date = DateTime::createFromFormat('d-M-Y', $matches[0]);
        $post_date = $date->format('Y-m-d H:i:s');
      }
    });
    return $post_date;
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
      wp_insert_post( $post, $error );

      if(!empty($error)) {
        die("There was an error importing the posts.");
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

$export = new ScrapeSite("internal_html.csv", "export.json");
