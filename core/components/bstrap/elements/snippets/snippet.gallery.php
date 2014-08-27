<?php
/**
 * Gallery
 *
 * Copyright 2010-2012 by Shaun McCormick <shaun@modx.com>
 *
 * Gallery is free software; you can redistribute it and/or modify it under the
 * terms of the GNU General Public License as published by the Free Software
 * Foundation; either version 2 of the License, or (at your option) any later
 * version.
 *
 * Gallery is distributed in the hope that it will be useful, but WITHOUT ANY
 * WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS FOR
 * A PARTICULAR PURPOSE. See the GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License along with
 * Gallery; if not, write to the Free Software Foundation, Inc., 59 Temple
 * Place, Suite 330, Boston, MA 02111-1307 USA
 *
 * @package gallery
 */
/**
 * The main Gallery snippet.
 *
 * @var modX $modx
 * @var Gallery $gallery
 * 
 * @package gallery
 */
$gallery = $modx->getService('gallery','Gallery',$modx->getOption('gallery.core_path',null,$modx->getOption('core_path').'components/gallery/').'model/gallery/',$scriptProperties);
if (!($gallery instanceof Gallery)) return '';
$modx->lexicon->load('gallery:web');


$modx->setLogLevel(modX::LOG_LEVEL_ERROR);


/* check for REQUEST vars if property set */
$pageSlider = $modx->getOption('pageSlider',$scriptProperties,1);
$pageSliderContent = $modx->getOption('pageSliderContent',$scriptProperties,"");
$imageGetParam = $modx->getOption('imageGetParam',$scriptProperties,'galItem');
$albumRequestVar = $modx->getOption('albumRequestVar',$scriptProperties,'galAlbum');
$tagRequestVar = $modx->getOption('tagRequestVar',$scriptProperties,'galTag');
if ($modx->getOption('checkForRequestAlbumVar',$scriptProperties,true)) {
    if (!empty($_REQUEST[$albumRequestVar])) $scriptProperties['album'] = $_REQUEST[$albumRequestVar];
}
if ($modx->getOption('checkForRequestTagVar',$scriptProperties,true)) {
    if (!empty($_REQUEST[$tagRequestVar])) $scriptProperties['tag'] = $_REQUEST[$tagRequestVar];
}
if (empty($scriptProperties['album']) && empty($scriptProperties['tag'])) return '';

$totalVar = $modx->getOption('totalVar',$scriptProperties,'total');
$pageNo = $modx->getOption('page',$scriptProperties,1);
if(  !empty($_REQUEST['sort'])){
    $scriptProperties['sort'] = $_REQUEST['sort'];
}
if(  !empty($_REQUEST['dir'])){
    $scriptProperties['dir'] = $_REQUEST['dir'];
}
$sort = $modx->getOption('sort',$scriptProperties,'name');

/* load plugins */
$plugin = $modx->getOption('plugin',$scriptProperties,'');
if (!empty($plugin)) {
    $pluginPath = $modx->getOption('pluginPath',$scriptProperties,'');
    if (empty($pluginPath)) {
        $pluginPath = $gallery->config['modelPath'].'gallery/plugins/';
    }
    /** @var GalleryPlugin $plugin */
    if (($className = $modx->loadClass($plugin,$pluginPath,true,true))) {
        $plugin = new $className($gallery,$scriptProperties);
        $plugin->load();
        $scriptProperties = $plugin->adjustSettings($scriptProperties);
    } else {
        return $modx->lexicon('gallery.plugin_err_load',array('name' => $plugin,'path' => $pluginPath));
    }
} else {
    if ($modx->getOption('useCss',$scriptProperties,true)) {
        $modx->regClientCSS($gallery->config['cssUrl'].'web.css');
    }
}

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
if (empty($cacheElementKey)) $cacheElementKey =  $scriptProperties['album'] . "/" . md5($modx->toJSON($properties) . implode('', $modx->request->getParameters())) . "_" . $pageNo;

$cacheOptions = array(
    xPDO::OPT_CACHE_KEY => $cacheKey,
    xPDO::OPT_CACHE_HANDLER => $cacheHandler,
    xPDO::OPT_CACHE_EXPIRES => $cacheExpires,
);
//$cacheKey = $modx->getOption('cacheKey',$scriptProperties, "gallery/results/" . md5(serialize($scriptProperties))  );
//$cacheKey = $modx->getOption('cacheKey',$scriptProperties, "/opt/gallery/results/" . md5(serialize($scriptProperties))  );

