<html>
<head>
<title>WhoBannedMe</title>
</head>
<body>
WhoBannedMe Development Artifacts<br>
<?php
function scan_dir($dir, &$files) {
    $ignored = array('.', '..',);

    $files = array();
    foreach (scandir($dir) as $file) {
        if (in_array($file, $ignored)) continue;
        $files[$file] = filemtime($dir . '/' . $file);
    }

    arsort($files);
    $files = array_keys($files);
}

scan_dir("../dev", $files);
echo '<table><tr><td>Latest Release Build: </td><td><a href="../release/1.1">1.1</a></td></tr>';
echo '<tr><td>Latest Dev Build: </td><td><a href="../dev/' . $files['0'] . '">' . $files['0'] . '</a></td><td><img src="https://drone.io/github.com/FearFree/WhoBannedMe/status.png"></td></tr></table>';
echo '<u>Previous Versions</u><br>';
foreach(array_slice($files, 1) as $build){
  echo '<a href="dev/' . $build . '">' . $build . '</a><br>';
}
?>
</body>
</html>
