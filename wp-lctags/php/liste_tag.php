<?php
if ( defined('ABSPATH') )
	require_once( ABSPATH . 'wp-config.php');
else
    require_once('../../wp-config.php');	
$reqContenu="SELECT term_id,name FROM ".$table_prefix."terms WHERE term_id IN (SELECT term_id FROM ".$table_prefix."term_taxonomy WHERE taxonomy='post_tag') ORDER BY term_id ASC";
$resultContenu=$wpdb->get_results($reqContenu);

$myVar='<root><?xml version="1.0" encoding="UTF-8"?>';
$myVar=$myVar."<contenu>";

if(!$resultContenu){
}else{
	foreach($resultContenu as $e){	
		$reqCount="SELECT ID FROM ".$table_prefix."posts WHERE id IN (SELECT object_id FROM ".$table_prefix."term_relationships WHERE term_taxonomy_id=".$e->term_id.") ORDER BY  post_date ";
		$resultCount=$wpdb->get_results($reqCount);	
		$reqTotal="SELECT count FROM ".$table_prefix."term_taxonomy WHERE taxonomy='post_tag' AND term_id=".$e->term_id." ";
		$resultTotal=$wpdb->get_results($reqTotal);
		if(!$resultTotal){
		}else{
			foreach($resultTotal as $t){
				$countTotal=$t->count;
			}
		}			
		//$num_rows = mysql_num_rows($resultCount);
		if ($countTotal>0){
			$myVar=$myVar."<tag>";
			$myVar=$myVar."<id>".$e->term_id."</id>";
			$myVar=$myVar."<tag_name>".$e->name."</tag_name>";	
			$myVar=$myVar."<tag_count>".$countTotal."</tag_count>";
			$myVar=$myVar."<messages_associes>";
			foreach($resultCount as $c){				
				$myVar=$myVar."<message>";
				$myVar=$myVar."<id>".$c->ID."</id>";				
				$myVar=$myVar."</message>";
			}
			$myVar=$myVar."</messages_associes>";
			$myVar=$myVar."</tag>";
		}
	}
}

$myVar=$myVar."</contenu></root>";
echo $myVar;
?>