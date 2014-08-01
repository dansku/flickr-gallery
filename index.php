<?php
	
	/* 	
		Flickr Gallery Script by Daniel Spillere Andrade - www.danielandrade.net
		based on
	*/
	
	// PHP CONFIG FILE
	include("config.php");

	if (isset($_REQUEST["g"])){
		$g = intval($_GET["g"]);
		$data = simplexml_load_file('https://api.flickr.com/services/rest/?&method=flickr.photosets.getPhotos&api_key='.$key.'&user_id='.$id.'&photoset_id='.$g);
	}
	else{
		// Get a list of photosets
		$album = simplexml_load_file('https://api.flickr.com/services/rest/?method=flickr.photosets.getList&api_key='.$key.'&user_id='.$id);	
	}

?>

<!DOCTYPE html>
<html lang="en-US">
<head>
	<meta charset="UTF-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>daniel andrade - photos</title>

	<link href="css/lightbox.css" rel="stylesheet" />
	
	<link rel='stylesheet' href='css/justifiedGallery.min.css?ver=3.9.1' type='text/css' media='all' />
	<link rel='stylesheet' href='css/swipebox.min.css?ver=3.9.1' type='text/css' media='all' />
	<link rel='stylesheet' href='//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css' type='text/css' media='all' />
	<link rel='stylesheet' href='css/style.css' type='text/css' />
	<link rel='stylesheet' href='css/lightbox.css' type='text/css' media='all' />

	<script type='text/javascript' src='//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js'></script>
	<script type='text/javascript' src='js/query-migrate.min.js?ver=1.2.1'></script>
	<script type='text/javascript' src='js/jquery.justifiedGallery.min.js?ver=3.9.1'></script>
	<script type='text/javascript' src='js/jquery.swipebox.min.js?ver=3.9.1'></script>
	<script type='text/javascript' src='//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js'></script>
	<script type='text/javascript' src='js/lightbox.min.js'></script>

  <script src="js/lazy.js"></script>
  <script type="text/javascript" charset="utf-8">
  $(function() {
     $("img.lazy").lazyload({
         effect : "fadeIn"
     });
  });
  </script>
</head>

<body class="page page-id-670 page-child parent-pageid-240 page-template-default" style="background-color: rgb(51, 51, 51);">

<div class="header">
	<p class="alignleft"><span class="glyphicon glyphicon-user"></span> Daniel Andrade</p>
	<?php if (isset($g)){ echo '<a href="?"><p class="alignright"><span class="glyphicon glyphicon-chevron-left"></span> back to album list</p></a>';} ?>
	<div style="clear: both;"></div>
</div>

<?php 
	//	if g is set we load the pictures, otherwise the album list...
	if (isset($g)) { 
		echo "<h1>".$data->photoset['title']."</h1>";
		echo '<div id="flickrGal0">';

		foreach ($data->photoset->photo as $pic):
		  $id = $pic['id'];
		  $secret = $pic['secret'];
		  $server = $pic['server'];
		  $farm = $pic['farm']; 
		  $title = $pic['title'];
		  echo '<a data-lightbox="image-1" href="https://farm'.$farm.'.staticflickr.com/'.$server.'/'.$id.'_'.$secret.'_b.jpg" rel="flickrGal0" title="'.$title.'"><img alt="'.$title.'" src="https://farm'.$farm.'.staticflickr.com/'.$server.'/'.$id.'_'.$secret.'_n.jpg" data-safe-src="https://farm'.$farm.'.staticflickr.com/'.$server.'/'.$id.'_'.$secret.'_n.jpg" /></a>';
		endforeach;

		echo "</div>";
		?>

	<script type="text/javascript">
		jQuery("#flickrGal0").on('jg.rowflush', function() {jQuery(this).find("> a").colorbox({maxWidth : "100%",maxHeight : "100%",current : ""});}).justifiedGallery({'lastRow': 'justify', 'rowHeight':250, 'fixedHeight':false, 'captions':true, 'randomize':false, 'margins':10});
		(function(){var e=document.createElement("link");var t=document.createElement("link");var n="css/shCore.css?ver=3.0.9";if(e.setAttribute){e.setAttribute("rel","stylesheet");e.setAttribute("type","text/css");e.setAttribute("href",n)}else{e.rel="stylesheet";e.href=n}document.getElementsByTagName("head")[0].insertBefore(e,document.getElementById("syntaxhighlighteranchor"));var r="css/shThemeDefault.css?ver=3.0.9";if(t.setAttribute){t.setAttribute("rel","stylesheet");t.setAttribute("type","text/css");t.setAttribute("href",r)}else{t.rel="stylesheet";t.href=r}document.getElementsByTagName("head")[0].insertBefore(t,document.getElementById("syntaxhighlighteranchor"))})();SyntaxHighlighter.config.strings.expandSource="+ expand source";SyntaxHighlighter.config.strings.help="?";SyntaxHighlighter.config.strings.alert="SyntaxHighlighter\n\n";SyntaxHighlighter.config.strings.noBrush="Can't find brush for: ";SyntaxHighlighter.config.strings.brushNotHtmlScript="Brush wasn't configured for html-script option: ";SyntaxHighlighter.defaults["class-name"]="code";SyntaxHighlighter.defaults["gutter"]=false;SyntaxHighlighter.defaults["pad-line-numbers"]=5;SyntaxHighlighter.defaults["toolbar"]=false;SyntaxHighlighter.all()
	</script>

	<?php } else {
			echo '<br>';
			echo '<div class="photo_index_wrap clearfix">';
			echo '<div class="photo_index" style="position: relative; height: 100px;">';
		// Lets list all albums
		// echo '<div id="flickrGal0">';

		$left = 0;
		$top = 0;
		$k = 0;
		foreach ($album->photosets->photoset as $gallery):

			// echo "<pre>";
			// print_r($gallery);
			// echo "</pre>";

			// echo "<h1>".$gallery->title."</h1>";
			// echo '<img src="https://farm'.$gallery->attributes()->farm.'.staticflickr.com/'.$gallery->attributes()->server.'/'.$gallery->attributes()->primary.'_'.$gallery->attributes()->secret.'_z.jpg">';
				
				$img = 'https://farm'.$gallery->attributes()->farm.'.staticflickr.com/'.$gallery->attributes()->server.'/'.$gallery->attributes()->primary.'_'.$gallery->attributes()->secret.'_z.jpg';
				$name = $gallery->title;
				$id = $gallery->attributes()->id;

				$res = $k % 2;
				if($res == 0 && $k > 0){
					$top = $top + 343;	
					$left = 0;
				}
				else{
					if($k > 0){
						$left = 510;
					}
				}

				echo '<article style="position: absolute; left: '.$left.'px; top: '.$top.'px;">';
					echo '<a href="?g='.$id.'" title="'.$name.'">';
						echo '<figure>';
							echo '<img class="lazy picz" data-original="'.$img.'" alt="'.$name.'" style="display: block;"/>';
							echo '<span class="gallery_name"><span class="glyphicon glyphicon-camera"></span> '.$name.'</span>';
						echo '</figure>';
					echo '</a>';
				echo '</article>';
				$k++;

		endforeach;

	}
?>
	</div>
</div>

</body>
</html>