<?php
if (!defined("_INCODE")) {
    die("Access deneil!");
}
$data = [
    "pageTitle" => "Thêm dịch vụ",
];
layout("header", "admin", $data);
layout("sidebar", "admin", $data);
layout("breadcrumb", "admin", $data);

$userId = isLogin()['user_id'];

if (isPost()) {
    $body = getBody();

    $arrErr = [];

    $name = trim($body["name"]);
    $slug = trim($body["slug"]);
    $icon = trim($body["icon"]);
    $description = trim($body["description"]);
    $content = trim($body["content"]);

    if (empty($name)) {
        $arrErr["name"]["required"] = "Tên dịch vụ không được để trống!";
    } else {
        if (strlen($name) < 5) {
            $arrErr["name"]["min"] = "Tên dịch vụ phải có ít nhất 5 kí tự!";
        }
    }

    if (empty($slug)) {
        $arrErr["slug"]["required"] = "Đường dẫn tĩnh không được bỏ trống!";
    }

    if (empty($icon)) {
        $arrErr["icon"]["required"] = "Hình ảnh hoặc icon không được bỏ trống!";
    }

    if (empty($description)) {
        $arrErr["description"]["required"] = "Mô tả dịch vụ không được bỏ trống!";
    }

    if (empty($content)) {
        $arrErr["content"]["required"] = "Nội dung dịch vụ không được bỏ trống!";
    }

    

    if (empty($arrErr)) {
        setFlashData("msg", "Dữ liệu hợp lệ!");
        setFlashData("msg_type", "success");
        $dataInsert = [
            "name" => $name,
            "slug" => $slug,
            "icon" => $_POST['icon'],
            "description" => $description,
            "content" => $content,
            "user_id" =>$userId,
            "create_at" => date("Y-m-d H:i:s"),
            "update_at" => date("Y-m-d H:i:s"),
        ];
        $result = insert("services", $dataInsert);
        if ($result) {
            setFlashData("msg", "Thêm dịch vụ thành công!");
            setFlashData("msg_type", "success");
        } else {
            setFlashData(
                "msg",
                "Thêm dịch vụ không thành công! Vui lòng thử lại sau!"
            );
            setFlashData("msg_type", "success");
        }
        redirect("?module=services");
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
    <form method="POST">
        <div class="form-group">
            <label for="">Tên dịch vụ</label>
            <input type="text" name="name" placeholder="Tên dịch vụ..." class="form-control name-service"
                value="<?php getValueInput($data, 'name') ?>">
            <?php getMsgErr($errs, 'name') ?>
        </div>
        <div class="form-group">
            <label for="">Đường dẫn tĩnh</label>
            <input type="text" name="slug" placeholder="Đường dẫn tĩnh..." class="form-control slug"
                value="<?php getValueInput($data, 'slug') ?>">
            <?php getMsgErr($errs, 'slug') ?>
            <p class="render-link"><b>Link: </b><span></span></p>
        </div>
        <div class="form-group">
            <label for="">Icon</label>
            <div class="row ckfinder-group">
                <div class="col-10">
                    <input type="text" name="icon" placeholder="Hình ảnh hoặc icon..." class="form-control image-render"
                        value="<?php getValueInput($data, 'icon') ?>">
                    <?php getMsgErr($errs, 'icon') ?>
                </div>
                <div class="col-2">
                    <button type="button" class="btn btn-success btn-block choose-image">Chọn ảnh</button>
                </div>
            </div>
        </div>
        <div class="form-group">
            <label for="">Mô tả ngắn</label>
            <textarea class="form-control" placeholder="Mô tả..."
                name="description"><?php getValueInput($data, 'description') ?></textarea>
            <?php getMsgErr($errs, 'description') ?>
        </div>
        <div class="form-group">
            <label for="">Nội dung</label>
            <textarea class="editor" class="form-control" placeholder="Nội dung..."
                name="content"><?php getValueInput($data, 'content') ?></textarea>
            <?php getMsgErr($errs, 'content') ?>
        </div>

        <button type="submit" class="btn btn-primary">Thêm dịch vụ</button>
        <p><a href="?module=services">Quay lại</a></p>

    </form>
</div>

<?php layout("footer", "admin", $data);

?>