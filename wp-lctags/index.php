<?php
if ( defined('ABSPATH') )
	require_once( ABSPATH . 'wp-config.php');
else
    require_once('../wp-config.php');	
?>	
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
	   "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<meta name="distribution" content="global" />
<meta name="robots" content="follow, all" />
<meta name="language" content="fr" />
<title><?php bloginfo('name'); ?> <?php if ( is_single() ) { ?> : <?php } ?><?php wp_title(':'); ?></title>
<meta name="generator" content="WordPress <?php bloginfo('version'); ?>" />
<style type="text/css">
	html,body{	width:100%; height:100%;}
</style>
<script type="text/javascript" src="js/swfobject.js"></script>
<script type="text/javascript" src="js/swfintegrator.js"></script>
</head>
<body>
	<div id="flashcontent" style="display:none" >
			<?php
		$reqCat="SELECT term_id,name FROM ".$table_prefix."terms WHERE term_id IN (SELECT term_id FROM ".$table_prefix."term_taxonomy WHERE taxonomy='post_tag') ORDER BY term_id ASC";
		$resultCat=$wpdb->get_results($reqCat);
		
		echo "<ul>";
		foreach($resultCat as $c){
			echo "<li>".$c->name;
			echo "<ul>";
			$reqContenu="SELECT post_content,post_title,ID FROM ".$table_prefix."posts WHERE id IN (SELECT object_ID FROM ".$table_prefix."term_relationships WHERE term_taxonomy_id=".$c->term_id.") ORDER BY  post_date ";
			$resultContenu=$wpdb->get_results($reqContenu);
			if($resultContenu){	
				foreach($resultContenu as $t){				
					echo "<li>".$t->post_title."</li>";
				}
				echo "<!-- --></ul>";
			}
			echo "</li>";
		}	
		echo "</ul>";
		?>
	</div>	
	<script type="text/javascript">		
		// <![CDATA[		
		var so = new SWFObject("lctags.swf", "lctags", "100%", "100%", "9", "#303030");		
		var myPASMF=new SWFintegrator(800,600,"fullscreen");
		so.addParam("allowdomain", "always");
		so.addParam("scale", "noscale");		
		so.addParam("allowFullScreen", "true");	
		//indiquez ici la racine du blog (/wordpress, /blog, /...)
		so.addVariable("pathBase", "/");
		so.useExpressInstall("expressinstall.swf");
		so.write("flashcontent");
		// ]]>
	</script>
</body>
</html>
