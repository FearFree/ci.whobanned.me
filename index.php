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
  //scan_dir("dev", $files);
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
  <body id="builds">
    <div id="navigation" class="ui fixed transparent inverted main menu">
      <div class="container">
        <div class="title item">
          <b>WhoBannedMe:</b> Artifacts
        </div>

        <div class="right menu">
          <div class="vertically fitted borderless item">
            <iframe src="http://ghbtns.com/github-btn.html?user=FearFree&repo=WhoBannedMe&type=watch&amp;count=true"  allowtransparency="true" frameborder="0" scrolling="0" width="95" height="20"></iframe>
          </div>
          <a href="http://dev.bukkit.org/bukkit-plugins/whobannedme/" class="icon item" data-content="Bukkit Dev">
            <i class="basic url icon"></i> Bukkit Dev
          </a>
          <a href="http://www.fishbans.com" class="icon item" data-content="fishbans.com">
            <i class="ban circle icon"></i> Fishbans.com
          </a>

          <a href="https://github.com/FearFree/WhoBannedMe" class="icon item" data-content="View project on Github">
            <i class="icon github"></i>
          </a>
        </div>
      </div>
    </div>


    <div class="pageHeader">
      <div class="container">
        <div class="introduction">
          <h1 class="ui dividing header">WhoBannedMe</h1>

          <p>WhoBannedMe interfaces with the FishBans API to let you know how many global bans a user has. When a player connects, other users can be notified if the connecting user has any global bans from the various ban systems Fishbans pulls data from.</p>
        </div>
      </div>
    </div>

    <div class="main container">
      <h2 class="ui dividing header">Development artifacts</h2>

      <p>Current Release Build: <a href="http://ci.whobanned.me/release/1.1">1.1</a></p>

      <p>Latest Dev Build: 
        <a href="http://ci.whobanned.me/dev/<?php echo($filekeys['0']); ?>"><?php echo($filekeys['0']); ?></a> <?php echo('<small>(' . gmdate("Y-m-d H:i:s", $files[$filekeys['0']]) . ')</small>'); ?> 
        <img src="https://drone.io/github.com/FearFree/WhoBannedMe/status.png">
      </p>



      <h3 class="ui header">Previous Versions</h3>

      <div class="ui list" id="previousVersions">
        <?php
          foreach (array_slice($files, 1) as $build => $date) {
            echo '<li class="item"><a href="http://ci.whobanned.me/dev/' . $build . '">' . $build . '</a> <small>(' . gmdate("Y-m-d H:i:s", $date) . ')</small></li>';
          }
        ?>
      </div>
    </div>
  </body>
</html>
