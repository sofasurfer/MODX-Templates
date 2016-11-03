<?php
$file = "icons2.txt";
$handle = fopen($file, "r");
if ($handle) {
    while (($line = fgets($handle)) !== false) {

    	$pos1 = strpos($line, "fa-hover ");
    	if ($pos1 > 0){
		    $doc = new DOMDocument();
		    $doc->loadHTML($line);
		    $iTags = $doc->getElementsByTagName('i');

		    foreach($iTags as $iTag) {
		    	$iconname = $iTag->getAttribute('class');
	        	print   "<i class=\"$iconname\"></i> $iconname == $iconname || \n";
	    	}
    	} 
    }

    fclose($handle);
} else {
   print "Error file not found: $file";
} 