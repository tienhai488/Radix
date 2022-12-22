<?php
if (!defined('_INCODE')) die('Access Deined...');
$data = [
    "pageTitle" => "Trang chủ",
];
layout("header", "client", $data);


$dataAction = firstRaw("select opt_value from options where opt_key = 'general_action'");
$dataAction = reset($dataAction);
$dataAction = json_decode($dataAction, true);

?>

<!-- Call To Action -->
<section class="call-to-action section" data-stellar-background-ratio="0.5">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 col-12 wow fadeInUp">
                <div class="call-to-main">
                    <h2><?php echo html_entity_decode($dataAction['heading']) ?></h2>
                    <p><?php echo html_entity_decode($dataAction['description']) ?></p>
                    <a href="<?php echo html_entity_decode($dataAction['btn_link']) ?>"
                        class="btn"><?php echo html_entity_decode($dataAction['btn_name']) ?></a>
                </div>
            </div>
        </div>
    </div>
</section>
<!--/ End Call To Action -->