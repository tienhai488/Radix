<?php
if (!defined("_INCODE")) die("Access deneil!");
$data = [
    'pageTitle'=>'Thêm mới dự án'
];
layout('header','admin',$data);
layout('sidebar','admin',$data);
layout('breadcrumb','admin',$data);


$userId = isLogin()['user_id'];

if (isPost()) {
    $body = getBody();

    $arrErr = [];
    $name_group = trim($body['name_group']);
    if (empty($name_group)) {
        $arrErr['name_group']['required'] = 'Tên dự án không được để trống!';
    }else {
        if(strlen($name_group)<4){
            $arrErr['name_group']['min'] = 'Tên dự án có độ dài ít nhất 4 kí tự!';
        }
    }

    
    
    if (empty($arrErr)) {
        $dataInsert = [
            'name' => $name_group,
            'user_id'=> $userId,
            'create_at' => date('Y-m-d H:i:s'),
            'update_at' => date('Y-m-d H:i:s'),
        ];
        $result = insert('portfolio_categories', $dataInsert);
        if ($result) {
            setFlashData('msg',"Thêm dự án thành công!");
            setFlashData('msg_type','success');
            // setFlashData('msg', 'Thêm tài khoản thành công!');
            redirect('?module=portfolio_categories');
        } else {
            setFlashData('msg',"Thêm dự án không thành công!");
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
        <input type="text" name="name_group" autofocus class="form-control" placeholder="Nhập vào tên của dự án cần thêm..." value="<?php getValueInput($data,'name_group') ?>">
        
        <?php getMsgErr($errs, 'name_group') ?>
        <br>
        <button type="submit" class="btn btn-primary">Thêm dự án</button>
        <p><a href="?module=portfolio_categories">Quay lại</a></p>

    </form>
</div>

<?php
layout('footer','admin',$data);

?>