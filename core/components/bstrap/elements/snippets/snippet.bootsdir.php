<?php
error_reporting(E_ERROR | E_PARSE);
set_time_limit(180);

include_once( MODX_CORE_PATH . 'components/bstrap/elements/snippets/functions.php');

$output = "";

$total = 0;
if( !empty($_GET) ){
	$scriptProperties = array_merge($scriptProperties,$_GET);	
}
$limit = $modx->getOption('limit',$scriptProperties,10);
$offset = $modx->getOption('offset',$scriptProperties,0);
$totalVar = $modx->getOption('totalVar', $scriptProperties, 'total');

$sort = $modx->getOption('sort',$scriptProperties,'title');
$dir = $modx->getOption('dir',$scriptProperties,'ASC');
$tpl = $modx->getOption('tpl',$scriptProperties,false);
$thumbTpl = $modx->getOption('thumbTpl',$scriptProperties,'tpl.gallery.thumb');
$width = $modx->getOption('width',$scriptProperties,160);
$height = $modx->getOption('height',$scriptProperties,120);

$imageBlank = $modx->getOption('image_blank',$scriptProperties,false);

$path = $modx->getOption('path',$scriptProperties,false);
$source = $modx->getOption('source',$scriptProperties,1);
$modx->loadClass('sources.modMediaSource');
$mediaSource = $modx->getObject('sources.modMediaSource',$source );

/**
 * Load Cache
 */
$properties = $scriptProperties;
/* Unset these to prevent filters from being applied to the element being processed
* See http://bugs.modx.com/issues/2609
*/
unset($properties['filter_commands']);
unset($properties['filter_modifiers']);

if (empty($cacheKey)) $cacheKey = $modx->getOption('cache_resource_key', $properties, 'gallery');
if (empty($cacheHandler)) $cacheHandler = $modx->getOption('cache_resource_handler', null, $modx->getOption(xPDO::OPT_CACHE_HANDLER, null, 'xPDOFileCache'));
if (!isset($cacheExpires)) $cacheExpires = (integer) $modx->getOption('cache_expires', null, $modx->getOption(xPDO::OPT_CACHE_EXPIRES, null, 0));
//if (empty($cacheElementKey)) $cacheElementKey = $modx->resource->getCacheKey() . '/' . md5($modx->toJSON($properties) . implode('', $modx->request->getParameters()));
if (empty($cacheElementKey)) $cacheElementKey = str_replace("/", "", $path) . "/" . md5($modx->toJSON($properties) . implode('', $modx->request->getParameters()));
$cacheOptions = array(
    xPDO::OPT_CACHE_KEY => $cacheKey,
    xPDO::OPT_CACHE_HANDLER => $cacheHandler,
    xPDO::OPT_CACHE_EXPIRES => $cacheExpires,
);
//$cacheKey = $modx->getOption('cacheKey',$scriptProperties, "gallery/results/" . md5(serialize($scriptProperties))  );
//$cacheKey = $modx->getOption('cacheKey',$scriptProperties, "/opt/gallery/results/" . md5(serialize($scriptProperties))  );

