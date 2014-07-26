<?php
	
	/* 	Flickr Gallery Script by Daniel Spillere Andrade - www.danielandrade.net
		based on
	*/
	
	// PHP CONFIG FILE
	include("config.php");

	if (isset($_REQUEST["g"])){
		$g = intval($_GET["g"]);
		$data = simplexml_load_file('https://api.flickr.com/services/rest/?&method=flickr.photosets.getPhotos&api_key=2fd3128637e223572f1cb7ea3eeb8d87&user_id=49885927@N02&photoset_id='.$g);
	}

?>

<!DOCTYPE html>
<html lang="en-US">
<head>
	<meta charset="UTF-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Photo Gallery</title>
	<link rel='stylesheet' id='colorbox-theme3-css'  href='css/colorbox.css?ver=4.6' type='text/css' media='screen' />
	<link rel='stylesheet' id='justifiedGalleryCSS-css'  href='css/justifiedGallery.min.css?ver=3.9.1' type='text/css' media='all' />
	<link rel='stylesheet' id='swipeboxCSS-css'  href='css/swipebox.min.css?ver=3.9.1' type='text/css' media='all' />
	<link rel='stylesheet' id='bootstrap-css'  href='css/bootstrap.min.css?ver=1.0' type='text/css' media='all' />
	<script type='text/javascript' src='js/jquery.js?ver=1.11.0'></script>
	<script type='text/javascript' src='jjs/query-migrate.min.js?ver=1.2.1'></script>
	<script type='text/javascript'>
	/* <![CDATA[ */
		var jQueryColorboxSettingsArray = {"jQueryColorboxVersion":"4.6","colorboxInline":"false","colorboxIframe":"false","colorboxGroupId":"","colorboxTitle":"","colorboxWidth":"false","colorboxHeight":"false","colorboxMaxWidth":"false","colorboxMaxHeight":"false","colorboxSlideshow":"false","colorboxSlideshowAuto":"false","colorboxScalePhotos":"true","colorboxPreloading":"true","colorboxOverlayClose":"true","colorboxLoop":"true","colorboxEscKey":"true","colorboxArrowKey":"false","colorboxScrolling":"true","colorboxOpacity":"0.85","colorboxTransition":"elastic","colorboxSpeed":"350","colorboxSlideshowSpeed":"2500","colorboxClose":"close","colorboxNext":"next","colorboxPrevious":"previous","colorboxSlideshowStart":"start slideshow","colorboxSlideshowStop":"stop slideshow","colorboxCurrent":"{current} of {total} images","colorboxXhrError":"This content failed to load.","colorboxImgError":"This image failed to load.","colorboxImageMaxWidth":"100%","colorboxImageMaxHeight":"100%","colorboxImageHeight":"false","colorboxImageWidth":"false","colorboxLinkHeight":"false","colorboxLinkWidth":"false","colorboxInitialHeight":"100","colorboxInitialWidth":"300","autoColorboxJavaScript":"","autoHideFlash":"","autoColorbox":"true","autoColorboxGalleries":"","addZoomOverlay":"","useGoogleJQuery":"","colorboxAddClassToLinks":""};
	/* ]]> */
	</script>
	<script type='text/javascript' src='js/jquery.colorbox-min.js?ver=1.3.21'></script>
	<script type='text/javascript' src='js/jquery-colorbox-wrapper-min.js?ver=4.6'></script>
	<script type='text/javascript' src='js/jquery.justifiedGallery.min.js?ver=3.9.1'></script>
	<script type='text/javascript' src='js/jquery.swipebox.min.js?ver=3.9.1'></script>
	<script type='text/javascript' src='js/bootstrap.min.js?ver=1.2'></script>
</head>

<body class="page page-id-670 page-child parent-pageid-240 page-template-default">

<?php if (isset($g)) { ?>

<h1><?php echo $data->photoset['title']; ?></h1>

<div id="flickrGal0">
<?php  

	foreach ($data->photoset->photo as $pic):
	  $id = $pic['id'];
	  $secret = $pic['secret'];
	  $server = $pic['server'];
	  $farm = $pic['farm']; 
	  $title = $pic['title'];
	  echo '<a href="https://farm'.$farm.'.staticflickr.com/'.$server.'/'.$id.'_'.$secret.'_b.jpg" onclick="javascript:_gaq.push([\'_trackEvent\',\'outbound-article\',\'http://farm'.$farm.'.staticflickr.com\']);" rel="flickrGal0" title="'.$title.'"><img class="colorbox-670"  alt="'.$title.'" src="https://farm'.$farm.'.staticflickr.com/'.$server.'/'.$id.'_'.$secret.'_n.jpg" data-safe-src="https://farm'.$farm.'.staticflickr.com/'.$server.'/'.$id.'_'.$secret.'_n.jpg" /></a>';
	endforeach;
?>
</div>
<?php } ?>


  <script type="text/javascript">
	jQuery("#flickrGal0").on('jg.rowflush', function() {jQuery(this).find("> a").colorbox({maxWidth : "100%",maxHeight : "100%",current : ""});}).justifiedGallery({'lastRow': 'justify', 'rowHeight':250, 'fixedHeight':false, 'captions':true, 'randomize':false, 'margins':10});
  </script>

<script type='text/javascript'>
  (function(){
	var corecss = document.createElement('link');
	var themecss = document.createElement('link');
	var corecssurl = "css/shCore.css?ver=3.0.9";
	if ( corecss.setAttribute ) {
		corecss.setAttribute( "rel", "stylesheet" );
		corecss.setAttribute( "type", "text/css" );
		corecss.setAttribute( "href", corecssurl );
	} else {
		corecss.rel = "stylesheet";
		corecss.href = corecssurl;
	}
	document.getElementsByTagName("head")[0].insertBefore( corecss, document.getElementById("syntaxhighlighteranchor") );
	var themecssurl = "css/shThemeDefault.css?ver=3.0.9";
	if ( themecss.setAttribute ) {
		themecss.setAttribute( "rel", "stylesheet" );
		themecss.setAttribute( "type", "text/css" );
		themecss.setAttribute( "href", themecssurl );
	} else {
		themecss.rel = "stylesheet";
		themecss.href = themecssurl;
	}
	//document.getElementById("syntaxhighlighteranchor").appendChild(themecss);
	document.getElementsByTagName("head")[0].insertBefore( themecss, document.getElementById("syntaxhighlighteranchor") );
  })();
  SyntaxHighlighter.config.strings.expandSource = '+ expand source';
  SyntaxHighlighter.config.strings.help = '?';
  SyntaxHighlighter.config.strings.alert = 'SyntaxHighlighter\n\n';
  SyntaxHighlighter.config.strings.noBrush = 'Can\'t find brush for: ';
  SyntaxHighlighter.config.strings.brushNotHtmlScript = 'Brush wasn\'t configured for html-script option: ';
  SyntaxHighlighter.defaults['class-name'] = 'code';
  SyntaxHighlighter.defaults['gutter'] = false;
  SyntaxHighlighter.defaults['pad-line-numbers'] = 5;
  SyntaxHighlighter.defaults['toolbar'] = false;
  SyntaxHighlighter.all();
</script>

</body>
</html>