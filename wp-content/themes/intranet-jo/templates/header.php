 <div id="wrapper">
 <!-- Top -->
     <div class="row">    
      <!-- Header -->
      <div class="column grid_15" id="header">
        <div class="row">         
          <!-- Logo -->
          <div class="column grid_9"><a href="index.htm"><img src="<?php echo content_url(); ?>/uploads/new-intranet-logo-sm.png" border="0" alt="Judicial Office Intranet" /></a></div>
          <!-- Logo end -->            
          <!-- Search -->
          <div class="column grid_4" id="search">
            <div class="search-top" id="int">
              <form action="http://intranet.justice.gsi.gov.uk/searchJudicial.do" method="get" name="query" id="query">
                <label for="search" class="hidden-text">Search:</label>
                <input id="search" name="query" class="searchbox" size="30" type="text">
                <input id="submit" value="Go" class="searchbutton" title="Search" type="submit">
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
                <input id="forename" name="forename" type="text" class="searchbox" size="12" value="First name" onclick="this.value = '';" />
                <label for="surname" class="hidden-text">Surname</label>
                <input id="surname" name="surname" type="text" class="searchbox" size="13" value="Last name" onclick="this.value = '';" />
           <input type="submit" class="searchbutton" id="submit1" title="Search" value="Go" />
                Search:
                <input name="searchtype1" type="radio" id="intranet1" value="intranet" />
                <label for="intranet1">intranet</label>
                <input name="searchtype1" type="radio" id="people1" value="peoplefinder" checked="checked" />
                <label for="people1">peopleFinder</label>
              </form>
            </div>
          </div>
          <!-- Search end --> 
        </div>
      </div>
      <!-- Header end --> 
      
      <!-- Top navigation -->


    
    <!-- Main -->
 <div class="column grid_15" id="navigation">

<?php /*$defaults = array(

  'container_id'    => 'cssmenu',
  'menu_class'      => '',
  'menu'            => 'Primary Navigation',
);

wp_nav_menu($defaults); */?>
<div id="cssmenu">
 <ul>
<li><a href="<?= get_site_url() ?>/">Home</a></li>
<li><a href="<?= get_site_url() ?>/contacts/">Contacts</a>
<ul>
<li><a href="<?= get_site_url() ?>/contacts/ceo/">Chief Executive's Office</a></li>
<li><a href="<?= get_site_url() ?>/contacts/hr-judiciary/">HR Judiciary</a></li>
<li><a href="<?= get_site_url() ?>/contacts/jc/">Judicial College</a></li>
<li><a href="<?= get_site_url() ?>/contacts/jcio/">Judicial Conduct Investigations Office</a></li>
<li><a href="<?= get_site_url() ?>/contacts/private-offices/">Judicial Private Offices</a></li>
<li><a href="<?= get_site_url() ?>/contacts/cccs/">Communications</a></li>
<li><a href="<?= get_site_url() ?>/contacts/bus-support/">Business Support</a></li>
<li><a href="<?= get_site_url() ?>/contacts/jud-international-team/">International Team</a></li>
<li><a href="<?= get_site_url() ?>/contacts/reg-sec/">Regional Secretariats</a> </li>
<li><a href="<?= get_site_url() ?>/contacts/guide/">Key contacts</a></li>
<li><a href="<?= get_site_url() ?>/about-us/structure/organograms/">Organisation charts</a></li>
</ul>
</li>   
<li><a href="<?= get_site_url() ?>/about-us/">About us</a>
  <ul>
<li><a href="<?= get_site_url() ?>/about-us/structure/">Structure</a></li>
<li><a href="<?= get_site_url() ?>/about-us/jillians-blog/">Jillian's blog</a></li>
<li><a href="<?= get_site_url() ?>/about-us/options-for-change/">Options for Change</a></li>
<li><a href="<?= get_site_url() ?>/about-us/business-plan/">Business Plan</a></li>
<li><a href="<?= get_site_url() ?>/about-us/leadership/">Leadership framework</a></li>
<li><a href="<?= get_site_url() ?>/about-us/statement-exp/">Statement of expectations</a></li>
<li><a href="<?= get_site_url() ?>/about-us/management_boards/">Management Board</a></li>
<li><a href="<?= get_site_url() ?>/about-us/ses/">Staff Engagement</a></li> 
<li><a href="<?= get_site_url() ?>/about-us/icg/">Internal Communications Group</a></li>
<li><a href="<?= get_site_url() ?>/about-us/jo-story/">JO Story</a></li>
<li><a href="<?= get_site_url() ?>/about-us/60seconds/">60 seconds with...</a></li>
      </ul>
    </li>
          <li><a href="<?= get_site_url() ?>/working_in/">Working in JO</a>     
          <ul>
        <li><a href="<?= get_site_url() ?>/working_in/ci/">Continuous Improvement (CI)</a></li> 
<li><a href="<?= get_site_url() ?>/working_in/eoi/">Expressions of interest</a></li> 
  <li><a href="<?= get_site_url() ?>/working_in/facilities/">Facilities</a></li>
    <li><a href="<?= get_site_url() ?>/working_in/finance/">Finance</a></li>
        <li><a href="<?= get_site_url() ?>/working_in/flexi-working-proj-management/">Flexible Assignment Working & Project Management</a></li>
    <li><a href="<?= get_site_url() ?>/working_in/forms/">Forms</a></li>
     <li><a href="<?= get_site_url() ?>/working_in/hs/">H & S</a></li>
          <li><a href="<?= get_site_url() ?>/working_in/hr/">HR</a></li>
           <li><a href="<?= get_site_url() ?>/working_in/jo-induction/">Induction</a></li>
           <li><a href="<?= get_site_url() ?>/working_in/information-assurance/">Information Assurance</a></li>
<li><a href="<?= get_site_url() ?>/working_in/it-housekeeping/">IT</a></li>
     <li><a href="working_in/l-and-d/l-d/">Learning and development</a></li>
     <li><a href="<?= get_site_url() ?>/working_in/reference/">Reference</a></li>
 <li><a href="<?= get_site_url() ?>/working_in/skills-exp/">Skills register</a></li>
     <li><a href="<?= get_site_url() ?>/working_in/travel/">Travel</a></li>
          </ul>
        </li>
          <li><a href="<?= get_site_url() ?>/working_with/">Working with the judiciary</a>
          <ul>
        <li><a href="<?= get_site_url() ?>/working_with/comms/">Communicating with the judiciary</a></li>
<li><a href="<?= get_site_url() ?>/working_with/letters/">Drafting  letters for the senior judiciary</a></li>
<li><a href="<?= get_site_url() ?>/working_with/sub-memo/">Submissions and memos</a></li>
<li><a href="<?= get_site_url() ?>/working_with/arrangements/">Arrangements when out of the office</a></li>
<li><a href="<?= get_site_url() ?>/working_with/jud-gov/jud-gov-homepage/">Judicial Governance</a></li>
<li><a href="<?= get_site_url() ?>/working_with/standardised-briefings/">Standardised Briefings and Itineraries</a></li>
<li><a href="<?= get_site_url() ?>/working_with/guidance_researchers/">Guidance for researchers</a></li>
</ul>
</li>
<li><a href="<?= get_site_url() ?>/calendar/">Events calendar</a></li>
<li><a href="<?= get_site_url() ?>/judicial_database/">Judicial database</a></li>
<li><a href="<?= get_site_url() ?>/links/">Useful links</a></li>
</ul> 
  </div>
</div> 

      <!-- Top navigation end --> 
    </div>
    <!-- Top end --> 
