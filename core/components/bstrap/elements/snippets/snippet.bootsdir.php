<?php
error_reporting(E_ERROR | E_PARSE);

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
$dir = $modx->getOption('dir',$scriptProperties,'DESC');
$tpl = $modx->getOption('tpl',$scriptProperties,false);
$width = $modx->getOption('width',$scriptProperties,160);
$height = $modx->getOption('height',$scriptProperties,120);

$path = $modx->getOption('path',$scriptProperties,false);
$source = $modx->getOption('source',$scriptProperties,1);
$modx->loadClass('sources.modMediaSource');
$mediaSource = $modx->getObject('sources.modMediaSource',$source );

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
				
				$listArray[$key]['time'] = $stat['mtime'];
				$listArray[$key]['title'] = $pathTitle;
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
				$properties['image'] = $properties['path'] . '/' . $properties['jpg'];
			}else if( !empty($properties['png']) ){
				$properties['image'] = $properties['path'] . '/' . $properties['png'];				
			}else{
				$properties['image'] = $baseUrl . "_build/blank.jpg";								
			}
			
			// Set Link
			if( !empty($properties['html']) ){
				$properties['href'] = $properties['path'] . '/' . $properties['html'];						
			}

			$properties['count'] = $count;
			
			if( !empty($_REQUEST['debug']) ){
				echo "<pre>" . print_r($properties,true)  . "</pre>";
				//$properties['debug'] = "<pre>" . print_r($properties,true)  . "</pre>";
			}			
			$properties = array_merge($scriptProperties, $properties);
			
            // get list chunk
            $chunk = $modx->getObject('modChunk',array(
                'name' => $tpl
            ));
			$output .= $chunk->process($properties);
		}	
		$count++;	
}
$modx->setPlaceholder('title',$properties['title']);
$modx->setPlaceholder($totalVar,$count);

return $output;