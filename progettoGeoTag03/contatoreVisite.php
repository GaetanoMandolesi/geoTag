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