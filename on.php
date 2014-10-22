<?
error_reporting(E_ALL);
 ini_set("display_errors", 1);
?>
<?
$out = shell_exec("/usr/bin/tdtool -n ".$_SERVER['QUERY_STRING']);
echo $out;
?>
