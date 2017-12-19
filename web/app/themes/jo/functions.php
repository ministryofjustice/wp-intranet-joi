<?php
/**
 * Detect if we're running under WP-CLI.
 *
 * @return boolean
 */
function is_wp_cli() {
    return defined('WP_CLI') && WP_CLI;
}

/**
 * Convenience method to determine if we're on a login page.
 *
 * @return bool
 */
function is_login_page() {
    return stripos($_SERVER["SCRIPT_NAME"], '/wp/') !== false;
}

/**
 * Redirect all users to the new intranet who are:
 *   - not logged in
 *   - are not on the login page
 *   - and are not accessing the site from the wp cli
 */
function redirect_to_new_site() {
    if ( !is_user_logged_in() && !is_login_page() && !is_wp_cli() ) {
        wp_redirect( 'https://intranet.justice.gov.uk/?agency=judicial-office', 301);
        exit;
    }
}
add_action('init', __NAMESPACE__ . '\\redirect_to_new_site');


/**
 * Sage includes
 *
 * The $sage_includes array determines the code library included in your theme.
 * Add or remove files to the array as needed. Supports child theme overrides.
 *
 * Please note that missing files will produce a fatal error.
 *
 * @link https://github.com/roots/sage/pull/1042
 */
$sage_includes = array(
  'lib/utils.php',                 // Utility functions
  'lib/init.php',                  // Initial theme setup and constants
  'lib/wrapper.php',               // Theme wrapper class
  'lib/conditional-tag-check.php', // ConditionalTagCheck class
  'lib/config.php',                // Configuration
  'lib/assets.php',                // Scripts and stylesheets
  'lib/titles.php',                // Page titles
  'lib/cpt.php',
  'lib/extras.php',                // Custom functions
);

foreach ($sage_includes as $file) {
  if (!$filepath = locate_template($file)) {
    trigger_error(sprintf(__('Error locating %s for inclusion', 'sage'), $file), E_USER_ERROR);
  }

  require_once $filepath;
}
unset($file, $filepath);
