<?php
$data = [
    'pageTitle'=>'Cập nhập thông tin cá nhân'
];
layout('header','admin',$data);
layout('sidebar','admin',$data);
layout('breadcrumb','admin',$data);

$userId = isLogin()['user_id'];
$userDetail = getUserInfo($userId);

if(isPost()){
    $body = getBody();
    setFlashData('data',$body);

    $arrErr = [];
    $old_password = trim($body['old_password']);
    $new_password = trim($body['new_password']);
    $repeat_password = trim($body['repeat_password']);

    if (empty($old_password)) {
        $arrErr['old_password']['required'] = 'Mật khẩu không được để trống!';
    } else {
        if (strlen($old_password) < 8) {
            $arrErr['old_password']['min'] = 'Mật khẩu ít nhất 8 kí tự!';
        } else{
            if(password_verify($old_password,$userDetail['password'])){

            }else {
                $arrErr['old_password']['check'] = 'Mật khẩu nhập vào không trùng với mật khẩu hiện tại!';
            }
        }
    }

    if (empty($new_password)) {
        $arrErr['new_password']['required'] = 'Mật khẩu mới không được để trống!';
    } else {
        if (strlen($new_password) < 8) {
            $arrErr['new_password']['min'] = 'Mật khẩu ít nhất 8 kí tự!';
        } else{
            
        }
    }

    if ($new_password!=$repeat_password) {
        $arrErr['repeat_password']['check'] = 'Mật khẩu nhập lại không hợp lệ!';
    } 

 
    setFlashData("errs",$arrErr);
    if(empty($arrErr)){
        $pass_hash = password_hash($new_password,PASSWORD_DEFAULT);
        $dataUpdate = [

            'password'=>$pass_hash,
            'update_at'=>date('Y-m-d H:i:s')
        ];
        $checkUpdate = update('users',$dataUpdate,"id = $userId");
        if($checkUpdate){
            setFlashData('msg',"Đổi mật khẩu thành công!");
            setFlashData('msg_type','success');

            //Thiết lập gửi email
            $subject = 'Thay đổi mật khẩu thành công!';
            $content = 'Chào bạn: '.$userDetail['fullname'].' bạn vừa thay đổi mật khẩu thành công! Nếu không phải bạn thì vui lòng liên hệ với chúng tôi!';

            //Tiến hành gửi email
            $sendStatus = sendMail($userDetail['email'], $subject, $content);
            if($sendStatus){
                redirect("?module=auth&action=logout");
            }

        }else{
            setFlashData('msg',"Hệ thống đã gặp sự cố vui lòng thử lại sau!");
            setFlashData('msg_type','danger');
        }
      
    }else {
        setFlashData('msg',"Vui lòng kiểm tra lại dữ liệu nhập vào!");
        setFlashData('msg_type','danger');
        setFlashData("ers",$arrErr);
    }
    redirect(getLinkAdmin('users','change_password'));
}

$errs = getFlashData('errs');
$data = getFlashData('data');

$msg = getFlashData("msg");
$msg_type = getFlashData("msg_type");

?>
    <section class="content">
        <div class="container-fluid">
            <?php getMsg($msg,$msg_type) ?>
            <form action="" method="POST" >
                <div class="form-group">
                    <label for="">Nhập mật khẩu</label>
                    <input type="password" name="old_password" class="form-control" placeholder="Nhập lại mật khẩu cũ..." 
                    >
                    <?php getMsgErr($errs, 'old_password') ?>
                </div>

                <div class="form-group">
                    <label for="">Nhập mật khẩu mới</label>
                    <input type="password" name="new_password" class="form-control" placeholder="Nhập mật khẩu mới..."  >
                    <?php getMsgErr($errs, 'new_password') ?>
                </div>
                <div class="form-group">
                    <label for="">Nhập lại mật khẩu</label>
                    <input type="password" name="repeat_password" class="form-control" placeholder="Nhập lại mật khẩu..." >
                    <?php getMsgErr($errs, 'repeat_password') ?>
                </div>
                
                <button type="submit" class="btn btn-primary">Đổi mật khẩu</button>
            </form>
        </div>
    </section>
  
<?php
layout('footer','admin',$data);
?>