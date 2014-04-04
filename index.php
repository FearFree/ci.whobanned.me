<?php

  function scan_dir($dir, &$files) {
    $ignored = array('.', '..',);

    $files = array();
    foreach (scandir($dir) as $file) {
      if (in_array($file, $ignored))
        continue;
      $files[$file] = filemtime($dir . '/' . $file);
    }

    arsort($files);
  }

  scan_dir("/var/www/dev", $files);
  $filekeys = array_keys($files);
?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>WhoBannedMe</title>
    <link rel="stylesheet" href="semantic-ui/css/semantic.css">
    <link rel="stylesheet" href="css/styles.css">

  </head>
  <body>
    <h1 class="ui dividing header">WhoBannedMe Development Artifacts</h1>
    
    <p>Current Release Build: <a class="white" href="http://ci.whobanned.me/release/1.1">1.1</a></p>
    
    <p>Latest Dev Build: 
      <a href="http://ci.whobanned.me/dev/<?php echo($filekeys['0']);?>"><?php echo($filekeys['0']); ?></a><?php echo('<small>('.gmdate("Y-m-d H:i:s", $files[$filekeys['0']]).')</small>'); ?> 
      <img src="https://drone.io/github.com/FearFree/WhoBannedMe/status.png">
    </p>


    
    <h3 class="ui header">Previous Versions</h3>
    
    <div class="ui list">
      <?php
        foreach (array_slice($files, 1) as $build => $date) {
          echo '<a class="item" href="http://ci.whobanned.me/dev/'.$build.'">'.$build.'</a>
          <small>('.gmdate("Y-m-d H:i:s", $date).')</small>
          ';
        }
      ?>
    </div>
  </body>
</html>
