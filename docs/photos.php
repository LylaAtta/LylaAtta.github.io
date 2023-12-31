<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Lyla Atta</title>
    <link rel="stylesheet" href="styles_photos.css">
</head>

<body>



<?php
  $dir = "../assets/img/photos/all/";
  $dir_handle = opendir($dir); //open a connection to the directory
  $skip = array('.','..','.DS_Store'); //a few directories to ignore


  // count number of photos
  $fi = new FilesystemIterator($dir, FilesystemIterator::SKIP_DOTS);
  $nphoto = iterator_count($fi);
  // printf("There were %d Files", iterator_count($fi));

  // calculate number of rows based on how many photos there are (populate 3 columns)
  $ncol = 3;
  $nrow = ceil($nphoto/$ncol);
  // echo $nrow;

  // iterate through files and put them in files array
  $files = array();

  // echo $dir_handle
  while (false !== ($photo = readdir($dir_handle))) {
    // echo "$photo\n";
    $files[$photo] = $photo;
  }

  closedir($dir_handle); 

  // remove non photo files 
  $files = array_diff($files, $skip);

  // foreach($files as $file) {
  //   echo $file;
  // }

  // now read image info from json file
  $photo_dets_dir = "../assets/img/photos/photo_dets_2.json";
  $str = file_get_contents("../assets/img/photos/photo_dets.json");

  $checkLogin = file_get_contents($photo_dets_dir);

  // This will remove unwanted characters. not really sure what this part is doing but it fixes the read in error - see stack overflow link below 
  // Check http://www.php.net/chr for details
  for ($i = 0; $i <= 31; ++$i) { 
    $checkLogin = str_replace(chr($i), "", $checkLogin); 
  }
  $checkLogin = str_replace(chr(127), "", $checkLogin);

  // This is the most common part
  // Some file begins with 'efbbbf' to mark the beginning of the file. (binary level)
  // here we detect it and we remove it, basically it's the first 3 characters 
  if (0 === strpos(bin2hex($checkLogin), 'efbbbf')) {
  $checkLogin = substr($checkLogin, 3);
  }


  // decode json
  $json = json_decode($checkLogin);
  $loc = array_column($json, 'location', 'fname');
  $yr = array_column($json, 'year', 'fname');
  $cam = array_column($json, 'camera', 'fname');


?>

<div class="row">
  
  <?php foreach(array_chunk($files, $nrow) as $row) { ?>
    <div class="column">
      <?php foreach($row as $photo) { 
        // figure out which json entry corresponds to this image


        $impath = "$dir" . "$photo";?>
        <div class="imgcontainer">
          <img class="image2" src=<?php echo "$impath" ?>>
          <img class="image1" src=<?php echo "$impath" ?>>
          <div class="overlay">
            <div class="textcontainer">
              <div class="text" style="font-size=2pt">
                <?php echo "$loc[$photo]"?> <br>
                <?php echo "$yr[$photo]"?><br>
                <?php echo "$cam[$photo]"?>
              </div>
            </div>
          </div>
          
          
        </div>

      <?php } ?>
    </div>
  <?php } ?>
</div>




</body>


</html>

<!-- https://stackoverflow.com/questions/12520908/populate-html-table-with-directory-folder-contents -->
<!-- https://stackoverflow.com/questions/1793716/how-to-display-two-table-columns-per-row-in-php-loop -->
<!-- https://stackoverflow.com/questions/42207780/photo-id-of-each-image-for-link-inside-foreach-loop -->
<!-- https://stackoverflow.com/questions/369602/deleting-an-element-from-an-array-in-php -->
<!-- https://stackoverflow.com/questions/19758954/get-data-from-json-file-with-php -->
<!-- https://stackoverflow.com/questions/57256533/php-look-up-value-by-key-given-a-list-of-objects -->
<!-- https://stackoverflow.com/questions/17219916/json-decode-returns-json-error-syntax-but-online-formatter-says-the-json-is-ok -->


