<?php
if (!defined("_INCODE")) die("Access deneil!");
$data = [
    'pageTitle'=>'Thêm mới người dùng'
];
layout('header','admin',$data);
layout('sidebar','admin',$data);
layout('breadcrumb','admin',$data);

if (isPost()) {
    $body = getBody();

    $arrErr = [];

    $name = trim($body['name']);
    $email = trim($body['email']);
    $password = trim($body['password']);
    $repeat_password = trim($body['repeat_password']);
    $status = trim($body['status']);
    $group_id = trim($body['group_id']);

    if (empty($name)) {
        $arrErr['name']['required'] = 'Tên đăng nhập không được để trống!';
    } else {
        if (strlen($name) < 5) {
            $arrErr['name']['min'] = 'Tên đăng nhập phải có ít nhất 5 kí tự!';
        }
    }

    if (empty($email)) {
        $arrErr['email']['required'] = 'Email không được để trống!';
    } else {
        if (!isEmail($email)) {
            $arrErr['email']['err'] = 'Email không hợp lệ!';
        } else {
            $sql = "SELECT id FROM users WHERE email = '$email'";
            if (getRows($sql) != 0) {
                $arrErr['email']['unique'] = 'Email đã tồn tại!';
                $body['email']="";
            }
        }
    }
    if (empty($password)) {
        $arrErr['password']['required'] = 'Mật khẩu không được để trống!';
    } else {
        if (strlen($password) < 8) {
            $arrErr['password']['min'] = 'Mật khẩu phải có ít nhất 8 kí tự!';
        }
    }

    if (empty($repeat_password)) {
        $arrErr['repeat_password']['required'] = 'Trường này không được để trống!';
    } else {
        if ($password != $repeat_password) {
            $arrErr['repeat_password']['err'] = 'Mật khẩu nhập lại không đúng!';
            $body['repeat_password'] = '';
        }
    }

    if($group_id==0){
        $arrErr['group_id']['required'] = 'Vui lòng chọn nhóm người dùng!';
    }
    

    if (empty($arrErr)) {
        setFlashData('msg',"Dữ liệu hợp lệ!");
        setFlashData('msg_type','success');
        $dataInsert = [
            'email' => $email,
            'fullname' => $name,
            'password' => password_hash($password, PASSWORD_DEFAULT),
            'status'=>$status,
            'group_id'=>$group_id,
            'create_at' => date('Y-m-d H:i:s'),
            'update_at' => date('Y-m-d H:i:s'),
        ];
        $result = insert('users', $dataInsert);
        if ($result) {
            setFlashData('msg',"Thêm tài khoản thành công!");
            setFlashData('msg_type','success');
        } else {
            setFlashData('msg', 'Thêm tài khoản không thành công! Vui lòng thử lại sau!');
            setFlashData('msg_type','success');
        }
        redirect('?module=users');
    } else {
        setFlashData('data', $body);
        setFlashData('errs', $arrErr);
        setFlashData('msg', 'Vui lòng kiểm tra lại dữ liệu!');
        setFlashData('msg_type','danger');
    }
}


$errs = getFlashData('errs');
$msg = getFlashData('msg');
$msg_type = getFlashData('msg_type');
$data = getFlashData('data');

echo "<pre>";
print_r($data);
echo "</pre>";

?>
<div style="max-width: 1200px;margin:0 auto; ">
    <?php
        getMsg($msg,$msg_type); 
        ?>
    <form  method="POST">
        <div class="row">
            <div class="col-6 form-group">
                <label for="">Họ tên</label>
                <br>
                <input class="form-control" type="text" name="name" placeholder="Nhập họ tên" value="<?php getValueInput($data, 'name') ?>">
                <?php getMsgErr($errs, 'name') ?>
            </div>
            <br>
            <div class="col-6 form-group">
            <label for="">Mật khẩu</label>
        <br>
        <input class="form-control" type="password" name="password" placeholder="Nhập mật khẩu" value="<?php getValueInput($data, 'password') ?>">
        <?php getMsgErr($errs, 'password') ?>
    </div>
    <div class="col-6 form-group">
        <label for="">Nhóm người dùng</label>
        <br>
        <select class="form-control" name="group_id" id="">
            <option value="0">Chọn nhóm người dùng</option>
            <?php 
                $groups = getRaw("select id,name from `groups`");
                foreach ($groups as $item) {
                    ?>
                    <option <?php echo !empty($data) && $data['group_id'] == $item['id'] ? "selected" : False ?> value="<?php echo $item['id'] ?>" ><?php echo $item['name'] ?></option>
                    <?php
                }
                ?>
            </select>
            <?php getMsgErr($errs, 'group_id') ?>
        </div>
        <div class="col-6 form-group">
            <label for="">Nhập lại mật khẩu</label>
            <br>
            <input class="form-control" type="password" name="repeat_password" placeholder="Nhập lại mật khẩu" value="<?php getValueInput($data, 'repeat_password') ?>">
            <?php getMsgErr($errs, 'repeat_password') ?>
        </div>
        <div class="col-6 form-group">
            <label for="">Email</label>
            <br>
            <input class="form-control" type="text" name="email" placeholder="Nhập email..." value="<?php getValueInput($data, 'email') ?>">
            <?php getMsgErr($errs, 'email') ?>
        </div>
        <div class="col-6 form-group">
            <label for="">Trạng thái người dùng</label>
        <br>
            <select class="form-control" name="status" id="">
                <option value="0" <?php echo !empty($data) && $data['status'] == 0 ? "selected" : False ?>>Chưa kích hoạt
                </option>
                <option value="1" <?php echo !empty($data) && $data['status'] == 1 ? "selected" : False ?>>Kích hoạt
                </option>
            </select>
            </div>
        </div>
        <button type="submit" class="btn btn-primary">Thêm người dùng</button>
        <p><a href="?module=users">Quay lại</a></p>

    </form>
</div>

<?php
layout('footer','admin',$data);

?>