<?php
if (!defined("_INCODE")) die("Access deneil!");
$data = [
    'pageTitle'=>'Cập nhập nhóm'
];
layout('header','admin',$data);
layout('sidebar','admin',$data);
layout('breadcrumb','admin',$data);

if(isGet()){
    $body = getBody();
    if(!empty($body['id'])){
        $id = $body['id'];
        $n = getRows("select id from `groups` where id = '$id'");
        if($n != 0){
            $group = firstRaw("select * from `groups` where id = '$id'");
            $name_group = $group['name'];
            setFlashData('old',['name_group'=>$name_group]);
        }else {
            setFlashData('msg',"Không tìm thấy nhóm nào!");
            setFlashData('msg_type','danger');
            redirect('?module=groups');
        }
        
    }else {
        setFlashData('msg',"Đường dẫn không tồn tại!");
        setFlashData('msg_type','danger');
        redirect('?module=groups');
    }
}

if (isPost()) {
    $body = getBody();

    $id = getBody()['id'];

    $arrErr = [];
    $name_group = trim($body['name_group']);
    if (empty($name_group)) {
        $arrErr['name_group']['required'] = 'Tên nhóm không được để trống!';
    }else {
        if(strlen($name_group)<4){
            $arrErr['name_group']['min'] = 'Tên nhóm có độ dài ít nhất 4 kí tự!';
        }
    }

    setFlashData('old',['name_group'=>$name_group]);
    
    setFlashData('data', $_POST);

    if (empty($arrErr)) {
        $dataUpdate = [
            'name' => $name_group,
            'update_at' => date('Y-m-d H:i:s'),
        ];
        $result = update('groups', $dataUpdate,"id = $id");
        if ($result) {
            setFlashData('msg',"Cập nhập nhóm thành công!");
            setFlashData('msg_type','success');
            // setFlashData('msg', 'Thêm tài khoản thành công!');
        } else {
            setFlashData('msg',"Cập nhập nhóm không thành công!Vui lòng thử lại!");
            setFlashData('msg_type','danger');
            // setFlashData('msg', 'Thêm tài khoản không thành công! Vui lòng thử lại sau!');
        }
        redirect('?module=groups');
        
    } else {
        setFlashData("errs",$arrErr);
        setFlashData('msg',"Vui lòng kiểm tra dữ liệu nhập vào!");
        setFlashData('msg_type','danger');
    }
}


$msg = getFlashData('msg');
$msg_type = getFlashData('msg_type');
$errs = getFlashData('errs');
$old = getFlashData('old');

?>
<div style="max-width: 1200px;margin:0 auto; ">
        <?php
        getMsg($msg,$msg_type); 
        ?>
    <form action="" method="POST">
        <input type="text" name="name_group" class="form-control" placeholder="Nhập vào tên của nhóm cần thêm..." value="<?php echo old('name_group',$old) ?>">
        <input type="hidden" name='id' value="<?php echo getBody()['id'] ?>">
        <?php getMsgErr($errs, 'name_group') ?>
        <br>
        <button type="submit" class="btn btn-primary">Cập nhập</button>
        <p><a href="?module=groups">Quay lại</a></p>

    </form>
</div>

<?php
layout('footer','admin',$data);

?>