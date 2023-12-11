<?php
if (!defined('_INCODE')) die('Access Deined...');
$dataPortfolio = firstRaw("select opt_value from options where opt_key = 'general_blog'");
$dataPortfolio = reset($dataPortfolio);
$dataPortfolio = json_decode($dataPortfolio, true);

// echo "<pre>";
// print_r($dataPortfolio);
// echo "</pre>";
// $queryStr = "keyword=$temp";

$perPage = 3;
// so dong hien thi tren mot trang
$rows = getRows("select id from `blog`");

$maxpage = ceil($rows / $perPage);


if ($page < 1 || $page > $maxpage) {

if (!empty(getBody()['page'])) {
    $page = getBody()['page'];
} else {
    $page = 1;
}

// $temp = $keyword;
// str_replace(" ","+",$temp);
    $page = 1;
}

$index = ($page - 1) * $perPage;

$pagePortfolio = true;
$data = [
    "pageTitle" =>  !empty($dataPortfolio['title_blog']) ? $dataPortfolio['title_blog'] : "Dự án",
];
layout("header", "client", $data);
layout("breadcrumb", "client", $data);

$arrBlog = getRaw("select * from blog limit $index,$perPage");

?>
<!-- Blogs Area -->
<section class="blogs-main archives section">
    <div class="container">
        <div class="row">
            <?php
            if (!empty($arrBlog)) {
                foreach ($arrBlog as  $value) {
                    $cateId = $value['category_id'];
                    $cate = firstRaw("select name from blog_categories where id = $cateId");

            ?>
            <div class="col-lg-4 col-12">
                <!-- Single Blog -->
                <div class="single-blog">
                    <div class="blog-head">
                        <img src="<?php echo ($value['thumbnail']) ?>" alt="#">
                    </div>
                    <div class="blog-bottom">
                        <div class="blog-inner">
                            <h4><a
                                    href="<?php echo _WEB_HOST_ROOT.'/?module=blog&action=detail&id='.$value['id'] ?>"><?php echo html_entity_decode($value['title']) ?></a>
                            </h4>
                            <p><?php echo html_entity_decode($value['content']) ?></p>
                            <div class="meta">
                                <span><i class="fa fa-bolt"></i><a
                                        href="<?php echo _WEB_HOST_ROOT.'?module=blog&action=category&id='.$value['category_id'] ?>"><?php echo reset($cate) ?></a></span>
                                <span><i
                                        class="fa fa-calendar"></i><?php echo getDateFormat($value['create_at'], "d-m-Y") ?></span>
                                <span><i class="fa fa-eye"></i><a
                                        href="#"><?php echo ($value['view_count']) ?></a></span>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- End Single Blog -->
            </div>
            <?php
                }
            }
            ?>


        </div>
        <div class="row">
            <div class="col-12">
                <!-- Start Pagination -->
                <div class="pagination-main">
                    <ul class="pagination">
                        <li class="prev"><a href="?module=blog&page=<?php echo $page > 1 ? $page -= 1 : $page ?>"><i
                                    class="fa fa-angle-double-left"></i></a></li>

                        <?php
                        $start = $page - 2;
                        if ($start < 1) {
                            $start = 1;
                        }
                        $end = $start + 4;
                        if ($end > $maxpage) {
                            $end = $maxpage;
                            $start = $end - 4;
                            if ($start < 1) {
                                $start = 1;
                            }
                        }
                        for ($i = $start; $i <= $end; $i++) {
                            $link = _WEB_HOST_ROOT . "/?module=blog&page=$i";

                        ?>
                        <li class='<?php
                                        $active = 1;
                                        if (!empty(getBody()['page'])) {
                                            $active = getBody()['page'];
                                            if ($active < 1 || $active > $maxpage) {
                                                $active = 1;
                                            }
                                        }
                                        echo $active == $i ? 'active' : 'li' ?>'>
                            <a href="<?php echo $link ?>">
                                <?php echo $i ?></a>
                        </li>
                        <?php
                        }
                        ?>

                        <li class="next"><a
                                href="?module=blog&page=<?php $index =  empty(getBody()['page']) ? 2 : getBody()['page'] + 1;
                                                                    if ($index < 1) {
                                                                        $index = 1;
                                                                    }
                                                                    echo ($index > $maxpage) ? $maxpage : $index; ?>"><i
                                    class="fa fa-angle-double-right"></i></a></li>
                    </ul>
                </div>
                <!--/ End Pagination -->
            </div>
        </div>
    </div>
</section>
<!--/ End Blogs Area -->
<?php

layout("footer", "client", $data);

?>