<?php
if (!defined('_INCODE')) die('Access Deined...');
/*
 * File này chứa chức năng đăng nhập
 * */

$data = [
    'pageTitle' => 'Đăng nhập hệ thống'
];

layout('header-login','admin' ,$data);

//Kiểm tra trạng thái đăng nhập
if (isLogin()){
    redirect(getLinkAdmin());
}

//Xử lý đăng nhập
if (isPost()){
    $body = getBody();
    if (!empty(trim($body['email'])) && !empty(trim($body['password']))){
        //Kiểm tra đăng nhập
        $email = $body['email'];
        setFlashData("email",$email);
        $password = $body['password'];

        //Truy vấn lấy thông tin user theo email
        $userQuery = firstRaw("SELECT id, password FROM users WHERE email='$email' AND status=1");

        if (!empty($userQuery)){
            $passwordHash = $userQuery['password'];
            $user_id = $userQuery['id'];
            if (password_verify($password, $passwordHash)){

                //Tạo token login
                $tokenLogin = sha1(uniqid().time());

                //Insert dữ liệu vào bảng login_token
                $dataToken = [
                    'user_id' => $user_id,
                    'token' => $tokenLogin,
                    'create_at' => date('Y-m-d H:i:s')
                ];

                $insertTokenStatus = insert('login_token', $dataToken);
                if ($insertTokenStatus){
                    //Insert token thành công

                    //Lưu login_token vào session
                    setSession('login_token', $tokenLogin);

                    //Chuyển hướng qua trang quản lý users
                    redirect(getLinkAdmin());
                }else{
                    setFlashData('msg', 'Lỗi hệ thống, bạn không thể đăng nhập vào lúc này');
                    setFlashData('msg_type', 'danger');
                    //redirect('?module=auth&action=login');
                }

            }else{
                setFlashData('msg', 'Mật khẩu không chính xác');
                setFlashData('msg_type', 'danger');
                //redirect('?module=auth&action=login');
            }
        }else{
            setFlashData('msg', 'Email không tồn tại trong hệ thống hoặc chưa được kích hoạt');
            setFlashData('msg_type', 'danger');
            //redirect('?module=auth&action=login');
        }
    }else{
        setFlashData('msg', 'Vui lòng nhập email và mật khẩu');
        setFlashData('msg_type', 'danger');
        //redirect('?module=auth&action=login');
    }

    redirect(getLinkAdmin());
}

$msg = getFlashData('msg');
$msgType = getFlashData('msg_type');
$email = getFlashData('email');
?>
<div class="row">
    <div class="col-6" style="margin: 20px auto;">
        <h3 class="text-center text-uppercase">Đăng nhập hệ thống</h3>
        <?php getMsg($msg, $msgType); ?>
        <form action="" method="post">
            <div class="form-group">
                <label for="">Email</label>
                <input type="email" name="email" class="form-control" placeholder="Địa chỉ email..." value="<?php echo !empty($email)? $email : false ?>">
            </div>

            <div class="form-group">
                <label for="">Mật khẩu</label>
                <input type="password" name="password" class="form-control" placeholder="Mật khẩu...">
            </div>
            <button type="submit" class="btn btn-primary btn-block">Đăng nhập</button>
            <hr>
            <p class="text-center"><a href="?module=auth&action=forgot">Quên mật khẩu</a></p>
            <p class="text-center"><a href="?module=auth&action=register">Đăng ký tài khoản</a></p>
        </form>
    </div>
</div>
<?php

layout('footer-login','admin');