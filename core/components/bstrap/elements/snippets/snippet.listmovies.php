<?php

/**
    List Movies
**/

if( !empty($_GET) ){
    $scriptProperties = array_merge($scriptProperties,$_GET);   
}

$site_url = $modx->getOption('site_url');
$path = $modx->getOption('path',$scriptProperties,false);
$tplItem = $modx->getOption('tplItem',$scriptProperties,false);
$tplSeries = $modx->getOption('tplSeries',$scriptProperties,false);
$tplDetail = $modx->getOption('tplDetail',$scriptProperties,false);
$source = $modx->getOption('source',$scriptProperties,1);
$modx->loadClass('sources.modMediaSource');
$mediaSource = $modx->getObject('sources.modMediaSource',$source );

$action = $modx->getOption('action',$scriptProperties,false);

$ignore = $modx->getOption('ignore',$scriptProperties,".,..,._");
$ignoreArray = explode(",",$ignore);

$docId = $modx->resource->get('id');

$i=0;
$listArray = array();

if( !empty($mediaSource) ){
    $mediaSourceArray = $mediaSource->get('properties');
    $mediaSourceId = $mediaSource->get('id');
    $basePath = $mediaSourceArray['basePath']['value'];
    $baseUrl = $mediaSourceArray['baseUrl']['value'];
}

function sortVideoByTitle($a, $b) {
    return strcmp($a["title"], $b["title"]);
}

$directory = $basePath . $path;

$di = new RecursiveDirectoryIterator($directory);  
foreach (new RecursiveIteratorIterator($di) as $filename => $cur) {

    // Check if hidden

    if (!in_array(basename($filename),$ignoreArray) && substr(basename($filename), 0, 1) != '.') {


        // Check if directory
        if ( $cur->isDir() ){   

            //$pathName = $filename;

        }else{
            
            // Get filename info
            $fileName = basename($filename);
            $pathName = dirname($filename);
            $pathName = str_replace($basePath,"",$pathName );
            $pathTitle = str_replace($path,"",$pathName );

            $stat = stat( $cur->getPathname() );
            $info = pathinfo($filename);    
            $type = $info['extension'];
            $key = md5($pathName);

            $listArray[$key]['key'] = $key;
            $listArray[$key]['createdon'] = $stat['mtime'];
            $listArray[$key]['name'] = $pathTitle;
            $listArray[$key]['directory'] = $info['dirname'];           
            $listArray[$key]['path'] = $baseUrl . $pathName;            
            $listArray[$key]['baseurl'] = $baseUrl . $pathName;         
            
            // Get file details
            $listArray[$key][$type][$fileName][$type] = $fileName;
            $listArray[$key][$type][$fileName][$type.'.time']         = $stat['mtime'];               
            $listArray[$key][$type][$fileName][$type.'.extension']    = $info['extension'];   
            $listArray[$key][$type][$fileName][$type.'.type']     = filetype($cur);
            $listArray[$key][$type][$fileName][$type.'.size']     = $cur->getSize();  
            $nbfiles++;
        }

    }
}


/**
    List Movies
**/
$content = "";
if (empty($action)){
    $content .= '<div class="row">';
    foreach($listArray as $movie){

        // Check if serie
        $serie=false;
        if(count($movie['mp4']) > 0){
            $serie=true;
        }

        $data = array();
        $data['title'] = $movie['name'];
        $data['width'] = 200;
        $data['height'] = 300;   
        $data['className'] = 'col-md-3';     
        $data['image'] = $site_url .  $movie['baseurl'] . '/poster.jpg';
        if($serie){
            $data['url'] = $modx->makeUrl($docId, '', '', 'full') . '?action=series&movie=' . $movie['key'];
        }else{
            $data['url'] = $modx->makeUrl($docId, '', '', 'full') . '?action=detail&movie=' . $movie['key'];
        }

        // get list chunk
        $chunkItem = $modx->getObject('modChunk',array(
            'name' => $tplItem
        ));
       $content .= $chunkItem->process($data);
    }
     $content .= '</div>';

/**
    Show movie series
**/
}else if ($action == 'series'){

    $key = $modx->getOption('movie',$scriptProperties,false);
    $movie = $listArray[$key];

    $videos = array();
    foreach($movie['mp4'] as $key => $value){
        $video = array(
            'title' => str_replace('.mp4', '', $key),
            'path' => $site_url .  $movie['baseurl'] . '/', 
            'mp4' => $value['mp4'],
            'jpg' => $movie['image']
        );
        $video['url'] = $modx->makeUrl($docId, '', '', 'full') . '?action=detail&movie='.$movie['key'].'&item=' . $value['mp4'];

        array_push($videos, $video);
    }
    usort($videos, 'sortVideoByTitle');

    foreach($videos as $video){
        // get list chunk
        $chunkSeries = $modx->getObject('modChunk',array(
            'name' => $tplSeries
        ));
        $content .= $chunkSeries->process($video);
    }
/**
    Show movie details
**/
}else if ($action == 'detail'){

    $key = $modx->getOption('movie',$scriptProperties,false);
    $item = $modx->getOption('item',$scriptProperties,false);
    $movie = $listArray[$key];

    $video = array(
        'title' => str_replace('.mp4', '', $item),
        'path' => $site_url .  $movie['baseurl'] . '/', 
        'mp4' => $item,
        'autoplay' => 1,
        'jpg' => $movie['image']
    );

    // get list chunk
    $chunkDetail = $modx->getObject('modChunk',array(
             'name' => $tplDetail
    ));
    $content .= $chunkDetail->process($video);
}


//echo "<hr/><pre>";
//print_r( $listArray );
//echo "</pre>";

return $content;







