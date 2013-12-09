<?php
?>
<!DOCTYPE html>
<head>
	<title>A Head Full of Wishes - survey</title>
	<meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta http-equiv="Content-Type" content="text/html;charset=utf-8" />
        <link rel="stylesheet" href="<?php echo STATIC_HOST; ?>/css/reset.css" type="text/css" />
        <link rel="stylesheet" href="<?php echo STATIC_HOST; ?>/css/core.css" type="text/css" />
        <link rel="stylesheet" href="<?php echo STATIC_HOST; ?>/css/survey-form-new.css" type="text/css" />


        <script src="<?php echo STATIC_HOST; ?>/js/<?php echo JQUERY_LIBRARY; ?>" type="text/javascript"></script>
        <script src="<?php echo STATIC_HOST; ?>/js/jquery.cookie.js" type="text/javascript"></script>
        <script src="<?php echo STATIC_HOST; ?>/js/ahfowdb-core.js" type="text/javascript"></script>
        <script type="text/javascript">

            var _gaq = _gaq || [];
            _gaq.push(['_setAccount', 'UA-386732-5']);
            _gaq.push(['_trackPageview']);

            (function() {
                var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
                ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
                var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
            })();
        </script>

    </head>

    <body>
        <div id="survey-outer-container">
            <div id="survey-inner-container">

                <?php
                $this->firephp->log('code:' . $message_code);
                if ($message_code) {
                    ?>
                    <h1 class="survey">A Head Full of Wishes / 2013 survey</h1>

                    <div class="section2">
                        <?php
                        switch ($message_code) {
                            case 1:
                                echo ('It appears you have already completed the survey if you think this is wrong please get in touch.');
                                break;
                            case 2:
                                echo ('Thank you for completing the survey, if you\'d like to get in touch about anything relating to this survey please do.');
                                break;
                            default:
                                echo ('If you\'d like to get in touch about anything relating to this survey please get in touch.');
                                break;
                        }
                        ?>
                        <h2>
                            Contact
                        </h2>
                        <p>Please email me about anything to do with this survey at <a href="mailto:andy@fullofwishes.co.uk?subject=AHFoW survey: <?php echo $this->input->cookie('ahfowsurvey');?>">andy@fullofwishes.co.uk</a>, and please include the following reference number</p>
                        <p>Reference: <strong><?php echo  $this->input->cookie('ahfowsurvey');?></strong>


                    </div>


                    <?php
                } else {
                    ?>
                    <div>
                        <form id="surveyform" action="<?php echo site_url('survey/process') ?>" method="post" class="clearfix">
                            <input type="hidden" id="frmId" name="frmId" value="<?php echo uniqid('ahfow' . (string) date("Y")); ?>" />
                            <h1 class="survey">A Head Full of Wishes / 2013 survey</h1>

                            <div class="section" id="about_you-section">

                                <h3>About you</h3>
                                <div>
                                    <p>All optional, however if you want to be entered into the draw that I'll probably do to try and drum up a little extra interest then you'd better enter your email address. Nothing else happens to what you enter and any personal information will be purged when the survey is completed.</p><p>This form does use cookies and probably hasn't been as rigorously tested as it should so if you have any problems (or just prefer to) please <a href="mailto:andy@fullofwishes.co.uk?subject=AHFoW survey entry">feel free to email me your favourite album and five favourite tracks for each artist</a>.</p>
                                    <p><label for="frmName">Name (optional)</label>
                                        <input type="text" id="frmName" name="frmName" placeholder="Name (optional)" /></p>
                                    <p><label for="frmName">Email (optional)</label>
                                        <input type="text" id="frmEmail" name="frmEmail" placeholder="Email address (optional)" /></p>
                                    <p><label for="frmCountry">Age (optional)</label>
                                        <select id="frmAge" name="frmAge" placeholder="Select your age (optional)">
                                            <?php
                                            foreach ($ages as $age) {
                                                echo '<option value="' . $age['age_id'] . '">' . $age['age_range'] . '</option>';
                                            }
                                            ?>
                                        </select>
                                        <p><label for="frmCountry">Country (optional)</label>
                                            <select id="frmCountry" name="frmCountry" placeholder="Select your country (optional)">
                                                <option>--Select your country (optional)--</option>
                                                <option value="United Kingdom">United Kingdom</option>
                                                <option value="United States">United States</option>
                                                <option value="">-------------</option>
                                                <option value="Afghanistan">Afghanistan</option>
                                                <option value="Åland Islands">Åland Islands</option>
                                                <option value="Albania">Albania</option>
                                                <option value="Algeria">Algeria</option>
                                                <option value="American Samoa">American Samoa</option>
                                                <option value="Andorra">Andorra</option>
                                                <option value="Angola">Angola</option>
                                                <option value="Anguilla">Anguilla</option>
                                                <option value="Antarctica">Antarctica</option>
                                                <option value="Antigua and Barbuda">Antigua and Barbuda</option>
                                                <option value="Argentina">Argentina</option>
                                                <option value="Armenia">Armenia</option>
                                                <option value="Aruba">Aruba</option>
                                                <option value="Australia">Australia</option>
                                                <option value="Austria">Austria</option>
                                                <option value="Azerbaijan">Azerbaijan</option>
                                                <option value="Bahamas">Bahamas</option>
                                                <option value="Bahrain">Bahrain</option>
                                                <option value="Bangladesh">Bangladesh</option>
                                                <option value="Barbados">Barbados</option>
                                                <option value="Belarus">Belarus</option>
                                                <option value="Belgium">Belgium</option>
                                                <option value="Belize">Belize</option>
                                                <option value="Benin">Benin</option>
                                                <option value="Bermuda">Bermuda</option>
                                                <option value="Bhutan">Bhutan</option>
                                                <option value="Bolivia">Bolivia</option>
                                                <option value="Bosnia and Herzegovina">Bosnia and Herzegovina</option>
                                                <option value="Botswana">Botswana</option>
                                                <option value="Bouvet Island">Bouvet Island</option>
                                                <option value="Brazil">Brazil</option>
                                                <option value="British Indian Ocean Territory">British Indian Ocean Territory</option>
                                                <option value="Brunei Darussalam">Brunei Darussalam</option>
                                                <option value="Bulgaria">Bulgaria</option>
                                                <option value="Burkina Faso">Burkina Faso</option>
                                                <option value="Burundi">Burundi</option>
                                                <option value="Cambodia">Cambodia</option>
                                                <option value="Cameroon">Cameroon</option>
                                                <option value="Canada">Canada</option>
                                                <option value="Cape Verde">Cape Verde</option>
                                                <option value="Cayman Islands">Cayman Islands</option>
                                                <option value="Central African Republic">Central African Republic</option>
                                                <option value="Chad">Chad</option>
                                                <option value="Chile">Chile</option>
                                                <option value="China">China</option>
                                                <option value="Christmas Island">Christmas Island</option>
                                                <option value="Cocos (Keeling) Islands">Cocos (Keeling) Islands</option>
                                                <option value="Colombia">Colombia</option>
                                                <option value="Comoros">Comoros</option>
                                                <option value="Congo">Congo</option>
                                                <option value="Congo, The Democratic Republic of The">Congo, The Democratic Republic of The</option>
                                                <option value="Cook Islands">Cook Islands</option>
                                                <option value="Costa Rica">Costa Rica</option>
                                                <option value="Cote D'ivoire">Cote D'ivoire</option>
                                                <option value="Croatia">Croatia</option>
                                                <option value="Cuba">Cuba</option>
                                                <option value="Cyprus">Cyprus</option>
                                                <option value="Czech Republic">Czech Republic</option>
                                                <option value="Denmark">Denmark</option>
                                                <option value="Djibouti">Djibouti</option>
                                                <option value="Dominica">Dominica</option>
                                                <option value="Dominican Republic">Dominican Republic</option>
                                                <option value="Ecuador">Ecuador</option>
                                                <option value="Egypt">Egypt</option>
                                                <option value="El Salvador">El Salvador</option>
                                                <option value="Equatorial Guinea">Equatorial Guinea</option>
                                                <option value="Eritrea">Eritrea</option>
                                                <option value="Estonia">Estonia</option>
                                                <option value="Ethiopia">Ethiopia</option>
                                                <option value="Falkland Islands (Malvinas)">Falkland Islands (Malvinas)</option>
                                                <option value="Faroe Islands">Faroe Islands</option>
                                                <option value="Fiji">Fiji</option>
                                                <option value="Finland">Finland</option>
                                                <option value="France">France</option>
                                                <option value="French Guiana">French Guiana</option>
                                                <option value="French Polynesia">French Polynesia</option>
                                                <option value="French Southern Territories">French Southern Territories</option>
                                                <option value="Gabon">Gabon</option>
                                                <option value="Gambia">Gambia</option>
                                                <option value="Georgia">Georgia</option>
                                                <option value="Germany">Germany</option>
                                                <option value="Ghana">Ghana</option>
                                                <option value="Gibraltar">Gibraltar</option>
                                                <option value="Greece">Greece</option>
                                                <option value="Greenland">Greenland</option>
                                                <option value="Grenada">Grenada</option>
                                                <option value="Guadeloupe">Guadeloupe</option>
                                                <option value="Guam">Guam</option>
                                                <option value="Guatemala">Guatemala</option>
                                                <option value="Guernsey">Guernsey</option>
                                                <option value="Guinea">Guinea</option>
                                                <option value="Guinea-bissau">Guinea-bissau</option>
                                                <option value="Guyana">Guyana</option>
                                                <option value="Haiti">Haiti</option>
                                                <option value="Heard Island and Mcdonald Islands">Heard Island and Mcdonald Islands</option>
                                                <option value="Holy See (Vatican City State)">Holy See (Vatican City State)</option>
                                                <option value="Honduras">Honduras</option>
                                                <option value="Hong Kong">Hong Kong</option>
                                                <option value="Hungary">Hungary</option>
                                                <option value="Iceland">Iceland</option>
                                                <option value="India">India</option>
                                                <option value="Indonesia">Indonesia</option>
                                                <option value="Iran, Islamic Republic of">Iran, Islamic Republic of</option>
                                                <option value="Iraq">Iraq</option>
                                                <option value="Ireland">Ireland</option>
                                                <option value="Isle of Man">Isle of Man</option>
                                                <option value="Israel">Israel</option>
                                                <option value="Italy">Italy</option>
                                                <option value="Jamaica">Jamaica</option>
                                                <option value="Japan">Japan</option>
                                                <option value="Jersey">Jersey</option>
                                                <option value="Jordan">Jordan</option>
                                                <option value="Kazakhstan">Kazakhstan</option>
                                                <option value="Kenya">Kenya</option>
                                                <option value="Kiribati">Kiribati</option>
                                                <option value="Korea, Democratic People's Republic of">Korea, Democratic People's Republic of</option>
                                                <option value="Korea, Republic of">Korea, Republic of</option>
                                                <option value="Kuwait">Kuwait</option>
                                                <option value="Kyrgyzstan">Kyrgyzstan</option>
                                                <option value="Lao People's Democratic Republic">Lao People's Democratic Republic</option>
                                                <option value="Latvia">Latvia</option>
                                                <option value="Lebanon">Lebanon</option>
                                                <option value="Lesotho">Lesotho</option>
                                                <option value="Liberia">Liberia</option>
                                                <option value="Libyan Arab Jamahiriya">Libyan Arab Jamahiriya</option>
                                                <option value="Liechtenstein">Liechtenstein</option>
                                                <option value="Lithuania">Lithuania</option>
                                                <option value="Luxembourg">Luxembourg</option>
                                                <option value="Macao">Macao</option>
                                                <option value="Macedonia, The Former Yugoslav Republic of">Macedonia, The Former Yugoslav Republic of</option>
                                                <option value="Madagascar">Madagascar</option>
                                                <option value="Malawi">Malawi</option>
                                                <option value="Malaysia">Malaysia</option>
                                                <option value="Maldives">Maldives</option>
                                                <option value="Mali">Mali</option>
                                                <option value="Malta">Malta</option>
                                                <option value="Marshall Islands">Marshall Islands</option>
                                                <option value="Martinique">Martinique</option>
                                                <option value="Mauritania">Mauritania</option>
                                                <option value="Mauritius">Mauritius</option>
                                                <option value="Mayotte">Mayotte</option>
                                                <option value="Mexico">Mexico</option>
                                                <option value="Micronesia, Federated States of">Micronesia, Federated States of</option>
                                                <option value="Moldova, Republic of">Moldova, Republic of</option>
                                                <option value="Monaco">Monaco</option>
                                                <option value="Mongolia">Mongolia</option>
                                                <option value="Montenegro">Montenegro</option>
                                                <option value="Montserrat">Montserrat</option>
                                                <option value="Morocco">Morocco</option>
                                                <option value="Mozambique">Mozambique</option>
                                                <option value="Myanmar">Myanmar</option>
                                                <option value="Namibia">Namibia</option>
                                                <option value="Nauru">Nauru</option>
                                                <option value="Nepal">Nepal</option>
                                                <option value="Netherlands">Netherlands</option>
                                                <option value="Netherlands Antilles">Netherlands Antilles</option>
                                                <option value="New Caledonia">New Caledonia</option>
                                                <option value="New Zealand">New Zealand</option>
                                                <option value="Nicaragua">Nicaragua</option>
                                                <option value="Niger">Niger</option>
                                                <option value="Nigeria">Nigeria</option>
                                                <option value="Niue">Niue</option>
                                                <option value="Norfolk Island">Norfolk Island</option>
                                                <option value="Northern Mariana Islands">Northern Mariana Islands</option>
                                                <option value="Norway">Norway</option>
                                                <option value="Oman">Oman</option>
                                                <option value="Pakistan">Pakistan</option>
                                                <option value="Palau">Palau</option>
                                                <option value="Palestinian Territory, Occupied">Palestinian Territory, Occupied</option>
                                                <option value="Panama">Panama</option>
                                                <option value="Papua New Guinea">Papua New Guinea</option>
                                                <option value="Paraguay">Paraguay</option>
                                                <option value="Peru">Peru</option>
                                                <option value="Philippines">Philippines</option>
                                                <option value="Pitcairn">Pitcairn</option>
                                                <option value="Poland">Poland</option>
                                                <option value="Portugal">Portugal</option>
                                                <option value="Puerto Rico">Puerto Rico</option>
                                                <option value="Qatar">Qatar</option>
                                                <option value="Reunion">Reunion</option>
                                                <option value="Romania">Romania</option>
                                                <option value="Russian Federation">Russian Federation</option>
                                                <option value="Rwanda">Rwanda</option>
                                                <option value="Saint Helena">Saint Helena</option>
                                                <option value="Saint Kitts and Nevis">Saint Kitts and Nevis</option>
                                                <option value="Saint Lucia">Saint Lucia</option>
                                                <option value="Saint Pierre and Miquelon">Saint Pierre and Miquelon</option>
                                                <option value="Saint Vincent and The Grenadines">Saint Vincent and The Grenadines</option>
                                                <option value="Samoa">Samoa</option>
                                                <option value="San Marino">San Marino</option>
                                                <option value="Sao Tome and Principe">Sao Tome and Principe</option>
                                                <option value="Saudi Arabia">Saudi Arabia</option>
                                                <option value="Senegal">Senegal</option>
                                                <option value="Serbia">Serbia</option>
                                                <option value="Seychelles">Seychelles</option>
                                                <option value="Sierra Leone">Sierra Leone</option>
                                                <option value="Singapore">Singapore</option>
                                                <option value="Slovakia">Slovakia</option>
                                                <option value="Slovenia">Slovenia</option>
                                                <option value="Solomon Islands">Solomon Islands</option>
                                                <option value="Somalia">Somalia</option>
                                                <option value="South Africa">South Africa</option>
                                                <option value="South Georgia and The South Sandwich Islands">South Georgia and The South Sandwich Islands</option>
                                                <option value="Spain">Spain</option>
                                                <option value="Sri Lanka">Sri Lanka</option>
                                                <option value="Sudan">Sudan</option>
                                                <option value="Suriname">Suriname</option>
                                                <option value="Svalbard and Jan Mayen">Svalbard and Jan Mayen</option>
                                                <option value="Swaziland">Swaziland</option>
                                                <option value="Sweden">Sweden</option>
                                                <option value="Switzerland">Switzerland</option>
                                                <option value="Syrian Arab Republic">Syrian Arab Republic</option>
                                                <option value="Taiwan, Province of China">Taiwan</option>
                                                <option value="Tajikistan">Tajikistan</option>
                                                <option value="Tanzania, United Republic of">Tanzania, United Republic of</option>
                                                <option value="Thailand">Thailand</option>
                                                <option value="Timor-leste">Timor-leste</option>
                                                <option value="Togo">Togo</option>
                                                <option value="Tokelau">Tokelau</option>
                                                <option value="Tonga">Tonga</option>
                                                <option value="Trinidad and Tobago">Trinidad and Tobago</option>
                                                <option value="Tunisia">Tunisia</option>
                                                <option value="Turkey">Turkey</option>
                                                <option value="Turkmenistan">Turkmenistan</option>
                                                <option value="Turks and Caicos Islands">Turks and Caicos Islands</option>
                                                <option value="Tuvalu">Tuvalu</option>
                                                <option value="Uganda">Uganda</option>
                                                <option value="Ukraine">Ukraine</option>
                                                <option value="United Arab Emirates">United Arab Emirates</option>
                                                <option value="United Kingdom">United Kingdom</option>
                                                <option value="United States">United States</option>
                                                <option value="United States Minor Outlying Islands">United States Minor Outlying Islands</option>
                                                <option value="Uruguay">Uruguay</option>
                                                <option value="Uzbekistan">Uzbekistan</option>
                                                <option value="Vanuatu">Vanuatu</option>
                                                <option value="Venezuela">Venezuela</option>
                                                <option value="Viet Nam">Viet Nam</option>
                                                <option value="Virgin Islands, British">Virgin Islands, British</option>
                                                <option value="Virgin Islands, U.S.">Virgin Islands, U.S.</option>
                                                <option value="Wallis and Futuna">Wallis and Futuna</option>
                                                <option value="Western Sahara">Western Sahara</option>
                                                <option value="Yemen">Yemen</option>
                                                <option value="Zambia">Zambia</option>
                                                <option value="Zimbabwe">Zimbabwe</option>
                                            </select></p>
                                </div>
                            </div>


                            <?php
                            foreach ($artists as $artist) {
//                        $this->firephp->log($artist);
                                ?>
                                <div class="section" id="<?php echo($artist['artist_details']->slug); ?>-section">
                                    <h3><?php echo($artist['artist_details']->display); ?></h3>
                                    <div>
										<div>
                                    <h4>Favourite <?php echo($artist['artist_details']->display); ?> album</h4>
                                        <select class="clearfix" id="<?php echo($artist['artist_details']->slug); ?>-albumvote" name="<?php echo($artist['artist_details']->slug); ?>-albumvote">
                                            <option>--select--</option>
                                            <?php
                                            foreach ($artist['discography']['Album'] as $album) {
                                                echo '<option value="' . $album->album_id . '">' . $album->album . '</option>';
                                            }
                                            ?>
                                        </select>
</div>
                                        <div id="<?php echo($artist['artist_details']->slug); ?>-trackselect"  class="clearfix">
                                            <h4>Favourite <?php echo($artist['artist_details']->display); ?> track</h4>
                                            <p>Select up to five</p>
                                            <div class="leftselect">
                                                <select id="<?php echo($artist['artist_details']->slug); ?>-trackfrom" class="trackfrom" size="10">
                                                    <?php
                                                    foreach ($artist['tracklist']['list'] as $track) {
                                                        echo "<option value='" . $track->track_id . "'>" . $track->track . "</option>";
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                            <div class="selectbuttons">
                                                <p><input type="button" value="add" id="<?php echo($artist['artist_details']->slug); ?>-trackadd" class='trackadd' />
                                                <input type="button" value="remove" id="<?php echo($artist['artist_details']->slug); ?>-trackremove" class='trackremove' /></p>
                                                <p id="<?php echo($artist['artist_details']->slug); ?>-messages" class="messages"></p>
                                            </div>

                                            <div class="rightselect">
                                                <select multiple id="<?php echo($artist['artist_details']->slug); ?>-trackto" name="<?php echo($artist['artist_details']->slug); ?>-tracks" class="trackto" size="5">

                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>


                                <?php
                            }
                            ?>

                            <div id="finish_up-section" class="section">
                                <h3>Finish up</h3>
                                <div>
                                    <p><label for="frmComments">Comments</label></p>
                                    <textarea id="frmComments" name="frmComments" placeholder="Enter any comments here"></textarea>
                                    <table id="surveySummary">
                                        <caption>Summary</caption>
                                        <tr><th>Section</th><th>Album</th><th>Tracks</th></tr>
                                        <tr><th>Galaxie 500</th><td id="galaxie_500-album"></td><td id="galaxie_500-tracks">xx</td></tr>
                                        <tr><th>Luna</th><td id="luna-album"></td><td id="luna-tracks"></td></tr>
                                        <tr><th>Damon &amp; Naomi</th><td id="damon_and_naomi-album"></td><td id="damon_and_naomi-tracks"></td></tr>
                                        <tr><th>Dean &amp; Britta</th><td id="dean_and_britta-album"></td><td id="dean_and_britta-tracks"></td></tr>
                                    </table>
                                    <input type="button" id="frmSubmit" value="Finish" />
                                </div>
                            </div>


                        </form>
                    </div>

                    <?php
                }
                ?>

            </div>
        </div>

    </body>
</html>



<?php




/* End of file survey.php */
/* Location: $(filePath} */