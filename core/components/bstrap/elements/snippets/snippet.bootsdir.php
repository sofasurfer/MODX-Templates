<?php
$output = "";

$total = 0;
$limit = $modx->getOption('limit',$scriptProperties,10);
$offset = $modx->getOption('offset',$scriptProperties,0);
$totalVar = $modx->getOption('totalVar', $scriptProperties, 'total');

$sort = $modx->getOption('sort',$scriptProperties,'title');
$dir = $modx->getOption('dir',$scriptProperties,'DESC');
$tpl = $modx->getOption('tpl',$scriptProperties,false);

$bytestotal=0;
$nbfiles=0;
$pathName = $directory;
$ignore = $modx->getOption('ignore',$scriptProperties,".,..,._");
$ignoreArray = explode(",",$ignore);

/**
 * Function to Sort Array
 * @param $a The Array to Sort
 * @param &b The Fields to Sort
 */
function array_sort_func($a,$b=NULL) { 
   static $keys; 
   if($b===NULL) return $keys=$a; 
   foreach($keys as $k) { 
      if(@$k[0]=='!') { 
         $k=substr($k,1); 
         if(@$a[$k]!==@$b[$k]) { 
            return strcmp(@$b[$k],@$a[$k]); 
         } 
      } 
      else if(@$a[$k]!==@$b[$k]) { 
         return strcmp(@$a[$k],@$b[$k]); 
      } 
   } 
   return 0; 
} 

function array_sort(&$array) { 
   if(!$array) return $keys; 
   $keys=func_get_args(); 
   array_shift($keys); 
   array_sort_func($keys); 
   usort($array,"array_sort_func");        
}

function cmp($a, $b)
{
    if ($a == $b) {
        return 0;
    }
    return ($a < $b) ? -1 : 1;
}
function cmp2($a, $b)
{
    if ($a == $b) {
        return 0;
    }
    return ($a > $b) ? -1 : 1;
}


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
				$time = filemtime(basename($filename));
				$pathName = str_replace($directory,$path,$cur->getPath());
				if( strpos($pathName,"/") == 0 ){	
						$pathName = substr($pathName,1);
				}

				$stat = stat( $cur->getPathname() );
				$info = pathinfo($filename);	
				$type = $info['extension'];	
				$key = md5($pathName);
				$listArray[$key]['path'] = $pathName;			
				$listArray[$key]['directory'] = $info['dirname'];			
				$listArray[$key]['time'] =$stat['mtime'];
				$listArray[$key]['title'] = basename($pathName,'.'.$info['extension']);
				
				// Get file details
				$listArray[$key][$type] = $cur->getFilename();
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
			if( !empty($properties['txt']) ){
				$infoFile = $properties['directory'] . "/" . $properties['txt'];
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
						}				    }
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
				$properties['image'] = $properties['path'] . "/" . $properties['jpg'];
			}else if( !empty($properties['png']) ){
				$properties['image'] = $properties['path'] . "/" . $properties['png'];				
			}else{
				$properties['image'] = "assets/templates/bootstrap/themes/default/img/sad.jpg";
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