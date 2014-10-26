<? 
if($_POST['Submit']){ 
$open = fopen("/etc/tellstick.conf","w+"); 
$text = $_POST['update']; 
fwrite($open, $text); 
fclose($open); 
echo "File updated.<br />";  
echo "File:<br />"; 
$file = file("/etc/tellstick.conf"); 
foreach($file as $text) { 
echo $text."<br />"; 
} 
}else{ 
$file = file("/etc/tellstick.conf"); 
echo "<form action=\"".$PHP_SELF."\" method=\"post\">"; 
echo "<textarea Name=\"update\" cols=\"50\" rows=\"10\">"; 
foreach($file as $text) { 
echo $text; 
}  
echo "</textarea>"; 
echo "<input name=\"Submit\" type=\"submit\" value=\"Update\" />\n 
</form>"; 
} 
?>