<?php
/*
 * To change this template, choose Tools | Templates and open the template in the editor.
 */

// put your code here
$this->load->helper ( 'album_helper' );
?>
<!DOCTYPE html>
<html>
<head>
<title>A Head Full of Wishes: <?php echo $page_title; ?>


        </title>
<meta name="viewport" content="width=device-width, initial-scale = 1.0" >
<meta http-equiv="Content-Type" content="text/html;charset=utf-8">


<link rel="stylesheet" href="<?php echo STATIC_HOST; ?>/css/reset.css"
	type="text/css" />
<link rel="stylesheet"
	href="<?php echo STATIC_HOST; ?>/css/survey-new.css" type="text/css" />



<script
	src="<?php echo STATIC_HOST; ?>/js/<?php echo JQUERY_LIBRARY; ?>"
	type="text/javascript"></script>
<script src="<?php echo STATIC_HOST; ?>/js/jquery.customSelect.min.js"
	type="text/javascript"></script>
<script src="<?php echo STATIC_HOST; ?>/js/jquery.cookie.js"
	type="text/javascript"></script>
<script src="<?php echo STATIC_HOST; ?>/js/ahfowdb-core.js"
	type="text/javascript"></script>
<script src="<?php echo STATIC_HOST; ?>/js/ahfowdb-survey.js"
	type="text/javascript"></script>
	<script type="text/javascript">

            var _gaq = _gaq || [];
            _gaq.push(['_setAccount', 'UA-386732-6']);
            _gaq.push(['_trackPageview']);

            (function() {
                var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
                ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
                var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
            })();

var changeyear = function() {
	location = '' + $('#survey_results_years').val();
    
}

	
$(document).ready(function() {
    
    
});	
</script>

</head>

