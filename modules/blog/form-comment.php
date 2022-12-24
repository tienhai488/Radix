<?php

$userId = "";
if(isLogin()){
    // echo "<pre>";
    // print_r(isLogin());
    // echo "</pre>";
    $userId = isLogin()['user_id'];

    $dataUser = firstRaw('select * from users where id = '.$userId);
    $nameUser = $dataUser['fullname'];
    $emailUser = $dataUser['email'];
}


if(isPost()){
    $body = getBody();

    $arrErr = [];

    $id = trim($body["id"]);
    $website = trim(strip_tags($body["website"]));
    $message = trim(strip_tags($body["message"]));
    
    if(empty($userId)){
        $name = trim(strip_tags($body["name"]));
        $email = trim(strip_tags($body["email"]));

        if (empty($name)) {
            $arrErr["name"]["required"] = "Tên không được để trống!";
        } else {
            if (strlen($name) < 5) {
                $arrErr["name"]["min"] = "Tên phải có ít nhất 5 kí tự!";
            }
        }
    
        if (empty($email)) {
            $arrErr['email']['required'] = 'Email không được để trống!';
        } else {
            if (!isEmail($email)) {
                $arrErr['email']['err'] = 'Email không hợp lệ!';
            } 
        }

    }else{
        $name = trim($nameUser);
        $email = trim($emailUser);
    }

    if (empty($message)) {
        $arrErr["message"]["required"] = "Nội dung bình luận không được để trống!";
    } else {
        if (strlen($message) < 10) {
            $arrErr["message"]["min"] = "Nội dung bình luận phải có ít nhất 10 kí tự!";
        }
    }

    $parent_id = empty($replay_id) ? 0 : $replay_id;

    if (empty($arrErr)) {
        $infoData = [
            "name"=>$name,
            "email"=>$email,
            "website"=>$website
        ];
        setcookie('Info',json_encode($infoData),time()+86400*365);
        $dataInsert = [
            "name" => $name,
            "email" => $email,
            "website" => $website,
            "content" => $message,
            "create_at" => date("Y-m-d H:i:s"),
            "status"=>0,
            "blog_id"=> $id,
            "parent_id"=>  $parent_id,
        ];
        if(!empty($userId)){
            $dataInsert['user_id'] = $userId;
            $dataInsert['status'] = 1;
        }
        $result = insert("comments", $dataInsert);
        if ($result) {
            setFlashData("msg", "Thêm bình luận thành công! Vui lòng chờ duyệt bình luận!");
            setFlashData("msg_type", "success");
            getFlashData("dataForm");
            redirect(_WEB_HOST_ROOT."/?module=blog&action=detail&id=$id");
        } else {
            setFlashData(
                "msg",
                "Thêm bình luận không thành công! Vui lòng thử lại sau!"
            );
            setFlashData("msg_type", "success");
            
        }
    } else {
        setFlashData("dataForm", $body);
        setFlashData("errs", $arrErr);
        setFlashData("msg", "Vui lòng kiểm tra lại dữ liệu!");
        setFlashData("msg_type", "danger");
        redirect(_WEB_HOST_ROOT."/?module=blog&action=detail&id=$id");
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

<div class="comments-form">
    <h2 class="title">

        <?php echo empty($replay_id) ? "Bình luận" : "Trả lời bình luận | ".$dataReplay['name'].' <a href='._WEB_HOST_ROOT.'?module=blog&action=detail&id='.$id.'>Hủy</a>' ?>
    </h2>
    <!-- Contact Form -->
    <?php getMsg($msg, $msg_type); ?>

    <?php 
    if(!empty($userId)){
        $urlLogout = _WEB_HOST_ROOT_ADMIN.'/?module=auth&action=logout';
        echo "<p>Bạn đang đăng nhập với tài khoản <strong>$nameUser</strong> - <a href='$urlLogout'>Đăng xuất</a> </p>  ";
    }
    ?>

    <form class="form" method="post">
        <input type="hidden" name="id" value="<?php echo $id ?>">
        <?php 
if(!empty($replay_id)){
?>
        <input type="hidden" name="replay-id" value="<?php echo $replay_id ?>">
        <?php
        }
        ?>



        <?php if(empty($userId)): ?>
        <div class="row">
            <div class="col-lg-4 col-12">
                <div class="form-group">
                    <input type="text" name="name" placeholder="Tên của bạn.."
                        value="<?php getValueInput($info, 'name') ?>">
                    <?php getMsgErr($errs, 'name') ?>
                </div>
            </div>
            <div class="col-lg-4 col-12">
                <div class="form-group">
                    <input type="text" name="email" placeholder="Email của bạn..."
                        value="<?php getValueInput($info, 'email') ?>">
                    <?php getMsgErr($errs, 'email') ?>
                </div>
            </div>
            <div class="col-lg-4 col-12">
                <div class="form-group">
                    <input type="url" name="website" placeholder="Website của bạn..."
                        value="<?php getValueInput($info, 'website') ?>">
                    <?php getMsgErr($errs, 'website') ?>
                </div>
            </div>
            <?php endif; ?>
            <div class="col-12">
                <div class="form-group">
                    <textarea name="message" rows="5"
                        placeholder="Bình luận của bạn..."><?php getValueInput($dataForm, 'message') ?></textarea>
                    <?php getMsgErr($errs, 'message') ?>
                </div>
            </div>
            <div class="col-12">
                <div class="form-group button">
                    <button type="submit" class="btn primary">Gửi</button>
                </div>
            </div>
        </div>
    </form>
    <!--/ End Contact Form -->
</div>