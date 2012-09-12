<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd"> 
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <title>A Head Full of Wishes: <?php echo $page_title; ?>



        </title>
        <meta http-equiv="Content-Type" content="text/html;charset=utf-8" />
        <link rel="stylesheet" href="<?php echo STATIC_HOST; ?>/css/reset.css" type="text/css" />
        <link rel="stylesheet" href="<?php echo STATIC_HOST; ?>/css/core.css" type="text/css" />

        <script src="<?php echo STATIC_HOST; ?>/js/<?php echo JQUERY_LIBRARY; ?>" type="text/javascript"></script>
        <script src="<?php echo STATIC_HOST; ?>/js/jquery.hoverIntent.minified.js" type="text/javascript"></script>
        <script src="<?php echo STATIC_HOST; ?>/js/ahfowdb-core.js" type="text/javascript"></script>
        <script src="<?php echo STATIC_HOST; ?>/js/tiny_mce/tiny_mce.js" type="text/javascript"></script>
        <script type="text/javascript">

            var _gaq = _gaq || [];
            _gaq.push(['_setAccount', 'UA-386732-6']);
            _gaq.push(['_trackPageview']);

            (function() {
                var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
                ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
                var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
            })();

            
            document.domain = window.location.hostname.replace('static.','');
            document.domain = window.location.hostname.replace('db.','');
            tinyMCE.init({
                language : 'en',
                mode : 'specific_textareas',
                editor_selector : 'mceEditor',
                theme : 'advanced',
                theme_advanced_buttons1 : "bold,italic,underline,|,link,unlink,|,bullist,numlist,|,undo,redo,|,removeformat,code",
                theme_advanced_toolbar_location : "top",
                theme_advanced_toolbar_align : "center",
                theme_advanced_statusbar_location : "bottom",
                theme_advanced_resizing : true,
                theme_advanced_font_sizes : "10px,12px,14px,16px,24px"
        
            });


        </script>

    </head>

    <body>
        <div id="outer_container">
            <div id="inner_container">
                <div id="header" class="clearfix">
                    <h1><?php echo SITE_NAME; ?></h1>
                </div>

