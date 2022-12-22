<?php
if (!defined("_INCODE")) {
    die("Access deneil!");
}
$data = [
    "pageTitle" => "Thêm trang",
];
layout("header", "admin", $data);
layout("sidebar", "admin", $data);
layout("breadcrumb", "admin", $data);

$userId = isLogin()['user_id'];

if (isPost()) {
    $body = getBody();

    $arrErr = [];

    $title = trim($body["title"]);
    $slug = trim($body["slug"]);
    $content = trim($body["content"]);

    if (empty($title)) {
        $arrErr["title"]["required"] = "Tiêu đề trang không được để trống!";
    } else {
        if (strlen($title) < 5) {
            $arrErr["title"]["min"] = "Tiêu đề trang phải có ít nhất 5 kí tự!";
        }
    }

    if (empty($slug)) {
        $arrErr["slug"]["required"] = "Đường dẫn tĩnh không được bỏ trống!";
    }

    if (empty($content)) {
        $arrErr["content"]["required"] = "Nội dung trang không được bỏ trống!";
    }

    

    if (empty($arrErr)) {
        setFlashData("msg", "Dữ liệu hợp lệ!");
        setFlashData("msg_type", "success");
        $dataInsert = [
            "title" => $title,
            "slug" => $slug,
            "content" => $content,
            "user_id" =>$userId,
            "create_at" => date("Y-m-d H:i:s"),
            "update_at" => date("Y-m-d H:i:s"),
        ];
        $result = insert("pages", $dataInsert);
        if ($result) {
            setFlashData("msg", "Thêm trang thành công!");
            setFlashData("msg_type", "success");
        } else {
            setFlashData(
                "msg",
                "Thêm trang không thành công! Vui lòng thử lại sau!"
            );
            setFlashData("msg_type", "success");
        }
        redirect("?module=pages");
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
        <div class="form-group">
            <label for="">Tiêu đề trang</label>
            <input type="text" name="title" placeholder="Tiêu đề trang..." class="form-control name-service" value="<?php getValueInput($data, 'title') ?>">
            <?php getMsgErr($errs, 'title') ?>
        </div>
        <div class="form-group">
            <label for="">Đường dẫn tĩnh</label>
            <input type="text" name="slug" placeholder="Đường dẫn tĩnh..." class="form-control slug" value="<?php getValueInput($data, 'slug') ?>">
            <?php getMsgErr($errs, 'slug') ?>
            <p class="render-link"><b>Link: </b><span></span></p>
        </div>
        <div class="form-group">
            <label for="">Nội dung</label>
            <textarea class="editor" class="form-control" placeholder="Nội dung..." name="content" ><?php getValueInput($data, 'content') ?></textarea>
            <?php getMsgErr($errs, 'content') ?>
        </div>
            
        <button type="submit" class="btn btn-primary">Thêm trang</button>
        <p><a href="?module=pages">Quay lại</a></p>

    </form>
</div>

<?php layout("footer", "admin", $data);

?>
