<?php
if (!defined("_INCODE")) {
    die("Access deneil!");
}
$data = [
    "pageTitle" => "Cập nhập liên hệ phòng ban",
];
layout("header", "admin", $data);
layout("sidebar", "admin", $data);
layout("breadcrumb", "admin", $data);

$userId = isLogin()['user_id'];

if(isGet()){
    $body = getBody();
    if(!empty($body['id'])){
        $id = $body['id'];
        $n = getRows("select id from contact_type where id = $id");
        if($n==0){
            setFlashData("msg", "Không tìm thấy blog!");
            setFlashData("msg_type", "danger");
            redirect("?module=contact_type");
        }else{
            $item = firstRaw("select * from contact_type where id = $id");
            setFlashData('data',$item);
        }
        
    }else{
        setFlashData("msg", "Không tồn tại đường liên kết!");
        setFlashData("msg_type", "danger");
        redirect("?module=contact_type");
    }
}

if (isPost()) {
    $body = getBody();

    $arrErr = [];

    $id = $body['id'];
    $name = trim($body["name"]);

    if (empty($name)) {
        $arrErr["name"]["required"] = "Tên blog không được để trống!";
    } else {
        if (strlen($name) < 5) {
            $arrErr["name"]["min"] = "Tên blog phải có ít nhất 5 kí tự!";
        }
    }


    if (empty($arrErr)) {
        $dataUpdate = [
            "name" => $name,
            "update_at" => date("Y-m-d H:i:s"),
        ];
        $result = update("contact_type", $dataUpdate,"id = $id");
        if ($result) {
            setFlashData("msg", "Cập nhập liên hệ thành công!");
            setFlashData("msg_type", "success");
        } else {
            setFlashData(
                "msg",
                "Cập nhập liên hệ không thành công! Vui lòng thử lại sau!"
            );
            setFlashData("msg_type", "success");
        }
        redirect("?module=contact_type");
    } else {
        setFlashData("data", $body);
        setFlashData("errs", $arrErr);
        setFlashData("msg", "Vui lòng kiểm tra lại dữ liệu!");
        setFlashData("msg_type", "danger");
    }
}

$errs = getFlashData("errs");
$msg = getFlashData("msg");
$msg_type = getFlashData("msg_type");
$data = getFlashData("data");

echo "<pre>";
print_r($data);
echo "</pre>";
?>
<div style="max-width: 1200px;margin:0 auto; ">
    <?php getMsg($msg, $msg_type); ?>
    <form  method="POST">
        <input type="hidden" name="id" value="<?php echo $data['id'] ?>">
        <div class="form-group">
            <label for="">Tên phòng ban</label>
            <input type="text" name="name" placeholder="Tên phòng ban..." class="form-control name-service" value="<?php getValueInput($data, 'name') ?>">
            <?php getMsgErr($errs, 'name') ?>
        </div>
       
            
        <button type="submit" class="btn btn-primary">Cập nhập</button>
        <p><a href="?module=contact_type">Quay lại</a></p>

    </form>
</div>

<?php layout("footer", "admin", $data);

?>
