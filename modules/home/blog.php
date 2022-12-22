<?php
if (!defined('_INCODE')) die('Access Deined...');
$data = [
    "pageTitle" => "Trang chủ",
];
layout("header", "client", $data);


$dataBlog = firstRaw("select opt_value from options where opt_key = 'general_blog'");
$dataBlog = reset($dataBlog);
$dataBlog = json_decode($dataBlog, true);

$arrBlog = getRaw("select * from blog");
// echo "<pre>";
// print_r($arrBlog);
// echo "</pre>";

?>

<!-- Blogs Area -->
<section class="blogs-main section">
    <div class="container">
        <div class="row">
            <div class="col-12 wow fadeInUp">
                <div class="section-title">
                    <span class="title-bg"><?php echo html_entity_decode($dataBlog['title_bg']) ?></span>
                    <h1><?php echo html_entity_decode($dataBlog['heading']) ?></h1>
                    <p><?php echo html_entity_decode($dataBlog['description']) ?>
                    <p>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="row blog-slider">
                    <?php 
                    if(!empty($arrBlog)){
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
                                                class="fa fa-calendar"></i><?php echo getDateFormat($value['create_at'],"d-m-Y") ?></span>
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
            </div>
        </div>
    </div>
</section>
<!--/ End Blogs Area -->