$cacheData = $modx->cacheManager->get($cacheElementKey, $cacheOptions);
if( empty($cacheData) && $cacheKey !== false ){

	if( !empty($mediaSource) ){
		$mediaSourceArray = $mediaSource->get('properties');
		$mediaSourceId = $mediaSource->get('id');
		$basePath = $mediaSourceArray['basePath']['value'];
		$baseUrl = $mediaSourceArray['baseUrl']['value'];
	}

	$directory = $basePath . $path;
	$bytestotal=0;
	$nbfiles=0;
	$pathName = $directory;
	$ignore = $modx->getOption('ignore',$scriptProperties,".,..,._");
	$ignoreArray = explode(",",$ignore);

	$thumbProperties = $modx->getOption('thumbProperties',$scriptProperties,'');
	$thumbProperties = !empty($thumbProperties) ? $modx->fromJSON($thumbProperties) : array();
	$thumbProperties = array_merge(array(
	    'w' => (int)$modx->getOption('thumbWidth',$scriptProperties,100),
	    'h' => (int)$modx->getOption('thumbHeight',$scriptProperties,100),
	    'zc' => (boolean)$modx->getOption('thumbZoomCrop',$scriptProperties,1),
	    'far' => (string)$modx->getOption('thumbFar',$scriptProperties,false),
	    'aoe' => (string)$modx->getOption('thumbAoe',$scriptProperties,false),
	    'q' => (int)$modx->getOption('thumbQuality',$scriptProperties,90),
	    'f' => (string)$modx->getOption('thumbFormat',$scriptProperties,'jpeg'),

	),$thumbProperties);


	$listArray = array();
	if( file_exists($directory) == false ){

	    $output = "Directory $directory not found!";

	}else{

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

					if( $type == "html" ){
						
					}
					
					$listArray[$key]['createdon'] = $stat['mtime'];
					$listArray[$key]['name'] = $pathTitle;
					$listArray[$key]['directory'] = $info['dirname'];			
					$listArray[$key]['path'] = $baseUrl . $pathName;			
					$listArray[$key]['baseurl'] = $baseUrl . $pathName;			
					
					// Get file details
					$listArray[$key][$type] = $fileName;
					$listArray[$key][$type.'.time'] 		= $stat['mtime'];				
					$listArray[$key][$type.'.extension'] 	= $info['extension'];	
					$listArray[$key][$type.'.type'] 	= filetype($cur);
					$listArray[$key][$type.'.size'] 	= $cur->getSize();	
					$nbfiles++;
				}
			}
		}
	}

	$total = $limit;
	if($total > count($listArray) ){
		$total = count($listArray);
	}

	array_sort($listArray,$sort);

	if(  $dir == 'DESC' ){
		$listArray = array_reverse($listArray);
	}


	// Loop Folders
	$count = 0;
	$list = array();
	foreach( $listArray as $itemArray ){
			
			if( $count < ($limit+$offset) && $count >= $offset ){
				
				$properties = array();
				$properties = $itemArray;

				// Get additional info
				if( !empty($properties['json']) ){
					$infoFile = $properties['directory'] . "/" . $properties['json'];
					$handle = @fopen( $infoFile , "r");
					if ($handle) {
					    while (($buffer = fgets($handle, 4096)) !== false) {
							$lineArray = explode(" : ",$buffer);
							if( strpos($lineArray[0],"Width") !== false ){
								$properties['image_width'] =  trim($lineArray[1]) ;
							}
							if( strpos($lineArray[0],"Height") !== false ){
								$properties['image_height'] =  trim($lineArray[1]) ;
							}
							if( strpos($lineArray[0],"Duration") !== false ){
								$properties['duration'] =  trim($lineArray[1]) ;
							}
							if( strpos($lineArray[0],"File Name") !== false ){
								$properties['title'] =  trim($lineArray[1]) ;
							}										     
							//if( strpos($lineArray[0],"Create Date ") !== false ){
							//	$properties['createdon'] =  trim($lineArray[1]) ;
							//}	
						}
					    if (!feof($handle)) {
					        echo "Error: unexpected fgets() fail\n";
					    }
					    fclose($handle);
					}else{
						echo "Error: invalid file " .  $infoFile . "\n";
					}

				}

				// Get Image
				if( !empty($properties['jpg']) ){
					$properties['image'] = $properties['directory'] . '/' . $properties['jpg'];
				}else if( !empty($properties['png']) ){
					$properties['image'] = $properties['directory'] . '/' . $properties['png'];				
				}else{
					$properties['image'] = $imageBlank;								
				}

	            $properties['thumbProperties'] = http_build_query($thumbProperties);
	            $properties['thumbnail'] = $modx->runSnippet("phpthumbof",array(
	                'input' => $properties['image'], 
	                'options' => $properties['thumbProperties']
	            ));


				// Set Link
				if( !empty($properties['html']) ){
					$properties['url'] = $properties['path'] . '/' . $properties['html'];						
				}
				
				$properties['data-target'] = $properties['path'] . '/';
				$properties['cls'] = $itemCls;
				$properties['total'] = $total;
				$properties['count'] = $count;
				$properties['idx'] = $count;

	            // get list chunk
	            $chunkCaption = $modx->getObject('modChunk',array(
	                'name' => 'tpl.gallery.caption'
	            ));
				$properties['data-content'] = $chunkCaption->process($properties);

				
				if( !empty($_REQUEST['debug']) ){
					echo "<pre>" . print_r($properties,true)  . "</pre>";
					//$properties['debug'] = "<pre>" . print_r($properties,true)  . "</pre>";
				}			

				$properties = array_merge($scriptProperties, $properties);
				
	            // get list chunk
	            $chunk = $modx->getObject('modChunk',array(
	                'name' => $thumbTpl
	            ));
				$output .= $chunk->process($properties);
			}	
			$count++;	
	}
    // Set cache result
    $placeholders = array();
    $placeholders[$totalVar] = $count;
    $placeholders['title'] = $properties['title'];

    $cacheData['cachetime'] = time();    
    $cacheData['placeholders'] = $placeholders;       
    $cacheData['output'] = $output;      

    if ($modx->getCacheManager()) {
        $cached = array('properties' => $properties, 'output' => $output);
        $modx->cacheManager->set($cacheElementKey, $cacheData, $cacheExpires, $cacheOptions);
    }
    
    $modx->log(modX::LOG_LEVEL_INFO, "SET directory Cache: " . $cacheKey." ".$cacheElementKey . "\n" . print_r($cacheOptions,true) );

}else{
    $placeholders = $cacheData['placeholders'];
    $output = $cacheData['output'];
    
    $cacheArray = array('cachetime'=> date("Y-m-d h:m:s", intval($cacheData['cachetime']) ) );
	$chunk = $modx->getObject('modChunk',array(
	    'name' => 'tpl.gallery.debug'
	));
	$cacheTime = $chunk->process($cacheArray);
    $modx->log(modX::LOG_LEVEL_INFO, "GET directory Cache: " . $cacheKey." ".$cacheElementKey." page: $pageNo time: " . $cacheTime . "");
}

$placeholders['gallerycacheage'] = $cacheTime;
$placeholders['gallerytotal'] = number_format($placeholders[$totalVar],0);
$placeholders['gallerycachetime'] = $cacheData['cachetime'];
$placeholders['gallerycachedate'] = date("Y-m-d h:m:s", intval($cacheData['cachetime']) );
$modx->toPlaceholders($placeholders);

//$modx->log(modX::LOG_LEVEL_INFO, "Gallery: " .  print_r($scriptProperties,true) );

return $output;