<body>
	<div id="outer_container">
		<div id="inner_container" class="clearfix">
			<h1>A Head Full of Wishes / Survey results <?php echo $year; ?></h1>
			<div id="survey_results_menu" class="clearfix">
				<div id="survey_years_box"">
					<select id="survey_results_years" onchange="changeyear();">
					<?php
						for($i = SURVEY_CURRENT; $i >= 2003; $i --) {
					?>
						<option value="<?php echo $i;?>"
						
						<?php if ($i == $year) echo ' selected="true"';?>
						
						
						><?php echo $i;?></option>
					<?php
					}
					?>
						<option value="1995">1995-2002</option>
					</select>
				</div>		
				<ul class="tabs">
					<li><a class="btn" href="#summary">Summary</a></li>
					<?php if ($year > 2002 && $year != 2011) { ?>
					<li><a class="btn" href="#galaxie_500">Galaxie 500</a></li>
					<li><a class="btn" href="#luna">Luna</a></li>
					<li><a class="btn" href="#damon_and_naomi">Damon &amp; Naomi</a></li>
					<li><a class="btn" href="#dean_and_britta">Dean &amp; Britta</a></li>
					<?php } ?>
				</ul>
			</div>
			<div id="survey_results" class="clearfix">
				<?php if ($year > 2002 && $year != 2011) { ?>
            	<div id="summary">
					<h2>Summary</h2>
					
					<div class="results_summary tabs">
                <?php
                
                
                foreach ( $artists as $key => $value ) {

			//$this->firephp->error("hello");
//print_r($artist [$key])// ['artist_results'] ['albums']);


?>
					<div class="clearfix"><p><strong><?php echo $artist [$key] ['artist_results'] ['albums'] [0]->display;?></strong> : <em>Favourite album:</em> <?php echo $artist [$key] ['artist_results'] ['albums'] [0]->album;?> / <em>Favourite track:</em> <?php echo $artist [$key] ['artist_results'] ['tracks'] [0]->track;?></p></div>
					
					<?php 
					}
					?>
					
					</div>
					
					<div>
						<div class='summary_section1 clearfix'>
							<h3>Responses</h3>
							<?php
								echo $survey_summary ['responses'];
							?>
						</div>
						<div class='summary_section'>
							<h3>Ages</h3>
							<?php
								echo '<table>';
								foreach ( $survey_summary ['ages'] as $age ) {
									echo '<tr><th>' . $age->age_range . '</th><td>' . $age->count . '</td></tr>';
								}
								echo '</table>';
							?>
						</div>
						<div class='summary_section'>
							<h3>Countries</h3>
							<?php
								echo '<table>';
								foreach ( $survey_summary ['countries'] as $country ) {
									echo '<tr><th>' . $country->country . '</th><td>' . $country->count . '</td></tr>';
								}
								echo '</table>';
							?>    
						</div>
					</div>
				</div>
                <?php
					foreach ( $artists as $key => $value ) {
				?>
				<div id="<?php echo $key; ?>">
					<h2><?php echo $artist[$key]['artist_details']->display; ?></h2>
					<div class="favealbums clearfix"><div>
						<h3>Favourite album</h3>
						<?php
							foreach ( $artist [$key] ['artist_results'] ['albums'] as $result ) {
						?>
						<div class="surveyalbumbox clearfix">
							<div class="albumheader clearfix">
								<div class="votesbox clearfix">
									<span class="votes"><?php echo $result->votes; ?></span><br />votes
								</div>
								<div class="surveyalbumdetails">
									<p class="album_title">
										<?php echo $result->album; ?>
									</p>
								</div>
							</div>
							<div class="albumbody clearfix">
								<div class="albumimagebox">
								<img src="http://media.fullofwishes.co.uk/0<?php echo $artist[$key]['artist_details']->artist_id . '-' . $artist[$key]['artist_details']->slug; ?>/sleeves/<?php echo $result->sleeve; ?>" width="200" height="200" />
								</div>
								<div class="albumlinks">	
								<?php if ($result->bandcamp_id):?>
									<div class="bandcamp clearfix">
											<iframe style="border: 0; width: 100%; height: 42px;"
												src="http://bandcamp.com/EmbeddedPlayer/album=<?php echo $result->bandcamp_id; ?>/size=small/bgcol=ffffff/linkcol=0687f5/transparent=true/"
												seamless>
											<?php echo $result->album; ?> by <?php echo $artist[$key]['artist_details']->display; ?>
										</iframe>
									</div>
								<?php endif;?>
									<div class="metalinks">
										<ul>

								<?php if ($result->amazon_us):?>
									<li>
										<a href="http://www.amazon.com/gp/product/<?php echo $result->amazon_us;?>/ref=as_li_ss_tl?ie=UTF8&camp=1789&creative=390957&creativeASIN=<?php echo $result->amazon_us;?>&linkCode=as2&tag=aheadfullofwi-20"><img src="http://media.fullofwishes.co.uk.s3.amazonaws.com/00-misc/misc/buy-from-amazon.gif" alt="Buy <?php echo $result->album; ?> by <?php echo $artist[$key]['artist_details']->display; ?> from Amazon (US)" width="120" height="28" /></a><img src="http://ir-na.amazon-adsystem.com/e/ir?t=aheadfullofwi-20&l=as2&o=1&a=<?php echo $result->amazon_us;?>" width="1" height="1" border="0" alt="" style="border:none !important; margin:0px !important;" />
									</li>
								<?php endif;?>
										
										
										
										<li>
											<a href="../../database/discography/<?php echo $artist[$key]['artist_details']->slug;?>/<?php echo $result->album_id;?>">View <?php echo $result->album; ?> by <?php echo $artist[$key]['artist_details']->display; ?> on AHFoW</a>
										</li>
										

								<?php if ($result->wikipedia_url):?>
									<li>
										<a href="<?php $result->wikipedia_url;?>">View <?php echo $result->album; ?> by <?php echo $artist[$key]['artist_details']->display; ?> on Wikipedia</a>
									</li>
								<?php endif; ?>

								<?php if ($result->mbid):?>
									<li>
										<a href="http://musicbrainz.org/release-group/<?php echo $result->mbid;?>">View <?php echo $result->album; ?> by <?php echo $artist[$key]['artist_details']->display; ?> on Musicbrainz</a>
									</li>
								<?php endif;?>
								
										</ul>
									</div>
								</div>
							</div>
						</div>	
						<?php } ?>    
					</div>
					</div>
					<div class="favetracks clearfix">
					<div>
					<h3>Favourite track</h3>
						<ul>
                        <?php
						$i = 0;
						foreach ( $artist [$key] ['artist_results'] ['tracks'] as $track ) {
							/*if ($i >= 20) break;*/
						?>
							<li	
							<?php 
							if ($i===0) {
								echo ' class="first"';
							}
							$i++;
							?>
							><div class="trackbox clearfix"><div class="trackvotes"><?php echo $track->votes;?>
							
							
							
							</div><div class="trackname"><?php echo $track->track; ?></div></div>
							</li>
							<?php
								}
							?>
						</ul>
						</div>
					</div>
				</div>
				<?php
					}
				} else {
				?>
				<div id="summary">
					<h2>Summary</h2>
					<div>
					<?php
						if ($year < 2003) {	
					?>
						<p>Up until 2003 the survey was	carried out by folk emailing me in their votes and were compiled in a spreadsheet.</p>
						<p>You can see all the results from 1995 until 2006 over here:</p>
						<p><a href="https://docs.google.com/spreadsheet/ccc?key=0AvVnJzEnLB7fdDJLdWlfZkdIc2tfQTFRd1ROeXZ6N2c">A Head Full of Wishes survey results - 1995 - 2002</a></p>
						<?php
							} else {
						?>
						<p>In 2011 the survey was carried out using third party survey software.</p>
						<p>You can see all the results from 2011 over here:</p>
						<p><a href="http://www.fullofwishes.co.uk/survey-results-2011/">A Head Full of Wishes survey results - 2011</a></p>
                        <?php
						}
						?>
					</div>
				</div>
				<?php
				}
				?>
                    <?php
                    /* End of file survey.php */
                    /* Location: $(filePath} */
