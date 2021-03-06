<!DOCTYPE html> 
<html>
	<head>
		<title>A Head Full of Wishes: <?php echo $page_title; ?>
		</title>
		<meta http-equiv="Content-Type" content="text/html;charset=utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
		<link rel="stylesheet" href="<?php echo STATIC_HOST; ?>/css/reset.css" type="text/css" />
		<link rel="stylesheet" href="<?php echo STATIC_HOST; ?>/css/core.css" type="text/css" />
		<!-- link rel ="stylesheet" href="<?php echo STATIC_HOST; ?>/css/survey.css" type="text/css" / -->
		<link rel="stylesheet" href="<?php echo STATIC_HOST; ?>/css/prettyPhoto.css" type="text/css" />

<!--link rel="stylesheet"
	href="<?php echo STATIC_HOST; ?>/css/survey-new.css" type="text/css" /-->



		<script src="<?php echo STATIC_HOST; ?>/js/<?php echo JQUERY_LIBRARY; ?>" type="text/javascript"></script>
		<script src="<?php echo STATIC_HOST; ?>/js/jquery.cookie.js" type="text/javascript"></script>
		<script src="<?php echo STATIC_HOST; ?>/js/ahfowdb-core.js" type="text/javascript"></script>
		<script src="<?php echo STATIC_HOST; ?>/js/jquery.prettyPhoto.js" type="text/javascript"></script>
		<script src="<?php echo STATIC_HOST; ?>/js/tiny_mce/tiny_mce.js" type="text/javascript"></script>
		<script type="text/javascript">

			var _gaq = _gaq || [];
			_gaq.push(['_setAccount', 'UA-386732-5']);
			_gaq.push(['_setDomainName', 'fullofwishes.co.uk']);
			_gaq.push(['_trackPageview']);

			(function() {
				var ga = document.createElement('script');
				ga.type = 'text/javascript';
				ga.async = true;
				ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
				var s = document.getElementsByTagName('script')[0];
				s.parentNode.insertBefore(ga, s);
			})();


			document.domain = window.location.hostname.replace('db.', '');
//			console.log(document.domain);
			tinyMCE.init({
				language: 'en',
				mode: 'specific_textareas',
				editor_selector: 'mceEditor',
				theme: 'advanced',
				theme_advanced_buttons1: "bold,italic,underline,|,link,unlink,|,bullist,numlist,|,undo,redo,|,removeformat,code",
				theme_advanced_toolbar_location: "top",
				theme_advanced_toolbar_align: "center",
				theme_advanced_statusbar_location: "bottom",
				theme_advanced_resizing: true,
				theme_advanced_font_sizes: "10px,12px,14px,16px,24px"

			});

			(function() {
				var cx = '017452044498352075094:txisiezhclu';
				var gcse = document.createElement('script');
				gcse.type = 'text/javascript';
				gcse.async = true;
				gcse.src = (document.location.protocol == 'https:' ? 'https:' : 'http:') +
						'//www.google.com/cse/cse.js?cx=' + cx;
				var s = document.getElementsByTagName('script')[0];
				s.parentNode.insertBefore(gcse, s);
			})();

		</script>

	</head>
	<body>
		<div id="outer_container">
			<div id="inner_container">
					<h1><?php echo SITE_NAME; ?></h1>

