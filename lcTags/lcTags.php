<?php
/*
Plugin Name: LCTags
Plugin URI: http://www.lutincapuche.com/plugin-lctags/
Version: 1.0.1
Description: A nice flash presentation of your tags.
Author: Celine Mornet
Author URI: http://www.lutincapuche.com/
*/

if(preg_match('#' . basename(__FILE__) . '#', $_SERVER['PHP_SELF'])) { die('You are not allowed to call this page directly.'); }
define('LCTAGS_VERSION', '1.0.3');
define('LCTAGS_LANG', 'fr_FR');

include_once "admin/admin.php";
require_once "class.php";

// i18n support testing
load_textdomain('lctags', ABSPATH . 'wp-content/plugins/lcTags/languages/lctags_'.FLOG_MAKER_LANG.'.mo');

?>