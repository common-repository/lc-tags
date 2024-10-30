<?php
  //require_once (ABSPATH . WPINC . '/rss-functions.php');
  
  //add_action('admin_menu', 'lctags_admin_menu_populate');
  //include ABSPATH . 'wp-content/plugins/lctags/languages/' . $ddsg_lang_file . '.php';
 
 /************************************************************************/

  include 'infos.php';

	/* 
	 * Add options page
	 */
	function lctags_add_option_pages() {
		if (function_exists('add_options_page')) {
			add_options_page('lctags', 'LcTags', 8, __FILE__, 'lctags_admin_infos');
		}
	}
	add_action('admin_menu', 'lctags_add_option_pages');
 
 
  
  /**************************************************************************/

  add_action('admin_head', 'lctags_admin_linkback_style');

  function lctags_admin_linkback_style(){
    //if(!current_user_can('edit_others_posts'))
    //{
      echo '<style type="text/css">#lctag_linkback { position: absolute; right: 1em; top: 3em; color: #fff; font-size: .9em; } #lctag_linkback a, #lctag_linkback a:hover {color: #ffffff} </style>';
    //}
  }

  /**************************************************************************/

  add_action('admin_footer', 'lctags_admin_linkback_message');

  function lctags_admin_linkback_message(){
    global $wp_rewrite;
    $options = get_option('lctags');

  }
  
  /************************************************************************/
  
  
  add_action('deactivate_lctags/lctags.php', 'lctags_admin_deactivation');
  
  function lctags_admin_deactivation(){
    global $wpdb, $table_prefix;
    $options = get_option('lctags');
    $wpdb->query("DELETE FROM {$table_prefix}posts WHERE post_name = '".$wpdb->escape($options['lctag_page_slug'])."' LIMIT 1");
  }
  
  /************************************************************************/
  
  add_action('activate_lctags/lctags.php', 'lctags_admin_installer');
  
  function lctags_admin_installer(){
    global $wpdb, $table_prefix, $wp_rewrite;
    
    $default_options = array
    (
      'lctag_page_slug' => 'lctag',
      'edit_duration' => "30",
      'LCTAGS_VERSION' => LCTAGS_VERSION,          
    );
    
    $options = get_option('lctags');
    
    if(!is_array($options)){
      $type = 'install';
      $options = $default_options;
    }elseif(version_compare($options['LCTAGS_VERSION'], LCTAGS_VERSION, "<")){
      $type = 'upgrade';
      foreach($default_options as $key => $value){
        if(!isset($options[$key])) { $options[$key] = $value; }
      }
      unset($options['LCTAGS_VERSION']);
      $options['LCTAGS_VERSION'] = LCTAGS_VERSION;
      update_option('lctags', $options);
    } else{
      $type = 'reactivate';
    }
    
    if($type == 'install' || $type == 'upgrade'){
      $mysql_version = $wpdb->get_var("SELECT VERSION()");
      $parts = explode('.', $mysql_version);
      $engine_string = ($parts[0] < 5) ? 'TYPE' : 'ENGINE';
      
      require_once(ABSPATH . 'wp-admin/upgrade-functions.php');
      
      dbDelta(
       "CREATE TABLE {$table_prefix}lctags 
        (
          id int(11) unsigned NOT NULL auto_increment,
          bgcolor varchar(50) NOT NULL,
          buttonColorOff varchar(50) NOT NULL,
		  buttonColorOn varchar(50),		
		  gammeColor int(11),
		  sizeMin int(11),
		  sizeMax int(11),
		  clickActif int(11),
          PRIMARY KEY  (id)
        ) {$engine_string}=MyISAM;"
      );      
    }    
       
	$wpdb->query("INSERT INTO {$table_prefix}lctags (bgcolor,buttonColorOff,buttonColorOn,gammeColor,sizeMin,sizeMax,clickActif) VALUES ('000000','FFFFFF','000000',2,100,200,1) ");
		
    $options['lctag_page_slug'] = $name;
    update_option('lctags', $options);
    $wp_rewrite->flush_rules();
  }

?>