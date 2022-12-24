<?php
if (!defined('_INCODE')) die('Access Deined...');
$dataContact = firstRaw("select opt_value from options where opt_key = 'general_contact'");
$dataContact = reset($dataContact);
$dataContact = json_decode($dataContact, true);

// echo "<pre>";
// print_r($dataContact);
// echo "</pre>";

$data = [
    "pageTitle" =>  !empty($dataContact['title_contact']) ? $dataContact['title_contact'] : "Contact",
];
layout("header", "client", $data);
layout("breadcrumb", "client", $data);


?>

<!-- Start Contact -->
<section id="contact-us" class="contact-us section">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="section-title">
                    <span class="title-bg"><?php echo html_entity_decode($dataContact['title_bg']) ?></span>
                    <h1><?php echo html_entity_decode($dataContact['heading']) ?></h1>
                    <p><?php echo html_entity_decode($dataContact['description']) ?>
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
                                        <li><i class="fa fa-paper-plane"></i><span>Address:
                                            </span><?php echo getValueOptions("general_address") ?></li>
                                        <li><i class="fa fa-phone"></i><span>Phone:
                                            </span><?php echo getValueOptions("general_hotline") ?></li>
                                        <li class="email"><i class="fa fa-envelope"></i><span>Email: </span><a
                                                href="mailto:<?php echo getValueOptions("general_email") ?>"><?php echo getValueOptions("general_email") ?></a>
                                        </li>
                                    </ul>
                                </div>
                                <!--/ End Address -->
                                <!-- Social -->
                                <ul class="social">
                                    <li class="active"><a href="<?php echo getValueOptions("general_facebook") ?>"><i
                                                class="fa fa-facebook"></i>Like Us facebook</a>
                                    </li>
                                    <li><a href="<?php echo getValueOptions("general_twitter") ?>"><i
                                                class="fa fa-twitter"></i>Follow Us twitter</a></li>
                                    <li><a href="<?php echo getValueOptions("general_linkedin") ?>"><i
                                                class="fa fa-linkedin"></i>Follow Us linkedin</a></li>
                                    <li><a href="<?php echo getValueOptions("general_github") ?>"><i
                                                class="fa fa-github"></i>Follow Us linkedin</a></li>
                                    <li><a href="<?php echo getValueOptions("general_youtube") ?>"><i
                                                class="fa fa-youtube"></i>Follow Us linkedin</a></li>
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