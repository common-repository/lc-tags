<?php

if(preg_match('#' . basename(__FILE__) . '#', $_SERVER['PHP_SELF'])) { die('You are not allowed to call this page directly.'); }

function lctags_admin_infos(){    
    global $wpdb, $table_prefix;
	  
    if(isset($_POST['update'])){
        check_admin_referer('update-configuration_lctag');  
		$update_result = $wpdb->query("UPDATE {$table_prefix}lctags SET bgcolor= '".$wpdb->escape(stripslashes($_POST['bgcolor']))."',buttonColorOff='".$wpdb->escape(stripslashes($_POST['buttonColorOff']))."',buttonColorOn='".$wpdb->escape(stripslashes($_POST['buttonColorOn']))."',gammeColor=".$wpdb->escape(stripslashes($_POST['gammeColor'])).",sizeMin=".$wpdb->escape(stripslashes($_POST['sizeMin'])).",sizeMax=".$wpdb->escape(stripslashes($_POST['sizeMax'])).",clickActif=".$wpdb->escape(stripslashes($_POST['clickActif']))."");
		if($update_result){
			echo '<div id="message" class="updated fade-ffff00"><p>'.__('Param&egrave;tres enregistr&eacute;s.', 'lctags').'</p></div>';
		}else{
			echo '<div id="message" class="updated fade-ff0000"><p>'.__('Param&egrave;tres non enregistr&eacute;s.', 'lctags').'</p></div>';
		}
	}	
	
	$options = $wpdb->get_row("SELECT * FROM {$table_prefix}lctags LIMIT 1");       
    ?>
	 <div class="wrap">	
      <form method="post" action="<?php echo $_SERVER['REQUEST_URI'] ?>"> 
        <?php if (function_exists('wp_nonce_field')) { wp_nonce_field('update-configuration_lctag'); } ?>
       
			 <h2><?php _e('LCTAGS :: Param&egrave;tres', 'lctags') ?></h2>		
			<br />
			<?php _e('LCTAGS :: Pour plus d\'informations, n\'h&eacute;sitez pas &agrave; consulter ', 'lctags') ?><a href="http://www.lutincapuche.com" title="lutinCapuche">www.lutincapuche.com</a><br />
			<br /><br />
		   <table width="100%" cellspacing="2" cellpadding="5" class="editform"> 			
              <tr valign="top"> 
                <th width="33%" scope="row">
                  <label for="bgcolor"><?php _e('Url du nuage de tags :', 'lctag') ?></label>
                </th> 
                <td>
                  <a href="../wp-lctags/" title="Nuage de tag" target="_blank"><?php _e('cliquez ici', 'lctag') ?></a><br />
                </td>
              </tr>
			  <tr valign="top"> 
                <th width="33%" scope="row">
                  <label for="bgcolor"><?php _e('Couleur de fond :', 'lctag') ?></label>
                </th> 
                <td>
                  #<input name="bgcolor" type="text" id="bgcolor" style="text-align: left" value="<?php echo format_to_edit($options->bgcolor) ?>" size="50" /> <br />
                </td>
              </tr>
			  <tr valign="top"> 
                <th width="33%" scope="row">
                  <label for="buttonColorOff"><?php _e('Couleur des boutons inactifs :', 'lctag') ?></label>
                </th> 
                <td>
                  #<input name="buttonColorOff" type="text" id="buttonColorOff" style="text-align: left" value="<?php echo format_to_edit($options->buttonColorOff) ?>" size="50" /> <br />
                </td>
              </tr>
			  <tr valign="top"> 
                <th width="33%" scope="row">
                  <label for="buttonColorOn"><?php _e('Couleur des boutons actifs :', 'lctag') ?></label>
                </th> 
                <td>
                  #<input name="buttonColorOn" type="text" id="buttonColorOn" style="text-align: left" value="<?php echo format_to_edit($options->buttonColorOn) ?>" size="50" /> <br />
                </td>
              </tr>
			  <tr valign="top"> 
                <th width="33%" scope="row">
                  <label for="gammeColor"><?php _e('Gamme de couleurs des mots :', 'lctag') ?></label>
                </th> 
                <td>
                  <input name="gammeColor" type="radio" id="gammeColor" style="text-align: left" value="0"  <?php if (format_to_edit($options->gammeColor)==0){ echo "checked";} ?>  /> <img src="../wp-content/plugins/lcTags/img/gamme1.jpg" alt="Gamme 1"/><br />
                  <input name="gammeColor" type="radio" id="gammeColor" style="text-align: left" value="1" <?php if (format_to_edit($options->gammeColor)==1){ echo "checked";} ?>/> <img src="../wp-content/plugins/lcTags/img/gamme2.jpg" alt="Gamme 2"/><br />
                  <input name="gammeColor" type="radio" id="gammeColor" style="text-align: left" value="2" <?php if (format_to_edit($options->gammeColor)==2){ echo "checked";} ?>/> <img src="../wp-content/plugins/lcTags/img/gamme3.jpg" alt="Gamme 3"/><br />
                  <input name="gammeColor" type="radio" id="gammeColor" style="text-align: left" value="3" <?php if (format_to_edit($options->gammeColor)==3){ echo "checked";} ?>/> <img src="../wp-content/plugins/lcTags/img/gamme4.jpg" alt="Gamme 4"/><br />
                  <input name="gammeColor" type="radio" id="gammeColor" style="text-align: left" value="4" <?php if (format_to_edit($options->gammeColor)==4){ echo "checked";} ?>/> <img src="../wp-content/plugins/lcTags/img/gamme5.jpg" alt="Gamme 5"/><br />
                  <input name="gammeColor" type="radio" id="gammeColor" style="text-align: left" value="5" <?php if (format_to_edit($options->gammeColor)==5){ echo "checked";} ?>/> <img src="../wp-content/plugins/lcTags/img/gamme6.jpg" alt="Gamme 6"/><br />
                  <input name="gammeColor" type="radio" id="gammeColor" style="text-align: left" value="6" <?php if (format_to_edit($options->gammeColor)==6){ echo "checked";} ?>/> <img src="../wp-content/plugins/lcTags/img/gamme7.jpg" alt="Gamme 7"/><br />
                  <input name="gammeColor" type="radio" id="gammeColor" style="text-align: left" value="7" <?php if (format_to_edit($options->gammeColor)==7){ echo "checked";} ?>/> <img src="../wp-content/plugins/lcTags/img/gamme8.jpg" alt="Gamme 8"/><br />
                </td>
              </tr>
			   <tr valign="top"> 
                <th width="33%" scope="row">
                  <label for="sizeMin"><?php _e('Taille minimum des mots :', 'lctag') ?></label>
                </th> 
                <td>
                  <input name="sizeMin" type="text" id="sizeMin" style="text-align: left" value="<?php echo format_to_edit($options->sizeMin) ?>" size="10" />%<br />
                </td>
              </tr>
			   <tr valign="top"> 
                <th width="33%" scope="row">
                  <label for="sizeMax"><?php _e('Taille maximum des mots :', 'lctag') ?></label>
                </th> 
                <td>
                  <input name="sizeMax" type="text" id="sizeMax" style="text-align: left" value="<?php echo format_to_edit($options->sizeMax) ?>" size="10" />%<br />
                </td>
              </tr>
			   <tr valign="top"> 
                <th width="33%" scope="row">
                  <label for="sizeMax"><?php _e('Click actif :', 'lctag') ?></label>
                </th> 
                <td>
                  <input name="clickActif" type="radio" id="clickActif" value="0" <?php if (format_to_edit($options->clickActif)==0){ echo "checked";} ?> /> Non<br />
                  <input name="clickActif" type="radio" id="clickActif" value="1" <?php if (format_to_edit($options->clickActif)==1){ echo "checked";} ?> /> Oui<br />
                </td>
              </tr>
			  
		    </table> 
            <p class="submit"><input type="submit" name="update" value="<?php _e('Update Options', 'lctag') ?> &raquo;" /></p>	         
        </form>   		
	</div>	  
    <?php
  }  
?>