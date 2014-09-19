<?php
$fontFiles = scandir('fonts/ttf');
if ($fontFiles !== FALSE) {
	foreach ($fontFiles as $fontFile) {
		if ($fontFile != '.' && $fontFile != '..') {
			$cmd = "php convert.php -u \"U+??\" --callback Raphael.registerFont --ps-as-family --no-scaling --no-simplify --fontforge \"C:/FontForge/bin/fontforge.exe\" \"fonts/ttf/$fontFile\" > \"fonts/js/$fontFile.js\"";
			echo $cmd;
			shell_exec($cmd);
		}
	}
}