<?php
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
echo "<br>============FINE SEZ 0 TESTATA FUNZIONI NON VISIBILI PERCHE' PHP============<br>";
?>
<?php
$directory = "img/";
$images = glob($directory . "*.{png,jpg,jpeg}", GLOB_BRACE); 
 array_multisort(
  array_map( 'filemtime', $images ),
  SORT_NUMERIC,
  SORT_DESC,
  $images  
);
var_dump($images,"/n","xxx");
echo "<br>alternativa<br>";
print_r($images);

 echo "<br>".basename($images[0]). "<br>";
 $rife =basename($images[0]);
 echo $rife;
$exif0 = exif_read_data('img/'.$rife);
$lon = getGps($exif0["GPSLongitude"], $exif0['GPSLongitudeRef']);
$lat = getGps($exif0["GPSLatitude"], $exif0['GPSLatitudeRef']);
$dataora = $exif0['DateTime'];
 echo "<br>" , $lon , "<br>" , $lat,"<br>",$dataora; 
 
echo "<br>============FINE SEZ 1============<br>";
?>
<?php
$filename = "./img/IMG.jpg";
$exif = exif_read_data($filename);
$dataora = $exif['DateTime'];
$lon = getGps($exif["GPSLongitude"], $exif['GPSLongitudeRef']);
$lat = getGps($exif["GPSLatitude"], $exif['GPSLatitudeRef']);
		
echo $lat, "<br>",$lon, "<br>", $dataora;

echo "<br>============FINE SEZ 2============<br>";
?>


