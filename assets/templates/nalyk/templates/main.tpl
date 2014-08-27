<!DOCTYPE HTML><html lang="en">
<head>
 <meta charset="utf-8">
 <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">

 <title>[[*longtitle]]</title>
 <meta name="description" content="">
 <meta name="author" content="">
 
 <meta name="viewport" content="width=device-width,initial-scale=1">

 <script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.1/jquery.min.js"></script>

<script src="/assets/templates/nalyk/js/skel.min.js">
{
prefix: "style",
resetCSS: true,
boxModel: "border",
grid: { gutters: 40 },
breakpoints: {
wide: { range: "1300-", containers: 1280, grid: { gutters: 60 } },
narrow: { range: "-1299", containers: "fluid", grid: { gutters: 50 } },
narrow960: { range: "-960" },
narrow740: { range: "-740" },
narrow460: { range: "-460", grid: { collapse: true } }
}
}
</script>
<script src="/assets/templates/nalyk/js/skel-panel.min.js" />
{
  panels: {
    navPanel: {
      breakpoints: "mobile",
      position: "left",
      style: "push",
      size: "80%",
      html: "..."
    }
  },
  overlays: {
    titleBar: {
      breakpoints: "mobile",
      position: "top-center",
      width: 200,
      height: 44,
      html: "..."
    },
    shareBar: {
      position: "bottom-right",
      width: 150,
      height: 60,
      html: "..."
    }
  }
}
</script>
 <link rel="shortcut icon" href="/assets/templates/nalyk/images/favicon.ico"> 
 <link rel="stylesheet" href="/assets/templates/nalyk/css/default.css">
 
</head>
<body>
 
<div class="container">
	<header class="navPanel">
		<div class="logo">nalyk</div>
		<!--img src="/assets/templates/nalyk/images/logo.png" alt="logo" class="logo" /-->
	</header>
	<div id="main" role="main">
	[[*content]]
	</div>
	<footer class="output wide active">
		<div>built by sofasurfer.ch</div>
	</footer>
</div> <!--! end of #container -->
 
<!--[if lt IE 7 ]>
 <script src="//ajax.googleapis.com/ajax/libs/chrome-frame/1.0.2/CFInstall.min.js"></script>
 <script>window.attachEvent("onload",function(){CFInstall.check({mode:"overlay"})})</script>
<![endif]-->
 
</body>
</html>