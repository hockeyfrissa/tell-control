<?
$out = shell_exec("/usr/bin/tdtool -f " .$_SERVER['QUERY_STRING'] );
echo "$out";
?>
