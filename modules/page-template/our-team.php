<?php
if (!defined('_INCODE')) die('Access Deined...');
$dataAbout = firstRaw("select opt_value from options where opt_key = 'general_contact'");
$dataAbout = reset($dataAbout);
$dataAbout = json_decode($dataAbout, true);

// echo "<pre>";
// print_r($dataAbout);
// echo "</pre>";

$dataTeam = firstRaw("select opt_value from options where opt_key = 'general_team'");
$dataTeam = reset($dataTeam);
$dataTeam = json_decode($dataTeam, true);

// echo "<pre>";
// print_r($dataTeam);
// echo "</pre>";
$data = [
    "pageTitle" =>  !empty($dataAbout['title_team']) ? $dataAbout['title_team']: "Đội nhóm" ,
];
layout("header", "client", $data);
layout("breadcrumb", "client", $data);
?>


<!-- Start Team -->
<section id="team" class="team section">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="section-title">
                    <span class="title-bg"><?php echo html_entity_decode($dataAbout['heading_bg']) ?></span>
                    <h1><?php echo html_entity_decode($dataAbout['heading_team']) ?></h1>
                    <p><?php echo html_entity_decode($dataAbout['des_team']) ?>
                    <p>
                </div>
            </div>
        </div>
        <div class="row">

            <?php 
        if(!empty($dataTeam)){
            foreach ($dataTeam['name'] as $key => $value) {
                ?>
            <div class="col-lg-3 col-md-6 col-12">
                <!-- Single Team -->
                <div class="single-team">
                    <div class="t-head">
                        <img src="<?php echo $dataTeam['image'][$key] ?>" alt="#">
                        <div class="t-icon">
                            <a href="<?php echo $dataTeam['link'][$key] ?>"><i class="fa fa-plus"></i></a>
                        </div>
                    </div>
                    <div class="t-bottom">
                        <p><?php echo $dataTeam['position'][$key] ?></p>
                        <h2><?php echo $value ?></h2>
                        <ul class="t-social">
                            <li><a href="<?php echo $dataTeam['facebook'][$key] ?>"><i class="fa fa-facebook"></i></a>
                            </li>
                            <li><a href="<?php echo $dataTeam['twitter'][$key] ?>"><i class="fa fa-twitter"></i></a>
                            </li>
                            <li><a href="<?php echo $dataTeam['youtube'][$key] ?>"><i class="fa fa-youtube"></i></a>
                            </li>
                            <li><a href="<?php echo $dataTeam['github'][$key] ?>"><i class="fa fa-github"></i></a></li>
                        </ul>
                    </div>
                </div>
                <!-- End Single Team -->
            </div>
            <?php
            }
        }
        ?>


        </div>
    </div>
</section>
<!--/ End Team -->

<?php

layout("footer", "client", $data);

?>