$cacheData = $modx->cacheManager->get($cacheElementKey, $cacheOptions);
if( empty($cacheData) && $cacheKey !== false ){

    set_time_limit(240);

    $data = $modx->call('galItem','getList',array(&$modx,$scriptProperties));

    if( empty($data) ){
        return 'Gallery not found';
    }

    /* iterate */
    $imageProperties = $modx->getOption('imageProperties',$scriptProperties,'');
    $imageProperties = !empty($imageProperties) ? $modx->fromJSON($imageProperties) : array();
    $imageProperties = array_merge(array(
        'w' => (int)$modx->getOption('imageWidth',$scriptProperties,1024),
        'h' => (int)$modx->getOption('imageHeight',$scriptProperties,728),
        'zc' => (boolean)$modx->getOption('imageZoomCrop',$scriptProperties,0),
        'far' => (string)$modx->getOption('imageFar',$scriptProperties,false),
        'q' => (int)$modx->getOption('imageQuality',$scriptProperties,95),
        'f' => (string)$modx->getOption('thumbFormat',$scriptProperties,'jpeg'),
    ),$imageProperties);

    $thumbProperties = $modx->getOption('thumbProperties',$scriptProperties,'');
    $thumbProperties = !empty($thumbProperties) ? $modx->fromJSON($thumbProperties) : array();
    $thumbProperties = array_merge(array(
        'w' => (int)$modx->getOption('thumbWidth',$scriptProperties,100),
        'h' => (int)$modx->getOption('thumbHeight',$scriptProperties,100),
        'zc' => (boolean)$modx->getOption('thumbZoomCrop',$scriptProperties,1),
        'far' => (string)$modx->getOption('thumbFar',$scriptProperties,false),
        'q' => (int)$modx->getOption('thumbQuality',$scriptProperties,90),
        'f' => (string)$modx->getOption('thumbFormat',$scriptProperties,'jpeg'),

    ),$thumbProperties);

    $idx = 0;
    $output = array();
    $filesUrl = $modx->call('galAlbum','getFilesUrl',array(&$modx));
    $filesPath = $modx->call('galAlbum','getFilesPath',array(&$modx));
    $itemCls = $modx->getOption('itemCls',$scriptProperties,'gal-item');
    $thumbCls = $modx->getOption('thumbCls',$scriptProperties,'thumbnail');
    $imageAttributes = $modx->getOption('imageAttributes',$scriptProperties,'');
    $linkAttributes = $modx->getOption('linkAttributes',$scriptProperties,'');
    $linkToImage = $modx->getOption('linkToImage',$scriptProperties,false);
    $activeCls = $modx->getOption('activeCls',$scriptProperties,'gal-item-active');
    $activeItem = $modx->getOption('activeItem',$scriptProperties,false);

    $highlightItem = $modx->getOption($imageGetParam,$_REQUEST,false);

    $albumTags = array();

    if( empty($data['items']) ){

        $output[] = "No data found";

    }else{

        /** @var galItem $item */
        foreach ($data['items'] as $item) {


            if( empty($cacheAlbumData[$item->get('id')]) ){

                $cacheAlbumIsDirty = true;
                $itemArray = $item->toArray();
                //$itemArray = array_merge($scriptProperties,$itemArray);

                $itemArray['idx'] = $idx;
                $itemArray['total'] = $data['total'];
                $itemArray['cls'] = $itemCls;
                if ($itemArray['id'] == $highlightItem || $itemArray['id'] == $activeItem) {
                    $itemArray['cls'] .= ' '.$activeCls;
                }

                $itemArray['thumbWidth'] = $thumbWidth;
                $itemArray['thumbHeight'] = $thumbHeight;
                $itemArray['filename'] = basename($item->get('filename'));
                $itemArray['image_absolute'] = $filesUrl.$item->get('filename');
                $itemArray['fileurl'] = $itemArray['image_absolute'];
                $itemArray['filepath'] = $filesPath.$item->get('filename');
                $itemArray['filesize'] = $item->get('filesize');
                
                $itemArray['pageSlider'] = $pageSlider;
                $itemArray['pageSliderContent'] = $pageSliderContent;


                //$itemArray['thumbnail'] = $item->get('thumbnail',$thumbProperties);
                $itemArray['thumbProperties'] = http_build_query($thumbProperties);
                $itemArray['thumbnail'] = $modx->runSnippet("phpthumbof",array(
                    'input' => $itemArray['filepath'], 
                    'options' => $itemArray['thumbProperties'] 
                ));

                $itemArray['image'] = $itemArray['image_absolute'];
                
                $itemArray['imageProperties'] = http_build_query($imageProperties);
                $itemArray['image'] = $modx->runSnippet("phpthumbof",array(
                    'input' => $itemArray['image_absolute'], 
                    'options' => $itemArray['imageProperties']
                ));
                
                $itemArray['url'] = $itemArray['fileurl'];


                $itemArray['image_attributes'] = $imageAttributes;
                $itemArray['link_attributes'] = $linkAttributes;
                if (!empty($scriptProperties['album'])) $itemArray['album'] = $scriptProperties['album'];
                if (!empty($scriptProperties['tag'])) $itemArray['tag'] = $scriptProperties['tag'];
                $itemArray['linkToImage'] = $linkToImage;
                //$itemArray['url'] = $item->get('url');
                $itemArray['imageGetParam'] = $imageGetParam;
                $itemArray['albumRequestVar'] = $albumRequestVar;
                $itemArray['tagRequestVar'] = $tagRequestVar;



                if( !empty($itemArray['tags']) ){
                    $itemTags = explode(',', $itemArray['tags'] );
                    foreach($itemTags as $itemTag ){
                        if( !in_array($itemTag, $albumTags) ){
                            array_push($albumTags,$itemTag);
                        }
                    }
                }

                if ($plugin) {
                    $plugin->renderItem($itemArray);
                }
                $itemHtml = $gallery->getChunk($modx->getOption('thumbTpl',$scriptProperties,'galItemThumb'),$itemArray);
                $cacheAlbumData[$item->get('id')] = $itemHtml;



            }else{
                $itemHtml = $cacheAlbumData[$item->get('id')];
            }
            $output[] = $itemHtml;        
            $idx++;

        }

    }

    $output = implode("\n",$output);

    /* if set, place in a container tpl */
    $containerTpl = $modx->getOption('containerTpl',$scriptProperties,false);
    if (!empty($containerTpl) && $idx > 0 ) {
        $ct = $gallery->getChunk($containerTpl,array(
            'thumbnails' => $output,
            'album_name' => $data['album']['name'],
            'album_description' => $data['album']['description'],
            'albumRequestVar' => $albumRequestVar,
            'albumId' => $data['album']['id'],
        ));
        if (!empty($ct)) $output = $ct;
    }

    /* set to placeholders or output directly */
    $toPlaceholder = $modx->getOption('toPlaceholder',$scriptProperties,false);
    if (!empty($toPlaceholder)) {
        $placeholders = array(
            $toPlaceholder => $output,
            $toPlaceholder.'.id' => $data['album']['id'],
            $toPlaceholder.'.name' => $data['album']['name'],
            $toPlaceholder.'.description' => $data['album']['description'],
            $toPlaceholder.'.total' => $data['total'],
            $toPlaceholder.'.albumTags' => implode(",", $albumTags )
        );
        $output = "";
    } else {
        $placeholderPrefix = $modx->getOption('placeholderPrefix',$scriptProperties,'gallery.');
        $placeholders = array(
            $placeholderPrefix.'id' => $data['album']['id'],
            $placeholderPrefix.'name' => $data['album']['name'],
            $placeholderPrefix.'description' => $data['album']['description'],
            $placeholderPrefix.'total' => $data['total'],
            $placeholderPrefix.'.albumTags' => implode(",", $albumTags  )     
        );
    }
    $placeholders[$totalVar] = $data['total'];
    $placeholders['pageNo'] = $pageNo;
    $placeholders['sort'] = $sort;

    // Set cache result
    $cacheData['cachetime'] = time();
    $cacheData['placeholders'] = $placeholders;
    $cacheData['output'] = $output;      

    if ($modx->getCacheManager()) {
        $cached = array('properties' => $properties, 'output' => $output);
        $modx->cacheManager->set($cacheElementKey, $cacheData, $cacheExpires, $cacheOptions);
    }
    
    $modx->log(modX::LOG_LEVEL_INFO, "SET Gallery Cache: " . $cacheKey." ".$cacheElementKey . "\n" . print_r($cacheOptions,true) );

}else{
    $placeholders = $cacheData['placeholders'];
    $output = $cacheData['output'];
    
    $cacheArray = array('cachetime'=> date("Y-m-d h:m:s", intval($cacheData['cachetime']) ) );
    $cacheTime = $gallery->getChunk('tpl.gallery.debug',$cacheArray);
    //$cacheTime = ((time()-intval($cacheData['cachetime'])));
    //$cacheTime = $cacheTime . " sec";
    $modx->log(modX::LOG_LEVEL_INFO, "GET Gallery Cache: " . $cacheKey." ".$cacheElementKey." page: $pageNo time: " . $cacheTime );
}

$placeholders['sort'] = $sort;
$placeholders['gallerycacheage'] = $cacheTime;
$placeholders['gallerytotal'] = number_format($placeholders[$totalVar],0);
$placeholders['gallerycachetime'] = $cacheData['cachetime'];
$placeholders['gallerycachedate'] = date("Y-m-d h:m:s", intval($cacheData['cachetime']) );
$modx->toPlaceholders($placeholders);

//$modx->log(modX::LOG_LEVEL_INFO, "Gallery: " .  print_r($scriptProperties,true) );

return $output;