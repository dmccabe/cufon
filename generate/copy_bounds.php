<?php
define('BBOX_MARKER', '"bbox":');

function getBbox($content) {
  $bboxStartPos = strpos($content, BBOX_MARKER) + strlen(BBOX_MARKER) + 1;
  $bboxEndPos = strpos($content, '"', $bboxStartPos + 1) - 1;
  return substr($content, $bboxStartPos, $bboxEndPos - $bboxStartPos);
}

$fontFiles = scandir('fonts/js');
if ($fontFiles !== FALSE) {
        foreach ($fontFiles as $fontFile) {
                if ($fontFile != '.' && $fontFile != '..') {
                        $content = file_get_contents("fonts/js/$fontFile");                        
                        $oldContent = file_get_contents("oldfonts/js/$fontFile");

                        $bbox = getBbox($content);
                        $oldBbox = getBbox($oldContent);
	
			if($bbox != $oldBbox) {
				echo("Updating bbox for $fontFile from $bbox to $oldBbox");
				$modifiedContent = str_replace(BBOX_MARKER . '"' . $bbox, BBOX_MARKER . '"' . $oldBbox, $content);
				file_put_contents("fonts/js/$fontFile", $modifiedContent);
			}	
                }
        }
}
