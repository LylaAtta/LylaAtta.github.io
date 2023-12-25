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
?>


<div class="row">
  
  <?php foreach(array_chunk($files, $nrow) as $row) { ?>
    <div class="column">
      <?php foreach($row as $photo) { 
        $impath = "$dir" . "$photo";?>
        <img src=<?php echo "$impath" ?>>
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