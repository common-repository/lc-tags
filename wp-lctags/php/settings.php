<?php
if ( defined('ABSPATH') )
	require_once( ABSPATH . 'wp-config.php');
else
    require_once('../../wp-config.php');	
	
$reqParam="SELECT id,bgcolor,buttonColorOff,buttonColorOn,gammeColor,sizeMax,sizeMin,clickActif FROM ".$table_prefix."lctags";
$resultParam=$wpdb->get_results($reqParam);	
foreach($resultParam as $rP){
	$bgcolor=$rP->bgcolor;
	$buttonColorOff=$rP->buttonColorOff;
	$buttonColorOn=$rP->buttonColorOn;
	$gammeColor=$rP->gammeColor;
	$sizeMax=$rP->sizeMax;
	$sizeMin=$rP->sizeMin;
	$clickActif=$rP->clickActif;
}
$myVar='<?xml version="1.0" encoding="UTF-8"?>';
$myVar=$myVar."<contenu>";
$myVar=$myVar."<bgcolor>0x".$bgcolor."</bgcolor>";
$myVar=$myVar."<buttonColorOff>0x".$buttonColorOff."</buttonColorOff>";	
$myVar=$myVar."<buttonColorOn>0x".$buttonColorOn."</buttonColorOn>";	
$myVar=$myVar."<gammeColor>".$gammeColor."</gammeColor>";	
$myVar=$myVar."<sizeMax>".$sizeMax."</sizeMax>";	
$myVar=$myVar."<sizeMin>".$sizeMin."</sizeMin>";	
$myVar=$myVar."<clickActif>".$clickActif."</clickActif>";		
$myVar=$myVar."</contenu>";
echo $myVar;
?>