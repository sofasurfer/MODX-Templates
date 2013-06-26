<?php
/**
 * Cache the output of any MODx Element using a configurable cacheHandler
 *
 * @author Jason Coward <jason@modx.com>
 * @version 1.0.0-pl
 * @since October 24, 2010
 * @package getcache
 */
$output = '';

$modx->setLogLevel(modX::LOG_LEVEL_INFO);


$properties = $scriptProperties;
/* Unset these to prevent filters from being applied to the element being processed
 * See http://bugs.modx.com/issues/2609
 */
unset($properties['filter_commands']);
unset($properties['filter_modifiers']);

if (empty($cacheKey)) $cacheKey = $modx->getOption('cache_resource_key', null, 'custom_cache');
if (empty($cacheHandler)) $cacheHandler = $modx->getOption('cache_resource_handler', null, $modx->getOption(xPDO::OPT_CACHE_HANDLER, null, 'xPDOFileCache'));
if (!isset($cacheExpires)) $cacheExpires = (integer) $modx->getOption('cache_resource_expires', null, $modx->getOption(xPDO::OPT_CACHE_EXPIRES, null, 0));
if (empty($cacheElementKey)) $cacheElementKey = $modx->resource->getCacheKey() . '/' . md5($modx->toJSON($properties) . implode('', $modx->request->getParameters()));
$cacheOptions = array(
    xPDO::OPT_CACHE_KEY => $cacheKey,
    xPDO::OPT_CACHE_HANDLER => $cacheHandler,
    xPDO::OPT_CACHE_EXPIRES => $cacheExpires,
);

$cached = $modx->cacheManager->get($cacheElementKey, $cacheOptions);
if (!isset($cached['properties']) || !isset($cached['output'])) {


        $output = $input;

        $properties['cachetime'] = time();    

        if ($modx->getCacheManager()) {
            $cached = array('properties' => $properties, 'output' => $output);
            $modx->cacheManager->set($cacheElementKey, $cached, $cacheExpires, $cacheOptions);
        }
        $modx->log(modX::LOG_LEVEL_INFO, "SET Cache: " . $cacheKey." ".$cacheElementKey . "\n" . print_r($cacheOptions,true) );


} else {
    $modx->log(modX::LOG_LEVEL_INFO, "GET Cache: " . $cacheKey." ".$cacheElementKey . " Time: " . $cacheTime );

    $properties = $cached['properties'];
    $output = $cached['output'];
}
$modx->setPlaceholders($properties, $properties['namespace']);
if (!empty($properties['toPlaceholder'])) {
    $modx->setPlaceholder($properties['toPlaceholder'], $output);
    $output = '';
}

return $output;