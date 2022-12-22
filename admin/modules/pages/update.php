<?php
if (!defined("_INCODE")) {
    die("Access deneil!");
}
$data = [
    "pageTitle" => "Cập nhập trang",
];
layout("header", "admin", $data);
layout("sidebar", "admin", $data);
layout("breadcrumb", "admin", $data);

$userId = isLogin()['user_id'];

if(isGet()){
    $body = getBody();
    if(!empty($body['id'])){
        $id = $body['id'];
        $n = getRows("select id from pages where id = $id");
        if($n==0){
            setFlashData("msg", "Không tìm thấy trang!");
            setFlashData("msg_type", "danger");
            redirect("?module=pages");
        }else{
            $service = firstRaw("select * from pages where id = $id");
            setFlashData('data',$service);
        }
        
    }else{
        setFlashData("msg", "Trang không tồn tại!");
        setFlashData("msg_type", "danger");
        redirect("?module=pages");
    }
}

if (isPost()) {
    $body = getBody();

    $arrErr = [];

    $id = $body['id'];
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
        $dataUpdate = [
            "title" => $title,
            "slug" => $slug,
            "content" => $content,
            "update_at" => date("Y-m-d H:i:s"),
        ];
        $result = update("pages", $dataUpdate,"id = $id");
        if ($result) {
            setFlashData("msg", "Cập nhập trang thành công!");
            setFlashData("msg_type", "success");
        } else {
            setFlashData(
                "msg",
                "Cập nhập trang không thành công! Vui lòng thử lại sau!"
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
        <input type="hidden" name="id" value="<?php echo $data['id'] ?>">
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
            
        <button type="submit" class="btn btn-primary">Cập nhập trang</button>
        <p><a href="?module=pages">Quay lại</a></p>

    </form>
</div>

<?php layout("footer", "admin", $data);

?>
