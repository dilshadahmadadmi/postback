<?php
// Include the information for the database connection
require_once('gee_config.php');
// Reset all variables we retrieve from postback
$gee_unique = 0;
$gee_postback = null;
$gee_idapp = 0;
$gee_app = null;
$gee_ppi = 0.00;
$gee_currency = 'USD';
$gee_country = 'US';
$gee_lang = 'EN';
$gee_iddevice = 0;
$gee_device = null;
$gee_click = 0;
$gee_installation = 0;
// get the information about the postback
if(isset($_GET['gee_unique']) && $_GET['gee_unique']) {
	$gee_unique = filter_var($_GET['gee_unique'], FILTER_SANITIZE_NUMBER_INT);
}
if(isset($_GET['gee_postback']) && $_GET['gee_postback']) {
	$gee_postback = filter_var($_GET['gee_postback'], FILTER_SANITIZE_STRING);
}
if(isset($_GET['gee_idapp']) && $_GET['gee_idapp']) {
	$gee_idapp = filter_var($_GET['gee_idapp'], FILTER_SANITIZE_NUMBER_INT);
}
if(isset($_GET['gee_app']) && $_GET['gee_app']) {
	$gee_app = filter_var($_GET['gee_app'], FILTER_SANITIZE_STRING);
}
if(isset($_GET['gee_ppi']) && $_GET['gee_ppi']) {
	$gee_ppi = filter_var($_GET['gee_ppi'], FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
}
if(isset($_GET['gee_currency']) && $_GET['gee_currency']) {
	$gee_currency = filter_var($_GET['gee_currency'], FILTER_SANITIZE_STRING);
}
if(isset($_GET['gee_country']) && $_GET['gee_country']) {
	$gee_country = filter_var($_GET['gee_country'], FILTER_SANITIZE_STRING);
}
if(isset($_GET['gee_lang']) && $_GET['gee_lang']) {
	$gee_lang = filter_var($_GET['gee_lang'], FILTER_SANITIZE_STRING);
}
if(isset($_GET['gee_iddevice']) && $_GET['gee_iddevice']) {
	$gee_iddevice = filter_var($_GET['gee_iddevice'], FILTER_SANITIZE_NUMBER_INT);
}
if(isset($_GET['gee_device']) && $_GET['gee_device']) {
	$gee_device = filter_var($_GET['gee_device'], FILTER_SANITIZE_STRING);
}
if(isset($_GET['gee_click']) && $_GET['gee_click']) {
	$gee_click = filter_var($_GET['gee_click'], FILTER_SANITIZE_NUMBER_INT);
}
if(isset($_GET['gee_installation']) && $_GET['gee_installation']) {
	$gee_installation = filter_var($_GET['gee_installation'], FILTER_SANITIZE_NUMBER_INT);
}
// Connection to database
$gee_con = new mysqli($gee_server, $gee_user, $gee_pass, $gee_db, $gee_port);
if($gee_con->connect_error) {
  header('HTTP/1.1 503 Service Unavailable');
  die('HTTP/1.1 503 Service Unavailable // Connect Error ('.$mysqli->connect_errno.') '.$mysqli->connect_error);
}
// Exists this unique ID?
$sql_exists = "SELECT gee_unique FROM ".$gee_table." WHERE gee_unique = ".$gee_unique;
$res_exists = $gee_con->query($sql_exists);
if($res_exists->num_rows) {
  // If exists, update the information
  $sql_update = "UPDATE ".$gee_table." SET gee_postback = '".addslashes($gee_postback)."', gee_idapp = ".$gee_idapp.", gee_app = '".addslashes($gee_app)."', gee_ppi = ".$gee_ppi.", gee_currency = '".addslashes($gee_currency)."', gee_country = '".addslashes($gee_country)."', gee_lang = '".addslashes($gee_lang)."', gee_iddevice = ".$gee_iddevice.", gee_device = '".addslashes($gee_device)."', gee_click = ".$gee_click.", gee_installation = ".$gee_installation." WHERE gee_unique = ".$gee_unique;
  $res_update = $gee_con->query($sql_update);
} else {
  // If not, add the information
  $sql_insert = "INSERT INTO ".$gee_table." (gee_unique, gee_postback, gee_idapp, gee_app, gee_ppi, gee_currency, gee_country, gee_lang, gee_iddevice, gee_device, gee_click, gee_installation)
  VALUES (".$gee_unique.", '".addslashes($gee_postback)."', ".$gee_idapp.", '".addslashes($gee_app)."', ".$gee_ppi.", '".addslashes($gee_currency)."', '".addslashes($gee_country)."', '".addslashes($gee_lang)."', ".$gee_iddevice.", '".addslashes($gee_device)."', ".$gee_click.", ".$gee_installation.")";
  $res_insert = $gee_con->query($sql_insert);
}
// Unset all variables
unset($gee_unique, $gee_postback, $gee_idapp, $gee_app, $gee_ppi, $gee_currency, $gee_country, $gee_lang, $gee_iddevice, $gee_device, $gee_click, $gee_installation);
unset($sql_exists, $res_exists, $sql_update, $res_update, $sql_insert, $res_insert);
// Close the connection to database
$gee_con->close();
// End.
?>