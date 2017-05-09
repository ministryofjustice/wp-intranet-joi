<!-- Top -->
<div class="row">
  <!-- Header -->
  <div class="column grid_15" id="header">
    <div class="row">
      <!-- Logo -->
      <div class="column grid_9"><a href="/"><img src="<?= get_template_directory_uri(); ?>/images/logo/new-intranet-logo-sm.png" alt="Judicial Office Intranet" title="Judicial Office Intranet" /></a></div>
      <!-- Logo end -->
      <div class="column grid_2"></div>
      <!-- Search -->
      <div class="column grid_4" id="search">
        <?php get_search_form(); ?>
      </div>
      <!-- Search end -->
    </div>
  </div>
  <!-- Header end -->

  <!-- Top navigation -->
  <div class="column grid_15" id="navigation">
    <?php
    $args = array(
      'container_id'    => 'cssmenu',
      'menu_class'      => '',
      'menu'            => 'Primary Navigation',
    );
    wp_nav_menu($args);
    ?>
    <?php /*<div id="cssmenu">
      <ul>
        <li><a href="/index">Home</a></li>
        <li>
          <a href="/contacts/">Contacts</a>
          <ul>
            <li><a href="/contacts/ceo">Chief Executive's Office</a></li>
            <li><a href="/contacts/hr-judiciary/index">HR Judiciary</a></li>
            <li><a href="/contacts/jc/index">Judicial College</a></li>
            <li><a href="/contacts/jcio/index">Judicial Conduct Investigations Office</a></li>
            <li><a href="/contacts/private-offices/index">Judicial Private Offices</a></li>
            <li><a href="/contacts/cccs/index">Communications</a></li>
            <li><a href="/contacts/bus-support">Business Support</a></li>
            <li><a href="/contacts/jud-international-team">International Team</a></li>
            <li><a href="/contacts/reg-sec/index">Regional Secretariats</a> </li>
            <li><a href="/contacts/guide">Key contacts</a></li>
            <li><a href="/structure/organograms/index">Organisation charts</a></li>
          </ul>
        </li>
        <li><a href="/about-us" class="active">About us</a>   </li>
        <li>
          <a href="/working_in/">Working in JO</a>
          <ul>
            <li><a href="/working_in/ci/">Continuous Improvement (CI)</a></li>
            <li><a href="/working_in/eoi">Expressions of interest</a></li>
            <li><a href="/working_in/facilities">Facilities</a></li>
            <li><a href="/working_in/finance">Finance</a></li>
            <li><a href="/working_in/flexi-working-proj-management/">Flexible Assignment Working & Project Management</a></li>
            <li><a href="/working_in/forms">Forms</a></li>
            <li><a href="/working_in/hs">H &amp; S</a></li>
            <li><a href="/working_in/hr">HR</a></li>
            <li><a href="/working_in/jo-induction">Induction</a></li>
            <li><a href="/working_in/information-assurance">Information Assurance</a></li>
            <li><a href="/working_in/it-housekeeping">IT</a></li>
            <li><a href="/working_in/l-and-d/l-d">Learning and development</a></li>
            <li><a href="/working_in/reference">Reference</a></li>
            <li><a href="/working_in/skills-exp/">Skills register</a></li>
            <li><a href="/working_in/travel">Travel</a></li>
          </ul>
        </li>
        <li>
          <a href="/working_with/">Working with the judiciary</a>
          <ul>
            <li><a href="/working_with/comms">Communicating with the judiciary</a></li>
            <li><a href="/working_with/letters">Drafting  letters for the senior judiciary</a></li>
            <li><a href="/working_with/sub-memo">Submissions and memos</a></li>
            <li><a href="/working_with/arrangements">Arrangements when out of the office</a></li>
            <li><a href="/working_with/jud-gov/jud-gov-homepage">Judicial Governance</a></li>
            <li><a href="/working_with/standardised-briefings">Standardised Briefings and Itineraries</a></li>
            <li><a href="/working_with/guidance_researchers">Guidance for researchers</a></li>
          </ul>
        </li>
        <li><a href="/calendar/">Events calendar</a></li>
        <li><a href="/judicial_database/">Judicial database</a></li>
        <li><a href="/links">Useful links</a></li>
      </ul>
    </div>*/?>
  </div>
  <!-- Top navigation end -->
</div>
<!-- Top end -->
