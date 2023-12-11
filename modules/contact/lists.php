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

if(isPost()){
    $body = getBody();

    $arrErr = [];

    $fullname = trim(strip_tags($body["fullname"]));
    $email = trim(strip_tags($body["email"]));
    $type_id = $body["type_id"];
    $message = trim(strip_tags($body["message"]));
    
    
    if (empty($fullname)) {
        $arrErr["fullname"]["required"] = "Họ tên không được để trống!";
    } else {
        if (strlen($fullname) < 5) {
            $arrErr["fullname"]["min"] = "Họ tên phải có ít nhất 5 kí tự!";
        }
    }

    if (empty($email)) {
        $arrErr['email']['required'] = 'Email không được để trống!';
    } else {
        if (!isEmail($email)) {
            $arrErr['email']['err'] = 'Email không hợp lệ!';
        } 
    }
    
    if($type_id==0){
        $arrErr['type_id']['required'] = 'Vui lòng chọn phòng ban bạn muốn liên hệ!';
    }


    if (empty($message)) {
        $arrErr["message"]["required"] = "Nội dung liên hệ không được để trống!";
    } else {
        if (strlen($message) < 10) {
            $arrErr["message"]["min"] = "Nội dung liên hệ phải có ít nhất 10 kí tự!";
        }
    }


    if (empty($arrErr)) {
        $infoData = empty($_COOKIE['Info']) ? [] : json_decode($_COOKIE['Info'],true);
        $infoData['name'] = $fullname;
        $infoData['email'] = $email;
        setcookie('Info',json_encode($infoData),time()+86400*365);
        $dataInsert = [
            "fullname" => $fullname,
            "email" => $email,
            "type_id" => $type_id,
            "message" => $message,
            "create_at" => date("Y-m-d H:i:s"),
        ];
        
        $result = insert("contacts", $dataInsert);
        if ($result) {
            setFlashData("msg", "Gửi liên hệ thành công! Vui lòng chờ phản hồi!");
            setFlashData("msg_type", "success");
            getFlashData("dataForm");
            redirect(_WEB_HOST_ROOT."/?module=contact");
        } else {
            setFlashData(
                "msg",
                "Gửi liên hệ không thành công! Vui lòng thử lại sau!"
            );
            setFlashData("msg_type", "success");
            
        }
    } else {
        setFlashData("dataForm", $body);
        setFlashData("errs", $arrErr);
        setFlashData("msg", "Vui lòng kiểm tra lại dữ liệu!");
        setFlashData("msg_type", "danger");
        redirect(_WEB_HOST_ROOT."/?module=contact");
    }
}

$errs = getFlashData("errs");
$msg = getFlashData("msg");
$msg_type = getFlashData("msg_type");
$dataForm = getFlashData("dataForm");
$info = [];
if(!empty($_COOKIE['Info'])){
    $info = json_decode($_COOKIE['Info'],true);
}


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
                    <?php getMsg($msg, $msg_type); ?>
                    <div class="row">
                        <!-- Contact Form -->
                        <div class="col-lg-8 col-12">
                            <div class="form-main">
                                <div class="text-content">
                                    <h2>Liên hệ</h2>
                                </div>
                                <form class="form" method="post">
                                    <div class="row">
                                        <div class="col-lg-6 col-12">
                                            <div class="form-group">
                                                <input type="text" name="fullname" placeholder="Họ Tên"
                                                    value="<?php getValueInput($info, 'name') ?>">
                                                <?php getMsgErr($errs, 'fullname') ?>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-12">
                                            <div class="form-group">
                                                <input type="email" name="email" placeholder="Email"
                                                    value="<?php getValueInput($info, 'email') ?>">
                                                <?php getMsgErr($errs, 'email') ?>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-group">
                                                <select name="type_id">
                                                    <option value="0">Chọn phòng ban liên hệ</option>
                                                    <?php 
                                                    $groupType = getRaw("select id,name from contact_type");
                                                    if(!empty($groupType)):
                                                        foreach ($groupType as $key => $value) {
                                                            echo "<option class='option' value=".$value['id'].">".$value['name']."</option>";
                                                        }
                                                    endif;
                                                    ?>


                                                </select>
                                                <?php getMsgErr($errs, 'type_id') ?>
                                            </div>
                                        </div>
                                        <div class="col-lg-12 col-12">
                                            <div class="form-group">
                                                <textarea name="message" rows="6" placeholder="Nội dung"></textarea>
                                                <?php getMsgErr($errs, 'message') ?>
                                            </div>
                                        </div>
                                        <div class="col-lg-12 col-12">
                                            <div class="form-group button">
                                                <button type="submit" class="btn primary">Gửi Liên Hệ</button>
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
                                                class="fa fa-facebook"></i>Like Us Facebook</a>
                                    </li>
                                    <li><a href="<?php echo getValueOptions("general_twitter") ?>"><i
                                                class="fa fa-twitter"></i>Follow Us Twitter</a></li>
                                    <li><a href="<?php echo getValueOptions("general_linkedin") ?>"><i
                                                class="fa fa-linkedin"></i>Follow Us Linkedin</a></li>
                                    <li><a href="<?php echo getValueOptions("general_github") ?>"><i
                                                class="fa fa-github"></i>Follow Us Github</a></li>
                                    <li><a href="<?php echo getValueOptions("general_youtube") ?>"><i
                                                class="fa fa-youtube"></i>Follow Us Youtube</a></li>
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