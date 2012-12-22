<?php
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

// put your code here

$this->load->helper('album_helper');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd"> 
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <title>A Head Full of Wishes: <?php echo $page_title; ?>



        </title>
        <meta http-equiv="Content-Type" content="text/html;charset=utf-8" />
        <link rel="stylesheet" href="<?php echo STATIC_HOST; ?>/css/reset.css" type="text/css" />
        <link rel="stylesheet" href="<?php echo STATIC_HOST; ?>/css/core.css" type="text/css" />
        <link rel="stylesheet" href="<?php echo STATIC_HOST; ?>/css/survey.css" type="text/css" />


        <script src="<?php echo STATIC_HOST; ?>/js/<?php echo JQUERY_LIBRARY; ?>" type="text/javascript"></script>
        <script src="<?php echo STATIC_HOST; ?>/js/jquery.cookie.js" type="text/javascript"></script>
        <script src="<?php echo STATIC_HOST; ?>/js/ahfowdb-core.js" type="text/javascript"></script>
        <script type="text/javascript">

            var _gaq = _gaq || [];
            _gaq.push(['_setAccount', 'UA-386732-6']);
            _gaq.push(['_trackPageview']);

            (function() {
                var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
                ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
                var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
            })();
        </script>

    </head>

    <body>
        <div id="outer_container">
            <div id="inner_container" class="clearfix">


                <h1>A Head Full of Wishes / Survey results <?php echo $year; ?></h1>
                <div id="survey_results_menu" class="clearfix">
                    <ul class="tabs">
                        <li><a href="#summary">Summary</a></li>
                        <li><a href="#galaxie_500">Galaxie 500</a></li>
                        <li><a href="#luna">Luna</a></li>
                        <li><a href="#damon_and_naomi">Damon &amp; Naomi</a></li>
                        <li><a href="#dean_and_britta">Dean &amp; Britta</a></li>
                    </ul>
                </div>

                <div id="survey_results" class="clearfix">

                    <div id="summary">
                        <h2>Summary</h2>
                        <div>
                            <div class='summary_section'>
                                <h3>Responses</h3>
                                <?php
                                echo $survey_summary['responses'];
                                ?>
                            </div>
                            <div class='summary_section'>
                                <h3>Ages</h3>
                                <?php
                                echo '<table>';
                                foreach ($survey_summary['ages'] as $age) {
                                    echo '<tr><th>' . $age->age_range . '</th><td>' . $age->count . '</td></tr>';
                                }
                                echo '</table>';
                                ?>               
                            </div>
                            <div class='summary_section'>
                                <h3>Countries</h3>
                                <?php
                                echo '<table>';
                                foreach ($survey_summary['countries'] as $country) {
                                    echo '<tr><th>' . $country->country . '</th><td>' . $country->count . '</td></tr>';
                                }
                                echo '</table>';
                                ?>    
                            </div>
                        </div>
                    </div>


                    <?php
                    foreach ($artists as $key => $value) {
                        ?>
                        <div id="<?php echo $key; ?>">
                            <h2><?php echo $artist[$key]['artist_details']->display; ?></h2>
                            <div>
                                <h3>Favourite album</h3>
                                <?php
//                    $this->firephp->log($artist_results);
                                foreach ($artist[$key]['artist_results']['albums'] as $result) {
                                    ?>
                                    <div class="surveyalbumbox clearfix">
                                        <div class="surveyalbumdetails">
                                            <p class="album_title"><?php echo $result->album; ?></p>
                                            <div class="surveyalbumimage">
                                                <img src ="http://media.fullofwishes.co.uk/sleeves/<?php echo $result->sleeve; ?>"/>
                                            </div>
                                            <p><span class="votes"><?php echo $result->votes; ?></span> vote<?php echo ($result->votes > 1) ? 's' : ''; ?></p>
                                        </div>
                                    </div>

                                    <?php
                                }
                                ?>    


                                <h3>Favourite track</h3>
                                <ul>
                                    <?php
                                    $i = TRUE;
                                    foreach ($artist[$key]['artist_results']['tracks'] as $track) {
                                        ?>

                                        <li
                                        <?php
                                        if ($i) {
                                            echo ' class="first"';
                                            $i = FALSE;
                                        }
                                        ?>


                                            ><?php echo '<strong>' . $track->track . '</strong> (' . $track->votes . ' votes)'; ?></li>

                                        <?php
                                    }
                                    ?>  
                                </ul>
                            </div>
                        </div>
                        <?php
                    }
                    ?>
                </div>





<?php




/* End of file survey.php */
/* Location: $(filePath} */