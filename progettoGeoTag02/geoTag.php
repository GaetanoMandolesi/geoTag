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

# ###############################################################################################################

$imgdir = "./img/";
$img_file = "IMG.jpg";

?>
<!DOCTYPE HTML>
<html lang="en">
 <head>
 <link rel="icon" href="leaflet/images/favicon.ico" />
 <meta charset="utf-8" />
 <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
 <script src="leaflet/leaflet.js"></script>
 <link rel="stylesheet" href="leaflet/leaflet.css" />
<style>
 html, body {
 height: 100%;
 padding: 0;
 margin: 0;
 overflow:hidden;
 }
 #map {
 /* configure the size of the map */
 width: 100%;
 height: 100%;
 }
 </style>
 </head>
 <body>
<div id="map"></div>
<?php
$directory = "img/";
$images = glob($directory . "*.{png,jpg,jpeg}", GLOB_BRACE);
 
 array_multisort(
  array_map( 'filemtime', $images ),
  SORT_NUMERIC,
  SORT_DESC,
  $images
);
 echo "<br>".basename($images[0]). "<br>";
 $rife =basename($images[0]);
 echo $rife;
$exif0 = exif_read_data('img/'.$rife);
$lon0 = getGps($exif0["GPSLongitude"], $exif0['GPSLongitudeRef']);
$lat0 = getGps($exif0["GPSLatitude"], $exif0['GPSLatitudeRef']);
// echo "<br>" . $lon0 . "<br>" . $lat0; 
?> 

<?php
echo ("<script type ='text/javascript'>");
if ($lat0 !== 0){
echo ("var map = L.map('map').setView({lon: $lon0, lat: $lat0}, 11);  L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', { maxZoom: 19, attribution: '&copy; <a href=https://openstreetmap.org/copyright>OpenStreetMap contributors</a>'}).addTo(map); L.control.scale().addTo(map);");
}else{

echo ("var map = L.map('map').setView({lon:8.0, lat:45.0}, 11);  L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', { maxZoom: 19, attribution: '&copy; <a href=https://openstreetmap.org/copyright>OpenStreetMap contributors</a>'}).addTo(map); L.control.scale().addTo(map);");
}

echo ("</script>");
?>
<?php 
echo ("<script type ='text/javascript'>");
foreach (glob("img/*.jp*g") as $filename) {
$xf_data = exif_read_data($filename);
//$filename= $imgdir . $img_file;
$exif = exif_read_data($filename);
$dataora = $exif['DateTime'];

$lon = getGps($exif["GPSLongitude"], $exif['GPSLongitudeRef']);
$lat = getGps($exif["GPSLatitude"], $exif['GPSLatitudeRef']);
//  echo basename($filename). ", " . $dataora . ", " . $lat . ", ". $lon ."<br>";
if ($lat !== 0){
echo    "L.marker({lon:". $lon . ", lat:". $lat . "}). bindPopup('" . $dataora ."<br/><img width=100% src=img/". basename($filename) .">"."').addTo(map);\n";
}}
echo ("</script>");
?>
<?php
$filename = 'contatore' . date('Y') . '.txt';
 if (! file_exists($filename)) {   
  file_put_contents($filename, "0");
 }else{
    $fp = fopen( $filename,"r"); // apri in lettura (r)
    $counter = fread($fp, filesize($filename) ); // leggi valore esistente
  fclose( $fp ); // chiudi lettura
  ++$counter; // aumenta la variabile letta di 1
  $fp = fopen( $filename,"w"); // apri in scrittura (w)
  fwrite( $fp, $counter); // aggiorna valore
  fclose( $fp ); // chiudi
 }
?>
</body>
</html>

