<?php
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

// put your code here
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


                <?php if ($survey_section == 'artist'): ?>
                    <h1>Survey Results : <?php echo $artist_details->display; ?></h1>
                    <ul>
                        <li><a href="<?php echo site_url('survey/view/2012/summary'); ?>">Summary</a></li>
                        <li><a href="<?php echo site_url('survey/view/2012/galaxie_500'); ?>">Galaxie 500</a></li>
                        <li><a href="<?php echo site_url('survey/view/2012/luna'); ?>">Luna</a></li>
                        <li><a href="<?php echo site_url('survey/view/2012/damon_and_naomi'); ?>">Damon &amp; Naomi</a></li>
                        <li><a href="<?php echo site_url('survey/view/2012/dean_and_britta'); ?>">Dean &amp; Britta</a></li>
                    </ul>

                    <h2>Album</h2>
                    <?php
                    $this->firephp->log($artist_results);
                    foreach ($artist_results['albums'] as $result) {
                        ?>
                        <div class="surveyalbumbox clearfix">
                            <div class="surveyalbumimage">
                                <img src ="http://media.fullofwishes.co.uk/sleeves/<?php echo $result->sleeve; ?>"/>
                            </div>
                            <div class="surveyalbumdetails">
                                <h3><?php echo $result->album; ?></h3>
                                <p><?php echo $result->votes; ?> votes</p>
                            </div>
                        </div>

                        <?php
                    }
                    ?>    


                    <h2>Track</h2>
                    <ol>
                        <?php
                        foreach ($artist_results['tracks'] as $track) {
                            ?>
                            <li><?php echo '<strong>' . $track->track . '</strong> (' . $track->votes . ' votes)'; ?></li>

                            <?php
                        }
                        ?>  
                    </ol>

                    <?php
                else:
                    ?>

                    <div id="survey_summary">





                        <h1>Survey Results : Summary</h1>
                        <ul>
                            <li><a href="<?php echo site_url('survey/view/2012/summary'); ?>">Summary</a></li>
                            <li><a href="<?php echo site_url('survey/view/2012/galaxie_500'); ?>">Galaxie 500</a></li>
                            <li><a href="<?php echo site_url('survey/view/2012/luna'); ?>">Luna</a></li>
                            <li><a href="<?php echo site_url('survey/view/2012/damon_and_naomi'); ?>">Damon &amp; Naomi</a></li>
                            <li><a href="<?php echo site_url('survey/view/2012/dean_and_britta'); ?>">Dean &amp; Britta</a></li>
                        </ul>

                        <h2>Responses</h2>
                        <?php
                        echo $survey_summary['responses'];
                        ?>
                        <h2>Ages</h2>
                        <?php
                        echo '<table>';
                        foreach ($survey_summary['ages'] as $age) {
                            echo '<tr><th>' . $age->age_range . '</th><td>' . $age->count . '</td></tr>';
                        }
                        echo '</table>';
                        ?>               

                        <h2>Countries</h2>
                        <?php
                        echo '<table>';
                        foreach ($survey_summary['countries'] as $country) {
                            echo '<tr><th>' . $country->country . '</th><td>' . $country->count . '</td></tr>';
                        }
                        echo '</table>';
                        ?>               

                    </div>

                <?php
                endif;
                ?>

            </div>
        </div>
    </body>
</html>





<?php




/* End of file survey.php */
/* Location: $(filePath} */