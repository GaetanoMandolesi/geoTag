<?php

# The tagnames can vary in different cameras

$imgdir = "./img/";
$img_file = "IMG.jpg";

echo $img_file . "&nbsp;&nbsp;&nbsp;<sub>TEST</sub>
<br />";
echo '<img src="' . $imgdir . $img_file . '" alt="'
 . $img_file . '" title="' . $img_file . '" width="400" /><br /><br />';

$xf_data = exif_read_data($imgdir . $img_file);

$tagg = exif_tagname(0X10F);
echo '<br>' . $tagg .  ' >>> ' . $xf_data[$tagg];
$tagg = exif_tagname(0X110);
echo '<br>' . $tagg .  ' >>> ' . $xf_data[$tagg];
$tagg = exif_tagname(0X132);
echo '<br>' . $tagg .  ' >>> ' . $xf_data[$tagg];
$tagg = exif_tagname(0XA002);
echo '<br>' . $tagg .  ' >>> ' . $xf_data[$tagg] . 'px';
$tagg = exif_tagname(0XA003);
echo '<br>' . $tagg .  ' >>> ' . $xf_data[$tagg] . 'px';
$tagg = exif_tagname(0x8825);
echo '<br>' . $tagg .  ' >>> ' . $xf_data[$tagg];
$tagg = exif_tagname(0x9000);
echo '<br>' . $tagg .  ' >>> ' . $xf_data[$tagg];
$tagg = exif_tagname(0x0128);
echo '<br>' . $tagg .  ' >>> ' . $xf_data[$tagg];
$tagg = exif_tagname(0x0132);
echo '<br>' . $tagg .  ' >>> ' . $xf_data[$tagg];
$tagg = exif_tagname(0x8825);
echo '<br>' . $tagg .  ' >>> ' . $xf_data[$tagg];
$tagg = exif_tagname(0x8769);
echo '<br>' . $tagg .  ' >>> ' . $xf_data[$tagg];
$tagg = exif_tagname(0XA002);
$tagg = exif_tagname(0x8825);
echo '<br>' . $tagg .  ' >>> ' . $xf_data[$tagg];
echo "<br>######################<br>";
$tagg = exif_tagname(0X132);
echo '<br>' . $tagg .  ' >>> ' . $xf_data[$tagg];
echo "<br>######################<br>";
$filename= $imgdir . $img_file;
$exif = exif_read_data($filename);
$dataora =getGps($exif["DateTimeOriginal"], $exif['DateTimeOriginalRef']);
$lon = getGps($exif["GPSLongitude"], $exif['GPSLongitudeRef']);
$lat = getGps($exif["GPSLatitude"], $exif['GPSLatitudeRef']);
//var_dump($lat, $lon);
echo '----------------<br>';
echo 'dataOra: '. $dataora .'    latitudine   :' .$lat. '&nbsp;Longitudine   :'.$lon;
echo '<br>######################<br>';



echo '<br>111==================<br/>';
?>
<?php
/*
echo "IMG.jpg:<br />\n";
$exif = exif_read_data('img/IMG.jpg', 'IFDO');
echo $exif===false ? "No header data found.<br />\n" : "Image contains headers<br />\n";

$exif = exif_read_data('img/IMG.jpg', 0, true);
echo "IMG.jpg:<br />\n";
foreach ($exif as $key => $section) {
    foreach ($section as $name => $val) {
        echo "$key.$name: $val<br />\n";
    }
}
echo '<br>222==================<br/>';
?>
<?php
$fileName='./img/IMG.jpg'; //or $fileName='xxxxxxxxx';
//echo $returned_data = triphoto_getGPS($fileName);
function triphoto_getGPS($fileName)
{
    //get the EXIF all metadata from Images
    $exif = exif_read_data($fileName);
    if(isset($exif["GPSLatitudeRef"])) {
        $LatM = 1; $LongM = 1;
        if($exif["GPSLatitudeRef"] == 'S') {
            $LatM = -1;
        }
        if($exif["GPSLongitudeRef"] == 'W') {
            $LongM = -1;
        }

        //get the GPS data
        $gps['LatDegree']=$exif["GPSLatitude"][0];
        $gps['LatMinute']=$exif["GPSLatitude"][1];
        $gps['LatgSeconds']=$exif["GPSLatitude"][2];
        $gps['LongDegree']=$exif["GPSLongitude"][0];
        $gps['LongMinute']=$exif["GPSLongitude"][1];
        $gps['LongSeconds']=$exif["GPSLongitude"][2];

        //convert strings to numbers
        foreach($gps as $key => $value){
            $pos = strpos($value, '/');
            if($pos !== false){
                $temp = explode('/',$value);
                $gps[$key] = $temp[0] / $temp[1];
            }
        }

        //calculate the decimal degree
        $result['latitude']  = $LatM * ($gps['LatDegree'] + ($gps['LatMinute'] / 60) + ($gps['LatgSeconds'] / 3600));
        $result['longitude'] = $LongM * ($gps['LongDegree'] + ($gps['LongMinute'] / 60) + ($gps['LongSeconds'] / 3600));
        $result['datetime']  = $exif["DateTime"];

        return $result;
    }
}
echo '<br>333==================<br/>';
?>
<?php
$exif = exif_read_data('img/IMG.jpg', 0, true );

foreach($exif['IFD0'] as $key => $section)
{

    echo "$key . $section <br >";

}
echo '<br>444==================<br/>';
?>
<?php
$exif = exif_read_data('img/IMG.jpg', 0, true );
//print_r($exif);
//OR var_dump($exif); 
foreach ($exif as $key => $section) {
   foreach ($section as $name => $val) {
    echo "$key.$name: $val<br />\n";
   }
}


echo '<br>555555==================<br/>';
?>



<?php
echo "IMG_20230707_111504.jpg:<br />\n";
$exif = exif_read_data('img/IMG.jpg', 'IFD0');
echo $exif===false ? "No header data found.<br />\n" : "Image contains headers<br />\n";

$exif = exif_read_data('img/IMG.jpg', 0, true);
echo "test2.jpg:<br />\n";
foreach ($exif as $key => $section) {
    foreach ($section as $name => $val) {
        echo "$key.$name: $val<br />\n";
    }
}
*/
echo'<br>66666666================================<br>';
?>
<?php
$filename='./img/IMG.jpg';
$exif = exif_read_data($filename);
$lon = getGps($exif["GPSLongitude"], $exif['GPSLongitudeRef']);
$lat = getGps($exif["GPSLatitude"], $exif['GPSLatitudeRef']);
var_dump($lat, $lon);
echo '----------------<br>';
if ($lat !== 0){
echo 'latitudine   :' .$lat. 'Longitudine   :'.$lon;
}else{
	echo "la foto che hai messo non è geotaggata";
}
echo '<br>----------------';


function getGps($exifCoord, $hemi) {
    $degrees = count($exifCoord) > 0 ? gps2Num($exifCoord[0]) : 0;
    $minutes = count($exifCoord) > 1 ? gps2Num($exifCoord[1]) : 0;
    $seconds = count($exifCoord) > 2 ? gps2Num($exifCoord[2]) : 0;
    $flip = ($hemi == 'W' or $hemi == 'S') ? -1 : 1;
    return $flip * ($degrees + $minutes / 60 + $seconds / 3600);
}
function gps2Num($coordPart) {
    $parts = explode('/', $coordPart);
    if (count($parts) <= 0)
        return 0;
    if (count($parts) == 1)
        return $parts[0];
    return floatval($parts[0]) / floatval($parts[1]);
}
echo'<br>7777================================<br>';
?>