<?php
if (!defined('_INCODE')) die('Access Deined...');
$data = [
    "pageTitle" => "Trang chủ",
];
layout("header", "client", $data);


$dataService = firstRaw("select opt_value from options where opt_key = 'general_service'");
$dataService = reset($dataService);
$dataService = json_decode($dataService, true);

// echo "<pre>";
// print_r($dataService);
// echo "</pre>";

$itemService = getRaw("select * from services");
// echo "<pre>";
// print_r($itemService);
// echo "</pre>";

$classService = empty($pageService) ? "services section" : "services archives section";

?>

<!-- Services -->
<section id="services" class="<?php echo $classService ?>">
    <div class="container">
        <div class="row">
            <div class="col-12 wow fadeInUp">
                <div class="section-title">
                    <span class="title-bg"><?php echo html_entity_decode($dataService['text_bg']) ?></span>
                    <h1><?php echo html_entity_decode($dataService['heading']) ?></h1>
                    <p><?php echo html_entity_decode($dataService['description']) ?>
                    <p>
                </div>
            </div>
        </div>
        <?php if(empty($pageService)){
            ?>
        <div class="row">
            <div class="col-12">
                <div class="service-slider">
                    <?php 
                    if(!empty($itemService)):
                        foreach ($itemService as $key => $value) {
                            $icon = $value['icon'];
                            ?>
                    <div class="single-service">
                        <?php echo $icon ?>

                        <h2><a
                                href="<?php echo _WEB_HOST_ROOT.'?module=service&action=detail&id='.$value['id'] ?>"><?php echo html_entity_decode($value['name']) ?></a>
                        </h2>
                        <p><?php echo html_entity_decode($value['description']) ?></p>
                    </div>
                    <?php
                        }
                    endif;
                    
                    ?>
                    <!-- Single Service -->

                    <!-- End Single Service -->
                </div>
            </div>
        </div>
        <?php
        } else{
            ?>

        <div class="row">
            <?php 
                    if(!empty($itemService)):
                        foreach ($itemService as $key => $value) {
                            $icon = $value['icon'];
                            ?>
            <div class="col-lg-4 col-md-6 col-12">
                <div class="single-service">
                    <?php echo $icon ?>
                    <h2><a
                            href="<?php echo _WEB_HOST_ROOT.'?module=service&action=detail&id='.$value['id'] ?>"><?php echo html_entity_decode($value['name']) ?></a>
                    </h2>
                    <p><?php echo html_entity_decode($value['description']) ?></p>
                </div>
            </div>
            <?php
                        }
                    endif;
                    
                ?>

        </div>
        <?php
        }
        
        ?>

    </div>
</section>
<!--/ End Services -->