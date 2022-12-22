<?php
if (!defined("_INCODE")) {
    die("Access deneil!");
}
$data = [
    "pageTitle" => "Cập nhập dự án",
];
layout("header", "admin", $data);
layout("sidebar", "admin", $data);
layout("breadcrumb", "admin", $data);

$userId = isLogin()['user_id'];

if(isGet()){
    $body = getBody();
    if(!empty($body['id'])){
        $id = $body['id'];
        $n = getRows("select id from portfolio_categories where id = $id");
        if($n==0){
            setFlashData("msg", "Không tìm thấy dự án!");
            setFlashData("msg_type", "danger");
            redirect("?module=portfolio_categories");
        }else{
            $item = firstRaw("select * from portfolio_categories where id = $id");
            setFlashData('data',$item);
        }
        
    }else{
        setFlashData("msg", "Dự án không tồn tại!");
        setFlashData("msg_type", "danger");
        redirect("?module=portfolio_categories");
    }
}

if (isPost()) {
    $body = getBody();

    $arrErr = [];

    $id = $body['id'];
    $name = trim($body["name"]);

    if (empty($name)) {
        $arrErr["name"]["required"] = "Tên dự án không được để trống!";
    } else {
        if (strlen($name) < 5) {
            $arrErr["name"]["min"] = "Tên dự án phải có ít nhất 5 kí tự!";
        }
    }
    

    if (empty($arrErr)) {
        setFlashData("msg", "Dữ liệu hợp lệ!");
        setFlashData("msg_type", "success");
        $dataUpdate = [
            "name" => $name,
            "update_at" => date("Y-m-d H:i:s"),
        ];
        $result = update("portfolio_categories", $dataUpdate,"id = $id");
        if ($result) {
            setFlashData("msg", "Cập nhập dự án thành công!");
            setFlashData("msg_type", "success");
        } else {
            setFlashData(
                "msg",
                "Cập nhập dự án không thành công! Vui lòng thử lại sau!"
            );
            setFlashData("msg_type", "success");
        }
        redirect("?module=portfolio_categories");
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
            <label for="">Tên dự án</label>
            <input type="text" name="name" placeholder="Tên dự án..." class="form-control name-service" value="<?php getValueInput($data, 'name') ?>">
            <?php getMsgErr($errs, 'name') ?>
        </div>
            
        <button type="submit" class="btn btn-primary">Cập nhập dự án</button>
        <p><a href="?module=portfolio_categories">Quay lại</a></p>

    </form>
</div>

<?php layout("footer", "admin", $data);

?>
