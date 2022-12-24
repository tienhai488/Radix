<?php
if (!defined('_INCODE')) die('Access Deined...');
$dataItem = [];
if(empty(getBody()['id'])){
    loadErr();
}else{
    $id = getBody()['id'];
    $dataItem = firstRaw("select * from blog where id = $id");
    if(empty($dataItem)){
        loadErr();
    }
}



if(!empty(getBody()['replay-id'])){
    $replay_id = getBody()['replay-id'];
    $nn = getRows('select * from comments where id = '.$replay_id);
    if($nn == 0){
        loadErr();
    }
    $dataReplay = firstRaw("select * from `comments` where id = $replay_id");
    // echo "<pre>";
    // print_r($dataReplay);
    // echo "</pre>";
    // $nameReplay = $dataReplay['name'];
}
$dataBlog = firstRaw("select opt_value from options where opt_key = 'general_blog'");
$dataBlog = reset($dataBlog);
$dataBlog = json_decode($dataBlog, true);


$idCate =  $dataItem['category_id'];
$nameCate = firstRaw("select name from blog_categories where id = $idCate");
$nameCate = reset($nameCate);
// echo $nameCate;

$data = [
    "pageTitle" =>  !empty($dataItem['title']) ? $dataItem['title']: "Bài viết này do le tien hai viet vao ngay 12 22 2022 nha cac ban!" ,
    "parentLink" => "<li><a href="._WEB_HOST_ROOT.'?module=blog'."><i
    class=\"fa fa-clone\"></i>".$dataBlog['title_blog']."</a></li>"
];
layout("header", "client", $data);
layout("breadcrumb", "client", $data);

$listBlog = getRaw("select * from blog");





$key = array_search($id, array_column($listBlog, 'id'));

$n = count($listBlog);
$pre = $key - 1;
if($pre<0){
    $pre = $n - 1;
}

$next = $key + 1;
if($next>=$n){
    $next = 0;
}

// echo $pre."<br/>";
// echo $key."<br/>";
// echo $next."<br/>";

$idUser =  $dataItem['user_id'];
// echo $idUser;
$dataUser = firstRaw("select * from users where id = $idUser");
// $dataUser = reset($dataUser);

// echo "<pre>";
// print_r($dataUser);
// echo "</pre>";

$n_post = getRows('select id from blog where user_id = '.$idUser);

?>

<!-- Blogs Area -->
<section class="blogs-main archives single section">
    <div class="container">
        <div class="row">
            <div class="col-lg-10 offset-lg-1 col-12">
                <div class="row">
                    <div class="col-12">
                        <!-- Single Blog -->
                        <div class="single-blog">
                            <div class="blog-head">
                                <img src="<?php echo $dataItem['thumbnail'] ?>" alt="#">
                            </div>
                            <div class="blog-inner">
                                <div class="blog-top">
                                    <div class="meta">
                                        <span><i class="fa fa-bolt"></i><a
                                                href="<?php echo _WEB_HOST_ROOT.'?module=blog&action=category&id='.$dataItem['category_id'] ?>"><?php echo $nameCate ?></a></span>
                                        <span><i
                                                class="fa fa-calendar"></i><?php echo getDateFormat($dataItem['create_at'],'d-m-Y  H:i:s') ?></span>
                                        <span><i class="fa fa-eye"></i><a
                                                href="#"><?php echo $dataItem['view_count'] ?></a></span>
                                    </div>
                                    <ul class="social-share">
                                        <li><a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo _WEB_HOST_ROOT.'?module=blog&action=detail&id='.$dataItem['id'] ?>"
                                                target="_blank"><i class="fa fa-facebook"></i></a></li>
                                        <li><a href="http://www.twitter.com/share?url=<?php echo _WEB_HOST_ROOT.'?module=blog&action=detail&id='.$dataItem['id'] ?>"
                                                target="_blank"><i class="fa fa-twitter"></i></a></li>
                                        <li><a href="https://www.linkedin.com/sharing/share-offsite/?url=<?php echo _WEB_HOST_ROOT.'?module=blog&action=detail&id='.$dataItem['id'] ?>"
                                                target="_blank"><i class="fa fa-linkedin"></i></a></li>
                                    </ul>
                                </div>
                                <h2><a href="blog-single.html"><?php echo $dataItem['title'] ?></a></h2>
                                <p><?php echo html_entity_decode($dataItem['content']) ?></p>
                                <blockquote><?php echo html_entity_decode($dataItem['description']) ?></blockquote>

                                <div class="bottom-area">
                                    <!-- Next Prev -->
                                    <ul class="arrow">
                                        <li class="prev"><a
                                                href="<?php echo _WEB_HOST_ROOT.'/?module=blog&action=detail&id='.$listBlog[$pre]['id'] ?>"><i
                                                    class="fa fa-angle-double-left"></i>Bài trước
                                            </a></li>
                                        <li class="next"><a
                                                href="<?php echo _WEB_HOST_ROOT.'/?module=blog&action=detail&id='.$listBlog[$next]['id'] ?>">Bài
                                                sau<i class="fa fa-angle-double-right"></i></a>
                                        </li>
                                    </ul>
                                    <!--/ End Next Prev -->
                                </div>
                            </div>
                        </div>
                        <!-- End Single Blog -->
                    </div>
                    <div class="col-12">
                        <div class="author-details">
                            <div class="author-left">
                                <img src="https://cdn-icons-png.flaticon.com/512/149/149071.png" alt="#">
                                <h4><?php echo $dataUser['fullname'] ?><span>Senior Author</span></h4>
                                <p><a href="#"><i class="fa fa-pencil"></i><?php echo $n_post ?> posts</a></p>
                            </div>
                            <div class="author-content">
                                <p><?php echo $dataUser['about_content'] ?></p>
                                <ul class="social-share">
                                    <li><a href="<?php echo $dataUser['contact_facebook'] ?>"><i
                                                class="fa fa-facebook"></i></a></li>
                                    <li><a href="<?php echo $dataUser['contact_twitter'] ?>"><i
                                                class="fa fa-twitter"></i></a></li>
                                    <li><a href="<?php echo $dataUser['contact_linkedin'] ?>"><i
                                                class="fa fa-linkedin"></i></a></li>
                                    <li><a href="<?php echo $dataUser['contact_pinterest'] ?>"><i
                                                class="fa fa-pinterest"></i></a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-12">

                        <?php require_once _WEB_PATH_ROOT.'/modules/blog/comment.php' ?>
                    </div>
                    <div class="col-12">
                        <?php require_once _WEB_PATH_ROOT.'/modules/blog/form-comment.php' ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!--/ End Blogs Area -->

<?php
layout("footer", "client", $data);
?>