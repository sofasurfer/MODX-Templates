<?php


$url = 'http://tourdate.twogentlemen.net/json.php?id=413';
$content = file_get_contents($url);
$json = json_decode($content, true);

foreach($json['shows'] as $item) {

    $output[] = $modx->getChunk($modx->getOption('itemTpl',$scriptProperties,'tour.item'),$item);
}

$output = implode("\n",$output);

return $output;