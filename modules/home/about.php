<?php
if (!defined('_INCODE')) die('Access Deined...');
$data = [
    "pageTitle" => "Trang chủ",
];
layout("header", "client", $data);


$dataAbout = firstRaw("select opt_value from options where opt_key = 'general_about'");
$dataAbout = reset($dataAbout);
$dataAbout = json_decode($dataAbout, true);

// echo "<pre>";
// print_r($dataAbout);
// echo "</pre>";

?>

<!-- About Us -->
<section class="about-us section">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="section-title wow fadeInUp">
                    <span class="title-bg"><?php echo html_entity_decode($dataAbout['text_bg']) ?></span>
                    <h1><?php echo html_entity_decode($dataAbout['heading']) ?></h1>
                    <p><?php echo html_entity_decode($dataAbout['description']) ?></p>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-6 col-12 wow fadeInLeft" data-wow-delay="0.6s">
                <!-- Video -->
                <div class="about-video">


                    <div class="single-video overlay">
                        <a class="video-popup mfp-fade" href="<?php echo $dataAbout['link_video'] ?>">
                            <i class="fa fa-play"></i></a>
                        <img src="<?php echo $dataAbout['image_1'] ?>" alt="#">
                    </div>
                </div>
                <!--/ End Video -->
            </div>
            <div class="col-lg-6 col-12 wow fadeInRight" data-wow-delay="0.8s">
                <!-- About Content -->
                <div class="about-content">
                    <h2><?php echo html_entity_decode($dataAbout['name']) ?></h2>
                    <p><?php echo html_entity_decode($dataAbout['content']) ?></p>
                </div>
                <!--/ End About Content -->
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="progress-main">
                    <div class="row">

                        <?php 
                    if(!empty($dataAbout['range'])):
                    foreach ($dataAbout['range'] as $key => $value) {
                        if(!empty($dataAbout['range_name'][$key])){
                        ?>
                        <div class="col-lg-6 col-md-6 col-12 wow fadeInUp" data-wow-delay="0.4s">
                            <!-- Single Skill -->
                            <div class="single-progress">
                                <h4><?php echo html_entity_decode($dataAbout['range_name'][$key]) ?></h4>
                                <div class="progress">
                                    <div class="progress-bar" role="progressbar" style="width: <?php echo $value ?>%"
                                        aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"><span
                                            class="percent"><?php echo $value ?>%</span></div>
                                </div>
                            </div>
                            <!--/ End Single Skill -->
                        </div>
                        <?php
                        }
                    }
                    endif;
                    ?>




                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!--/ End About Us -->