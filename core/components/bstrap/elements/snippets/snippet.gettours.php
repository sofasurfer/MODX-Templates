<?php


$bandId = $modx->getOption('bandId',$scriptProperties,413);
$showPast = $modx->getOption('showPast',$scriptProperties,false);

$url = 'http://tourdate.twogentlemen.net/json.php?id=' . $bandId;

if($showPast){
    $url .=  "&past";
}


$content = file_get_contents($url);
$json = json_decode($content, true);


// Check if tours exist
if( count($json['shows']) > 1){
    foreach($json['shows'] as $item) {

        $output[] = $modx->getChunk($modx->getOption('itemTpl',$scriptProperties,'tour.item'),$item);
    }    
    $output = implode("\n",$output);
}else{
    $output = $modx->getChunk('pm.mailchimp',$json);
}

return $output;