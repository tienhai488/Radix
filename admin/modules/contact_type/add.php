<?php
if (!defined("_INCODE")) die("Access deneil!");
$data = [
    'pageTitle'=>'Thêm mới liên hệ phòng ban'
];
layout('header','admin',$data);
layout('sidebar','admin',$data);
layout('breadcrumb','admin',$data);


$userId = isLogin()['user_id'];

if (isPost()) {
    $body = getBody();

    $arrErr = [];
    $name = trim($body['name']);
    if (empty($name)) {
        $arrErr['name']['required'] = 'Tên phòng ban không được để trống!';
    }else {
        if(strlen($name)<4){
            $arrErr['name']['min'] = 'Tên phòng ban có độ dài ít nhất 4 kí tự!';
        }
    }

    
    
    if (empty($arrErr)) {
        $dataInsert = [
            'name' => $name,
            'create_at' => date('Y-m-d H:i:s'),
            'update_at' => date('Y-m-d H:i:s'),
        ];
        $result = insert('contact_type', $dataInsert);
        if ($result) {
            setFlashData('msg',"Thêm liên hệ phòng ban thành công!");
            setFlashData('msg_type','success');
            // setFlashData('msg', 'Thêm tài khoản thành công!');
            redirect('?module=contact_type');
        } else {
            setFlashData('msg',"Thêm liên hệ phòng ban không thành công!");
            setFlashData('msg_type','danger');
            // setFlashData('msg', 'Thêm tài khoản không thành công! Vui lòng thử lại sau!');
        }
        
    } else {
        setFlashData('data', $body);
        setFlashData("errs",$arrErr);
        setFlashData('msg',"Vui lòng kiểm tra dữ liệu nhập vào!");
        setFlashData('msg_type','danger');
    }
}



$msg = getFlashData('msg');
$msg_type = getFlashData('msg_type');
$errs = getFlashData('errs');
$data = getFlashData('data');

?>
<div style="max-width: 1200px;margin:0 auto; ">
        <?php
        getMsg($msg,$msg_type); 
        ?>
    <form action="" method="POST">
        <div class="form-group">
            <label for="">Tiêu phòng ban</label>
            <input type="text" name="name" placeholder="Tên phòng ban..." class="form-control name-service" value="<?php getValueInput($data, 'name') ?>">
            <?php getMsgErr($errs, 'name') ?>
        </div>
        <br>
        <button type="submit" class="btn btn-primary">Thêm liên hệ</button>
        <p><a href="?module=blog_categories">Quay lại</a></p>

    </form>
</div>

<?php
layout('footer','admin',$data);

?>