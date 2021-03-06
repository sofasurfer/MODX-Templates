<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="robots" content="index, follow">

    <title>[[!getBlogTitle]]</title>
    <meta name="description" content="[[*introtext:isnot=``:then=`[[*introtext:notags]]`:else=`[[*description:notags]]`]]" /> 
    <meta name="author" content="[[*publishedby:userinfo=`username`]]" />
    <link rel="canonical" href="[[++site_url]][[*id:isnot=`[[++site_start]]`:then=`[[~[[*id]]]]`]]" />
    <base href="[[++site_url]]" id="site_url" />
    <link href="https://fonts.googleapis.com/css?family=Roboto|Roboto+Slab&display=swap" rel="stylesheet">

    [[MinifyX?
        &jsSources=`
         /stream/assets/jquery/jquery.min.js,
         /stream/assets/bootstrap/3.3.5/js/bootstrap.min.js,
         /stream/assets/code-prettify/js/run_prettify.js,
         /stream/assets/blueimp-gallery/js/jquery.blueimp-gallery.min.js,
         /stream/assets/masonry/js/masonry.pkgd.min.js,
         /assets/templates/sofaweb/js/default.js
        `    
        &cssSources=`
         /stream/assets/font-awesome-4.5.0/css/font-awesome.min.css,
         /stream/assets/bootstrap/3.3.5/css/bootstrap.min.css,
         /stream/assets/blueimp-gallery/css/blueimp-gallery.min.css,
         /assets/templates/sofaweb/css/style.css
        `
    ]]
    [[+MinifyX.css]]
    <script type="text/javascript">
        var timerStart = Date.now();
    </script>    
</head>
<body class="[[!getBodyClass]]">
<!--[if lt IE 7]><p class=chromeframe>Your browser is <em>ancient!</em> <a href="http://browsehappy.com/">Upgrade to a different browser</a> or <a href="http://www.google.com/chromeframe/?redirect=true">install Google Chrome Frame</a> to experience this site.</p><![endif]-->
[[$tpl.navbar]]
