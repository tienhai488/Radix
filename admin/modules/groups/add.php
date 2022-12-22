<?php
if (!defined("_INCODE")) die("Access deneil!");
$data = [
    'pageTitle'=>'Thêm mới nhóm'
];
layout('header','admin',$data);
layout('sidebar','admin',$data);
layout('breadcrumb','admin',$data);

if (isPost()) {
    $body = getBody();

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
        $dataInsert = [
            'name' => $name_group,
            'create_at' => date('Y-m-d H:i:s'),
            'update_at' => date('Y-m-d H:i:s'),
        ];
        $result = insert('groups', $dataInsert);
        if ($result) {
            setFlashData('msg',"Thêm nhóm thành công!");
            setFlashData('msg_type','success');
            // setFlashData('msg', 'Thêm tài khoản thành công!');
            redirect('?module=groups');
        } else {
            setFlashData('msg',"Thêm nhóm không thành công!");
            setFlashData('msg_type','danger');
            // setFlashData('msg', 'Thêm tài khoản không thành công! Vui lòng thử lại sau!');
        }
        
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
        
        <?php getMsgErr($errs, 'name_group') ?>
        <br>
        <button type="submit" class="btn btn-primary">Thêm nhóm</button>
        <p><a href="?module=groups">Quay lại</a></p>

    </form>
</div>

<?php
layout('footer','admin',$data);

?>