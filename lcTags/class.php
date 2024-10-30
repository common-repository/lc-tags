<?php

if(preg_match('#' . basename(__FILE__) . '#', $_SERVER['PHP_SELF'])) { die('You are not allowed to call this page directly.'); }

class lctags
{
 /************************************************************************************************************************************************************************************************************************************************************************************************************
  * lctags()
  * 
  * This constructor funtion does the following:
  * - Sets the location
  * - Caches the settings
  * - Loads and corrects the query variables
  * - Stores some SQL snippets
  * - Decides the permalink status
  * - Takes the location and loads the appropriate data and/or redirects the user
  */
  
  function lctags($autoload = true)
  {
    global $wpdb, $wp, $table_prefix, $wp_rewrite;
    
    $acceptable_places = array('index','lctags');
    
    $this->location = in_array(get_query_var('lctags_where'), $acceptable_places) ? get_query_var('lctags_where') : 'index';
    
    $this->error = false;
    
    $this->settings = array();
    $this->settings = get_option('lctags');

	$this->query_vars->editinfo = stripslashes(trim(get_query_var('lctags_editinfo')));
	
    $this->sql = new stdClass;    
    $this->sql->infos = "SELECT * FROM {$table_prefix}lctags";       
	
    if($autoload == true) {
      switch($this->location){
        case 'lcTag':
          $this->load_lcTag_info();
          break;       
        
        
		case 'editinfos':
          if(!is_user_logged_in()) {
            $this->error = __('You are not logged in!', 'flog-maker');
            return false;
          }                      
                     
          if(isset($_POST['lctags_do_edit_info'])){  			
			$this->update_infos($_POST['gammeColor']);			
			$this->update_infos($_POST['bgcolor']);
			$this->update_infos($_POST['buttonColorOn']);
			$this->update_infos($_POST['buttonColorOff']);
			$this->update_infos($_POST['sizeMax']);
			$this->update_infos($_POST['sizeMin']);
			$this->update_infos($_POST['clickActif']);
          }          
          break;       
		  
        default:
          $this->load_lcTag_info();
          break;
        
      } // end of switch
    } // end of autoload check
  }
  
 /************************************************************************************************************************************************************************************************************************************************************************************************************/
 
  function parse_arguments($arg_string, $defaults) {
    $decoded = array();
    $return = array();
    
    parse_str($arg_string, $decoded);
    
    foreach($defaults as $key => $value)    {
      $return[$key] = isset($decoded[$key]) ? $decoded[$key] : $value;
    }
    
    return $return;
  }
  
 
  
 /************************************************************************************************************************************************************************************************************************************************************************************************************/
   function load_lcTag_info()  {
    global $wpdb, $table_prefix;
    
    $this->lcTag_info = array();
    $result = $wpdb->get_results($this->sql->infos, ARRAY_A);
    
    if(!$result && !is_array($result) && !is_object($result))    {
      $this->error = __('Impossible d\'afficher les parametres.', 'flog-maker');
      return false;
    }
    
    foreach($result as $row)    {
      $return_obj = new stdClass;
      foreach($row as $key => $value)      {
        $return_obj->$key = $value;
      }
      $this->lcTag_info[] = $return_obj;
    }
    
    return $this->lcTag_info;
  }
  
/************************************************************************************************************************************************************************************************************************************************************************************************************
 
  
 /************************************************************************************************************************************************************************************************************************************************************************************************************/
  
  function build_url($arg_string = '')  {
    global $wp_rewrite, $userdata;
    
    $default_args = array('type' => null);
    $args = $this->parse_arguments($arg_string, $default_args);
    
    if($args['type'] == null) { return false; }
    
    if($args['page'])    {
      $page_part = $this->use_permalinks ? "page-{$args['page']}/" : "&lctags_page={$args['page']}";
    }    else    {
      $page_part = '';
    }    
    $page_root = $wp_rewrite->using_permalinks() ? get_bloginfo('home').'/'.$wp_rewrite->root."{$this->settings['forum_page_slug']}/" : get_bloginfo('home')."/index.php?pagename={$this->settings['forum_page_slug']}";
     
  }  

 /************************************************************************************************************************************************************************************************************************************************************************************************************/
 
 
  function is_index()     { return ($this->location == 'index'   );}

  
 /************************************************************************************************************************************************************************************************************************************************************************************************************/
  
  function error_occured()     { return (  (bool)$this->error); }
	  
}

?>