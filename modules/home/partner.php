<?php
if (!defined('_INCODE')) die('Access Deined...');
$data = [
    "pageTitle" => "Trang chủ",
];
layout("header", "client", $data);


$dataPartner = firstRaw("select opt_value from options where opt_key = 'general_partner'");
$dataPartner = reset($dataPartner);
$dataPartner = json_decode($dataPartner, true);

// echo "<pre>";
// print_r($dataPartner);
// echo "</pre>";

?>

<!-- Partners -->
<section id="partners" class="partners section">
    <div class="container">
        <div class="row">
            <div class="col-12 wow fadeInUp">
                <div class="section-title">
                    <span class="title-bg"><?php echo html_entity_decode($dataPartner['title_bg']) ?></span>
                    <h1><?php echo html_entity_decode($dataPartner['heading']) ?></h1>
                    <p><?php echo html_entity_decode($dataPartner['description']) ?>
                    </p>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="partners-inner">
                    <div class="row no-gutters">
                        <!-- Single Partner -->

                        <?php 
                        if(!empty($dataPartner['image'])){
                            foreach ($dataPartner['image'] as $key => $value) {
                                if(!empty($value)){ 
                                ?>
                        <div class="col-lg-2 col-md-3 col-12">
                            <div class="single-partner">
                                <a href="<?php echo $dataPartner['link'][$key] ?>" target="_blank"><img
                                        src="<?php echo $value ?>" alt="#"></a>
                            </div>
                        </div>
                        <?php
                                }
                            }
                        }
                        ?>

                        <!--/ End Single Partner -->

                    </div>
                </div>
            </div>
        </div>
    </div>
</section>