<?php
if (!defined('_INCODE')) die('Access Deined...');
$dataPortfolio = firstRaw("select opt_value from options where opt_key = 'general_blog'");
$dataPortfolio = reset($dataPortfolio);
$dataPortfolio = json_decode($dataPortfolio, true);

// echo "<pre>";
// print_r($dataPortfolio);
// echo "</pre>";

if (!empty(getBody()['page'])) {
    $page = getBody()['page'];
} else {
    $page = 1;
}

// $temp = $keyword;
// str_replace(" ","+",$temp);
// $queryStr = "keyword=$temp";

$perPage = 3;
// so dong hien thi tren mot trang
$rows = getRows("select id from `blog`");

$maxpage = ceil($rows / $perPage);


if ($page < 1 || $page > $maxpage) {
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

<!-- Start Contact -->
<section id="contact-us" class="contact-us section">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="section-title">
                    <span class="title-bg">Radix</span>
                    <h1>Contact Us</h1>
                    <p>contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of
                        classical Latin literature from 45 BC, making it over 2000 years old
                    <p>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="contact-main">
                    <div class="row">
                        <!-- Contact Form -->
                        <div class="col-lg-8 col-12">
                            <div class="form-main">
                                <div class="text-content">
                                    <h2>Send Message Us</h2>
                                </div>
                                <form class="form" method="post" action="mail/mail.php">
                                    <div class="row">
                                        <div class="col-lg-6 col-12">
                                            <div class="form-group">
                                                <input type="text" name="name" placeholder="Full Name"
                                                    required="required">
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-12">
                                            <div class="form-group">
                                                <input type="email" name="email" placeholder="Your Email"
                                                    required="required">
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-group">
                                                <select name="subject">
                                                    <option class="option" value="1">Starting a new business</option>
                                                    <option class="option" value="2">Startup Consultation</option>
                                                    <option class="option" value="3">Financial Consultation</option>
                                                    <option class="option" value="4">Business Consultation</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-lg-12 col-12">
                                            <div class="form-group">
                                                <textarea name="message" rows="6"
                                                    placeholder="Type Your Message"></textarea>
                                            </div>
                                        </div>
                                        <div class="col-lg-12 col-12">
                                            <div class="form-group button">
                                                <button type="submit" class="btn primary">Submit Message</button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <!--/ End Contact Form -->
                        <!-- Contact Address -->
                        <div class="col-lg-4 col-12">
                            <div class="contact-address">
                                <!-- Address -->
                                <div class="contact">
                                    <h2>Our Contact Address</h2>
                                    <ul class="address">
                                        <li><i class="fa fa-paper-plane"></i><span>Address: </span> Road no 3, Block-D,
                                            Khilgaon 1200, Dhaka Bangladesh</li>
                                        <li><i class="fa fa-phone"></i><span>Phone: </span>+(123) 31222183</li>
                                        <li class="email"><i class="fa fa-envelope"></i><span>Email: </span><a
                                                href="mailto:info@youremail.com">info@youremail.com</a></li>
                                    </ul>
                                </div>
                                <!--/ End Address -->
                                <!-- Social -->
                                <ul class="social">
                                    <li class="active"><a href="#"><i class="fa fa-facebook"></i>Like Us facebook</a>
                                    </li>
                                    <li><a href="#"><i class="fa fa-twitter"></i>Follow Us twitter</a></li>
                                    <li><a href="#"><i class="fa fa-google-plus"></i>Follow Us google-plus</a></li>
                                    <li><a href="#"><i class="fa fa-linkedin"></i>Follow Us linkedin</a></li>
                                    <li><a href="#"><i class="fa fa-behance"></i>Follow Us behance</a></li>
                                </ul>
                                <!--/ End Social -->
                            </div>
                        </div>
                        <!--/ End Contact Address -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!--/ End Contact -->

<?php

layout("footer", "client", $data);

?>