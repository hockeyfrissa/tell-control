<?
header('Content-Type: application/json');
error_reporting(E_ALL);
ini_set("display_errors", 1);
?>

<?
$arr = array();
$out = shell_exec("/usr/bin/tdtool -l");
$i = 0;
    foreach(preg_split("/((\r?\n)|(\r\n?))/", $out) as $line){
        if($i>0)
        {
            if(strlen($line)>0)
            {
                if (strpos($line,'SENSORS:') !== false || strpos($line,'PROTOCOL') !== false) {
                   continue;
                }
                if(strpos($line,'fineoffset') === false)
                {
                $arr2 = explode("\t", $line);
                $arr3 = array();
            
                $arr3['id'] = $arr2[0];
                $arr3['name'] = $arr2[1];
                $arr3['state'] = $arr2[2];
                $arr3['type'] = "switch";
            
                array_push($arr, $arr3);
                }
                if(strpos($line,'fineoffset') !== false)
                {
                    $arr2 = explode("\t", $line);
                    $arr3 = array();
                    $arr3['protocol'] = $arr2[0];
                    $arr3['model'] = $arr2[1];
                    $arr3['id'] = str_replace(" ", "", $arr2[2]);
                    $arr3['temp'] = $arr2[3];
                    $arr3['humidity'] = $arr2[4];
                    $arr3['updated'] = $arr2[5];
                    $arr3['type'] = "sensor";
                    array_push($arr, $arr3);
                }
            }
        }
        $i++;
    }

echo json_encode($arr);
?>