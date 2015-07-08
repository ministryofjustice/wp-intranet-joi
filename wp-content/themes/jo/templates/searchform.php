<div class="search-top" id="int">
  <form action="<?= esc_url(home_url('/')); ?>" method="get" name="query" id="query">
    <label for="search" class="hidden-text">Search:</label>
    <input id="search" name="s" class="searchbox" size="25" type="text">
    <input id="submit" value="Go" class="searchbutton" title="Search" type="submit"><br><br>
    Search:
    <input name="searchtype" id="intranet" value="intranet" checked="checked" type="radio">
    <label for="intranet">intranet</label>
    <input name="searchtype" id="people" value="peoplefinder" type="radio">
    <label for="people">peopleFinder</label>
  </form>
</div>
<div class="search-people" id="pf">
  <form action="http://intranet-applications.dca.gsi.gov.uk/peopleFinder/UserSearch2.do" method="get" name="searchform" id="searchform">
    <label for="forename" class="hidden-text">Forename</label>
    <input id="forename" name="forename" type="text" class="searchbox" size="10" value="First name" onclick="this.value = '';" />
    <label for="surname" class="hidden-text">Surname</label>
    <input id="surname" name="surname" type="text" class="searchbox" size="10" value="Last name" onclick="this.value = '';" />
    <input type="submit" class="searchbutton" id="submit1" title="Search" value="Go" />
    <br>Search:
    <input name="searchtype1" type="radio" id="intranet1" value="intranet" />
    <label for="intranet1">intranet</label>
    <input name="searchtype1" type="radio" id="people1" value="peoplefinder" checked="checked" />
    <label for="people1">peopleFinder</label>
  </form>
</div>
