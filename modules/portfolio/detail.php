<?php
if (!defined('_INCODE')) die('Access Deined...');
$dataItem = [];
if (empty(getBody()['id'])) {
    loadErr();
} else {
    $id = getBody()['id'];
    $dataItem = firstRaw("select * from portfolios where id = $id");
    if (empty($dataItem)) {
        loadErr();
    }
}
$dataPortfolio = firstRaw("select opt_value from options where opt_key = 'general_portfolio'");
$dataPortfolio = reset($dataPortfolio);
$dataPortfolio = json_decode($dataPortfolio, true);


$idCate =  $dataItem['portfolio_category_id'];
$nameCate = firstRaw("select name from portfolio_categories where id = $idCate");

$nameCate = reset($nameCate);
// echo $nameCate;




$data = [
    "pageTitle" =>  !empty($dataItem['name']) ? $dataItem['name'] : "Dịch vụ",
    "parentLink" => "<li><a href=" . _WEB_HOST_ROOT . '?module=portfolio' . "><i
    class=\"fa fa-clone\"></i>" . $dataPortfolio['title_portfolio'] . "</a></li>"
];
layout("header", "client", $data);
layout("breadcrumb", "client", $data);

// echo "<pre>";
// print_r($dataItem);
// echo "</pre>";
?>
<section id="services" class="services archives section">
    <div class="container">
        <h3><?php echo $dataItem['name'] ?></h3>
        <div style="margin-top: 15px;">
            Chuyên mục: <?php echo $nameCate ?> | Thời gian:
            <?php echo getDateFormat($dataItem['create_at'], 'd-m-Y H:i:s') ?>
        </div>
        <hr>
        <div>
            <?php echo html_entity_decode($dataItem['content']) ?>
        </div>
        <div class="row" style="margin-top: 20px;">
            <?php if (!empty($dataItem['video'])) : ?>
            <div class="col-6">
                <h3>Video</h3>
                <hr>
                <iframe width="100%" height="315"
                    src="https://www.youtube.com/embed/<?php echo getYoutubeId($dataItem['video']) ?>"
                    title="YouTube video player" frameborder="0"
                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                    allowfullscreen></iframe>
            </div>
            <?php endif; ?>

            <?php
            $images = getRaw("select * from portfolio_images where portfolio_id = $id");
            if (!empty($images)) :
                if (!empty($dataItem['video'])) {
                    echo '<div class="col-6">';
                } else {
                    echo '<div class="col-12">';
                }
            ?>
            <h3>Hình ảnh dự án</h3>
            <hr>
            <div class="row">
                <?php
                    
                    // echo "<pre>";
                    // print_r($images);
                    // echo "</pre>";

                    foreach ($images as $key => $value) {
                        // echo $value['image'];
                        if (!empty($value['image'])) {
                    ?>
                <div class="col-4 mb-4">
                    <a href="<?php echo $value['image'] ?>" data-fancybox="gallery">
                        <img src="<?php echo $value['image'] ?>" alt=""></a>

                </div>
                <?php
                        }
                    }

                    ?>


            </div>

            <?php
            endif;
            ?>
        </div>
    </div>
    </div>
</section>
<?php
layout("footer", "client", $data);
?>