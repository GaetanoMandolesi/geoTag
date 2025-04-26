foreach ($images as $i) {
  $img = basename($i);
  $caption = substr($img, 0, strrpos($img, "."));
  printf("<figure><img src='gallery/%s'/><figcaption>%s</figcaption></figure>", $img, $caption);
}