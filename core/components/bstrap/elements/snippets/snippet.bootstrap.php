<?php
/* BootstrapTheme Snippet */
if( !empty($_GET['theme']) ){	
    $theme = $_GET['theme'];
}else if ( empty($_SESSION['theme']) ){
    $theme = $modx->getOption('site_theme');
}else if (  empty($theme) ){
    $theme = $_SESSION['theme'];
}
$modx->toPlaceholder('site_theme',$theme);
$_SESSION['theme'] = $theme;
return "";