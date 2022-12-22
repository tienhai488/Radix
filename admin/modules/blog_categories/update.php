<?php
if (!defined("_INCODE")) {
    die("Access deneil!");
}
$data = [
    "pageTitle" => "Cập nhập blog",
];
layout("header", "admin", $data);
layout("sidebar", "admin", $data);
layout("breadcrumb", "admin", $data);

$userId = isLogin()['user_id'];

if(isGet()){
    $body = getBody();
    if(!empty($body['id'])){
        $id = $body['id'];
        $n = getRows("select id from blog_categories where id = $id");
        if($n==0){
            setFlashData("msg", "Không tìm thấy blog!");
            setFlashData("msg_type", "danger");
            redirect("?module=blog_categories");
        }else{
            $item = firstRaw("select * from blog_categories where id = $id");
            setFlashData('data',$item);
        }
        
    }else{
        setFlashData("msg", "Không tồn tại đường liên kết!");
        setFlashData("msg_type", "danger");
        redirect("?module=blog_categories");
    }
}

if (isPost()) {
    $body = getBody();

    $arrErr = [];

    $id = $body['id'];
    $name = trim($body["name"]);
    $slug = trim($body["slug"]);

    if (empty($name)) {
        $arrErr["name"]["required"] = "Tên blog không được để trống!";
    } else {
        if (strlen($name) < 5) {
            $arrErr["name"]["min"] = "Tên blog phải có ít nhất 5 kí tự!";
        }
    }

    if (empty($slug)) {
        $arrErr["slug"]["required"] = "Đường dẫn tĩnh không được để trống!";
    }
    

    if (empty($arrErr)) {
        setFlashData("msg", "Dữ liệu hợp lệ!");
        setFlashData("msg_type", "success");
        $dataUpdate = [
            "name" => $name,
            "slug" => $slug,
            "update_at" => date("Y-m-d H:i:s"),
        ];
        $result = update("blog_categories", $dataUpdate,"id = $id");
        if ($result) {
            setFlashData("msg", "Cập nhập blog thành công!");
            setFlashData("msg_type", "success");
        } else {
            setFlashData(
                "msg",
                "Cập nhập blog không thành công! Vui lòng thử lại sau!"
            );
            setFlashData("msg_type", "success");
        }
        redirect("?module=blog_categories");
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
            
        <button type="submit" class="btn btn-primary">Cập nhập blog</button>
        <p><a href="?module=blog_categories">Quay lại</a></p>

    </form>
</div>

<?php layout("footer", "admin", $data);

?>
