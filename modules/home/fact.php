<?php
if (!defined('_INCODE')) die('Access Deined...');
$data = [
    "pageTitle" => "Trang chủ",
];
layout("header", "client", $data);


$dataService = firstRaw("select opt_value from options where opt_key = 'general_fact'");
$dataService = reset($dataService);
$dataService = json_decode($dataService, true);

// echo "<pre>";
// print_r($dataService);
// echo "</pre>";

?>
<!-- Fun Facts -->
<section id="fun-facts" class="fun-facts section">
    <div class="container">
        <div class="row">
            <div class="col-lg-5 col-12 wow fadeInLeft" data-wow-delay="0.5s">
                <div class="text-content">
                    <div class="section-title">
                        <h1><span><?php echo html_entity_decode($dataService['heading']) ?></span><?php echo html_entity_decode($dataService['sub_title']) ?>
                        </h1>
                        <p><?php echo html_entity_decode($dataService['description']) ?></p>
                        <a href="<?php echo html_entity_decode($dataService['btn_link']) ?>"
                            class="btn primary"><?php echo html_entity_decode($dataService['btn_name']) ?></a>
                    </div>
                </div>
            </div>
            <div class="col-lg-7 col-12">
                <div class="row">
                    <div class="col-lg-6 col-md-6 col-12 wow fadeIn" data-wow-delay="0.6s">
                        <!-- Single Fact -->
                        <div class="single-fact">
                            <div class="icon"><i class="fa fa-clock-o"></i></div>
                            <div class="counter">
                                <p><span class="count"><?php echo getValueOptions("general_age_company") ?></span></p>
                                <h4>years of success</h4>
                            </div>
                        </div>
                        <!--/ End Single Fact -->
                    </div>
                    <div class="col-lg-6 col-md-6 col-12 wow fadeIn" data-wow-delay="0.8s">
                        <!-- Single Fact -->
                        <div class="single-fact">
                            <div class="icon"><i class="fa fa-bullseye"></i></div>
                            <div class="counter">
                                <p><span class="count"><?php echo getValueOptions("general_complete_project") ?></span>
                                </p>
                                <h4>Project Complete</h4>
                            </div>
                        </div>
                        <!--/ End Single Fact -->
                    </div>
                    <div class="col-lg-6 col-md-6 col-12 wow fadeIn" data-wow-delay="1s">
                        <!-- Single Fact -->
                        <div class="single-fact">
                            <div class="icon"><i class="fa fa-dollar"></i></div>
                            <div class="counter">
                                <p><span class="count"><?php echo getValueOptions("general_total_earning") ?></span>M
                                </p>
                                <h4>Total Earnings</h4>
                            </div>
                        </div>
                        <!--/ End Single Fact -->
                    </div>
                    <div class="col-lg-6 col-md-6 col-12 wow fadeIn" data-wow-delay="1.2s">
                        <!-- Single Fact -->
                        <div class="single-fact">
                            <div class="icon"><i class="fa fa-trophy"></i></div>
                            <div class="counter">
                                <p><span class="count"><?php echo getValueOptions("general_award") ?></span></p>
                                <h4>Winning Awards</h4>
                            </div>
                        </div>
                        <!--/ End Single Fact -->
                    </div>


                </div>
            </div>
        </div>
    </div>
</section>
<!--/ End Fun Facts -->