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

    $arrErr = [];
    $name = trim($body['fullname']);
    if (empty($name)) {
        $arrErr['name']['required'] = 'Tên đăng nhập không được để trống!';
    } else {
        if (strlen($name) < 5) {
            $arrErr['name']['min'] = 'Tên đăng nhập phải có ít nhất 5 kí tự!';
        }
    }
    setFlashData("errs",$arrErr);
    if(empty($arrErr)){
        $dataUpdate = [
            'fullname'=>$body['fullname'],
            'contact_facebook'=>$body['contact_facebook'],
            'contact_twitter'=>$body['contact_twitter'],
            'contact_linkedin'=>$body['contact_linkedin'],
            'contact_pinterest'=>$body['contact_pinterest'],
            'about_content'=>$body['about_content'],
            'update_at'=>date('Y-m-d H:i:s')
        ];
        $checkUpdate = update('users',$dataUpdate,"id = $userId");
        if($checkUpdate){
            redirect("?module=dashboard");
        }
      
    }else {
        $userDetail['fullname'] = $body['fullname'];
        $userDetail['contact_facebook'] = $body['contact_facebook'];
        $userDetail['contact_twitter'] = $body['contact_twitter'];
        $userDetail['contact_linkedin'] = $body['contact_linkedin'];
        $userDetail['contact_pinterest'] = $body['contact_pinterest'];
        $userDetail['about_content'] = $body['about_content'];
    }
}

$errs = getFlashData('errs');

?>
    <section class="content">
        <div class="container-fluid">
            <form action="" method="POST" >
                <div class="row">
                    <div class="col-12">
                        <div class="form-group">
                            <label for="">Họ và tên</label>
                            <input type="text" name="fullname" class="form-control" placeholder="Họ và tên..." value="<?php echo !empty($userDetail['fullname']) ? $userDetail['fullname'] : false ?>">
                            <?php getMsgErr($errs, 'name') ?>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <label for="">Facebook</label>
                            <input type="text" name="contact_facebook" class="form-control" placeholder="Link facebook" value="<?php echo !empty($userDetail['contact_facebook']) ? $userDetail['contact_facebook'] : false ?>" >
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <label for="">Twitter</label>
                            <input type="text" name="contact_twitter" class="form-control" placeholder="Link twitter"value="<?php echo !empty($userDetail['contact_twitter']) ? $userDetail['contact_twitter'] : false ?>">
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <label for="">Linkedin</label>
                            <input type="text" name="contact_linkedin" class="form-control" placeholder="Link Linkedin" value="<?php echo !empty($userDetail['contact_linkedin']) ? $userDetail['contact_linkedin'] : false ?>">
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <label for="">Pinterest</label>
                            <input type="text" name="contact_pinterest" class="form-control" placeholder="Link Pinterest" value="<?php echo !empty($userDetail['contact_pinterest']) ? $userDetail['contact_pinterest'] : false ?>">
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="form-group">
                            <label for="">About Content</label>
                            <textarea class="form-control" name="about_content" id="" cols="30" rows="5" placeholder="Nội dung giới thiệu..."><?php 
                            $value = "";
                            if(!empty($userDetail['about_content'])){
                                $value =  $userDetail['about_content'];
                            }
                            echo $value; 
                            ?></textarea>
                        </div>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary">Cập nhập</button>
            </form>
        </div>
    </section>
  
<?php
layout('footer','admin',$data);
?>