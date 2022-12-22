<?php
if (!defined("_INCODE")) die("Access deneil!");
$data = [
    'pageTitle'=>'Thêm mới blog'
];
layout('header','admin',$data);
layout('sidebar','admin',$data);
layout('breadcrumb','admin',$data);


$userId = isLogin()['user_id'];

if (isPost()) {
    $body = getBody();

    $arrErr = [];
    $name = trim($body['name']);
    $slug = trim($body['slug']);
    if (empty($name)) {
        $arrErr['name']['required'] = 'Tên blog không được để trống!';
    }else {
        if(strlen($name)<4){
            $arrErr['name']['min'] = 'Tên blog có độ dài ít nhất 4 kí tự!';
        }
    }

    if (empty($slug)) {
        $arrErr['slug']['required'] = 'Đường dẫn tĩnh không được bỏ trống!';
    }

    
    
    if (empty($arrErr)) {
        $dataInsert = [
            'name' => $name,
            'slug' => $slug,  
            'user_id'=> $userId,
            'create_at' => date('Y-m-d H:i:s'),
            'update_at' => date('Y-m-d H:i:s'),
        ];
        $result = insert('blog_categories', $dataInsert);
        if ($result) {
            setFlashData('msg',"Thêm blog thành công!");
            setFlashData('msg_type','success');
            // setFlashData('msg', 'Thêm tài khoản thành công!');
            redirect('?module=blog_categories');
        } else {
            setFlashData('msg',"Thêm blog không thành công!");
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
            <label for="">Tiêu đề trang</label>
            <input type="text" name="name" placeholder="Tên blog..." class="form-control name-service" value="<?php getValueInput($data, 'name') ?>">
            <?php getMsgErr($errs, 'name') ?>
        </div>
        <div class="form-group">
            <label for="">Đường dẫn tĩnh</label>
            <input type="text" name="slug" placeholder="Đường dẫn tĩnh..." class="form-control slug" value="<?php getValueInput($data, 'slug') ?>">
            <?php getMsgErr($errs, 'slug') ?>
            <p class="render-link"><b>Link: </b><span></span></p>
        </div>
        <br>
        <button type="submit" class="btn btn-primary">Thêm blog</button>
        <p><a href="?module=blog_categories">Quay lại</a></p>

    </form>
</div>

<?php
layout('footer','admin',$data);

?>