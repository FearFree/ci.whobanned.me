<?php
function scan_dir($dir, &$files) {
    $ignored = array('.', '..',);

    $files = array();
    foreach (scandir($dir) as $file) {
        if (in_array($file, $ignored)) continue;
        $files[$file] = filemtime($dir . '/' . $file);
    }

    arsort($files);
}
scan_dir("/var/www/dev", $files);
$filekeys = array_keys($files);

echo '<html>
<head>
<title>WhoBannedMe</title>
</head>
<body>
WhoBannedMe Development Artifacts<br>
<table>
    <tr><td>Current Release Build: </td><td><a href="http://ci.whobanned.me/release/1.1">1.1</a></td></tr>
    <tr><td>Latest Dev Build: </td><td><a href="http://ci.whobanned.me/dev/' . $filekeys['0'] . '">' . $filekeys['0'] . '</a></td><td>' . gmdate("Y-m-d H:i:s", $files[$filekeys['0']]) . '<td><img src="https://drone.io/github.com/FearFree/WhoBannedMe/status.png"></td></tr>
</table>
<u>Previous Versions</u><br>
<table>';
foreach(array_slice($files, 1) as $build => $date){
  echo '<tr><td><a href="http://ci.whobanned.me/dev/' . $build . '">' . $build . '</td><td>' . gmdate("Y-m-d H:i:s", $date) . '</a><br>';
}
echo '</table>
</body>
</html>';
?>
