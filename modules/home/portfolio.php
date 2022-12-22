<?php
if (!defined('_INCODE')) die('Access Deined...');
$data = [
    "pageTitle" => "Trang chủ",
];
layout("header", "client", $data);


$dataPortfolio = firstRaw("select opt_value from options where opt_key = 'general_portfolio'");
$dataPortfolio = reset($dataPortfolio);
$dataPortfolio = json_decode($dataPortfolio, true);

// echo "<pre>";
// print_r($dataPortfolio);
// echo "</pre>";

$dataCate = getRaw("select * from portfolio_categories");
// echo "<pre>";
// print_r($dataCate);
// echo "</pre>";

$arrPortfolio = getRaw("select * from portfolios");
// echo "<pre>";
// print_r($arrPortfolio);
// echo "</pre>";

?>


<!-- Portfolio -->
<section id="portfolio" class="portfolio section">
    <div class="container">
        <div class="row">
            <div class="col-12 wow fadeInUp">
                <div class="section-title">
                    <span class="title-bg"><?php echo html_entity_decode($dataPortfolio['title_bg']) ?></span>
                    <h1><?php echo html_entity_decode($dataPortfolio['heading']) ?></h1>
                    <p><?php echo html_entity_decode($dataPortfolio['description']) ?>
                    <p>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <!-- portfolio Nav -->
                <div class="portfolio-nav">
                    <ul class="tr-list list-inline" id="portfolio-menu">
                        <li data-filter="*" class="cbp-filter-item active">Tất cả dự án<div class="cbp-filter-counter">
                            </div>
                        </li>
                        <?php 
                        if(!empty($dataCate)){
                            foreach ($dataCate as $value) {
                                ?>
                        <li data-filter=".portfolio-<?php echo $value['id'] ?>" class="cbp-filter-item">
                            <?php echo $value['name'] ?>
                            <div class="cbp-filter-counter">
                            </div>
                        </li>
                        <?php
                            }
                        }
                        ?>


                    </ul>
                </div>
                <!--/ End portfolio Nav -->
            </div>
        </div>
        <div class="portfolio-inner">
            <div class="row">
                <div class="col-12">
                    <div id="portfolio-item">
                        <?php 
                        if(!empty($arrPortfolio)){
                            foreach ($arrPortfolio as  $value) {
                                if(!empty($value['thumbnail'])){ 
                                ?>
                        <!-- Single portfolio -->
                        <div class="cbp-item portfolio-<?php echo $value['portfolio_category_id'] ?>">
                            <div class="portfolio-single">
                                <div class="portfolio-head">
                                    <img src="<?php echo $value['thumbnail'] ?>" alt="#" />
                                </div>
                                <div class="portfolio-hover">
                                    <h4><a href="#"><?php echo $value['name'] ?></a></h4>
                                    <p><?php echo $value['description'] ?>
                                    </p>
                                    <div class="button">
                                        <a data-fancybox="gallery" href="<?php echo $value['thumbnail'] ?>"><i
                                                class="fa fa-search"></i></a>
                                        <a class="video-popup mfp-fade" href="<?php echo $value['video'] ?>">
                                            <i class="fa fa-play"></i></a>
                                        <a
                                            href="<?php echo _WEB_HOST_ROOT.'/?module=portfolio&action=detail&id='.$value['id'] ?>"><i
                                                class="fa fa-link"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--/ End portfolio -->
                        <?php
                                }
                            }
                        }
                        ?>


                    </div>
                </div>
                <?php 
                if(empty($pagePortfolio)):
                ?>
                <div class="col-12">
                    <div class="button">
                        <a class="btn primary"
                            href="<?php echo html_entity_decode($dataPortfolio['btn_link']) ?>"><?php echo html_entity_decode($dataPortfolio['btn_name']) ?></a>
                    </div>
                </div>
                <?php 
                endif;
                ?>
            </div>
        </div>
    </div>
</section>
<!--/ End portfolio -->