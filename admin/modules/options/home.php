<?php
if (!defined("_INCODE")) {
    die("Access deneil!");
}
$data = [
    "pageTitle" => "Thiết lập slide",
];
layout("header", "admin", $data);
layout("sidebar", "admin", $data);
layout("breadcrumb", "admin", $data);

if (isGet()) {
    $data = getValueOptions("general_slide");
    // echo $data;
    if (empty($data)) {
        $data = [];
    } else {
        $data = json_decode($data,true);
    }
    setFlashData("data", $data);
    // echo "<pre>";
    // print_r($data);
    // echo "</pre>";
}

if (isPost()) {
    $body = getBody();

    $data = [];
    if (!empty($body)) {
        $n = count($body["name"]);

        for ($i = 0; $i < $n; $i++) {
            foreach ($body as $key => $value) {
                $data[$i][$key] = trim($value[$i]);
            }
        }
    }

    // echo "<pre>";
    // print_r($data);
    // echo "</pre>";

    setFlashData("data", $data);

    $data = json_encode($data);
    // echo $data;

    $dataUpdate = ['opt_value'=>$data];

    $result = update("options", $dataUpdate ,'opt_key = "general_slide"');
    if ($result) {
        setFlashData("msg", "Thiết lập slide thành công!");
        setFlashData("msg_type", "success");
    } else {
        setFlashData("msg", "Thiết lập slide không thành công!");
        setFlashData("msg_type", "danger");
    }
}

$msg = getFlashData("msg");
$msg_type = getFlashData("msg_type");
$errs = getFlashData("errs");
$data = getFlashData("data");
?>
<div style="max-width: 1200px;margin:0 auto; ">
    <?php getMsg($msg, $msg_type); ?>
    <form action="" method="POST">
        <div class="group-slide">
            <?php foreach ($data as $key => $value) { ?>
            <div class="slide">
                <div class="row">
                    <div class="col-6">
                        <div class="form-group">
                            <label for="">Tên slide</label>
                            <input type="text" name="name[]" placeholder="Tên slide..." class="form-control" value="<?php getValueInput(
                        $value,
                        "name"
                    ); ?>">
                            <?php getMsgErr($errs, "name"); ?>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <label for="">Link video</label>
                            <input type="text" name="link_video[]" placeholder="Link video..." class="form-control"
                                value="<?php getValueInput(
                                $value,
                                "link_video"
                            ); ?>">
                            <?php getMsgErr($errs, "link_video"); ?>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="">Nội dung</label>
                    <textarea class="editor" class="form-control" placeholder="Nội dung..." name="content[]"><?php getValueInput(
                            $value,
                            "content"
                        ); ?></textarea>
                    <?php getMsgErr($errs, "content"); ?>
                </div>
                <div class="row">
                    <div class="col-6">
                        <div class="form-group">
                            <label for="">Tên nút nhấn</label>
                            <input type="text" name="btn_name[]" placeholder="Tên nút nhấn..." class="form-control"
                                value="<?php getValueInput(
                                    $value,
                                    "btn_name"
                                ); ?>">
                            <?php getMsgErr($errs, "btn_name"); ?>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <label for="">Link nút bấm</label>
                            <input type="text" name="link_btn[]" placeholder="Link nút bấm..." class="form-control"
                                value="<?php getValueInput(
                                    $value,
                                    "link_btn"
                                ); ?>">
                            <?php getMsgErr($errs, "link_btn"); ?>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-6">
                        <div class="form-group">
                            <label for="">Hình ảnh 1</label>
                            <div class="row ckfinder-group">
                                <div class="col-10">
                                    <input type="text" name="image_1[]" placeholder="Hình ảnh 1..."
                                        class="form-control image-render" value="<?php getValueInput(
                                            $value,
                                            "image_1"
                                        ); ?>">
                                    <?php getMsgErr($errs, "image_1[]"); ?>
                                </div>
                                <div class="col-2">
                                    <button type="button" class="btn btn-success btn-block choose-image"><i
                                            class="fas fa-upload"></i></button>
                                </div>
                            </div>
                            <?php getMsgErr($errs, "image_1"); ?>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <label for="">Hình ảnh 2</label>
                            <div class="row ckfinder-group">
                                <div class="col-10">
                                    <input type="text" name="image_2[]" placeholder="Hình ảnh 2..."
                                        class="form-control image-render" value="<?php getValueInput(
                                            $value,
                                            "image_2"
                                        ); ?>">
                                    <?php getMsgErr($errs, "image_2"); ?>
                                </div>
                                <div class="col-2">
                                    <button type="button" class="btn btn-success btn-block choose-image"><i
                                            class="fas fa-upload"></i></button>
                                </div>
                            </div>
                            <?php getMsgErr($errs, "image_2"); ?>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-6">
                        <div class="form-group">
                            <label for="">Hình nền</label>
                            <div class="row ckfinder-group">
                                <div class="col-10">
                                    <input type="text" name="backgroud_image[]" placeholder="Hình nền..."
                                        class="form-control image-render" value="<?php getValueInput(
                                            $value,
                                            "backgroud_image"
                                        ); ?>">
                                    <?php getMsgErr($errs, "backgroud_image"); ?>
                                </div>
                                <div class="col-2">
                                    <button type="button" class="btn btn-success btn-block choose-image"><i
                                            class="fas fa-upload"></i></button>
                                </div>
                            </div>
                            <?php getMsgErr($errs, "backgroud_image"); ?>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <label for="">Vị trí hình ảnh</label>
                            <select class="form-control" name="positon_image[]" id="">
                                <option <?php echo $value['positon_image'] == 'left' ? "selected" : False ?>
                                    value="left">Bên trái</option>
                                <option <?php echo $value['positon_image'] == 'right' ? "selected" : False ?>
                                    value="right">Bên phải</option>
                                <option <?php echo $value['positon_image'] == 'center' ? "selected" : False ?>
                                    value="center">Ở giữa</option>
                            </select>
                        </div>
                    </div>
                </div>
                <button type="submit" class="btn btn-danger delete-slide">Xóa</button>
                <hr>
            </div>
            <?php } ?>
        </div>

        <button type="submit" class="btn btn-warning btn-add-slide ">Thêm slide</button>
        <button type="submit" class="btn btn-primary">Thiết lập slide</button>
        <p><a href="?module=pages">Quay lại</a></p>

    </form>
</div>

<?php layout("footer", "admin", $data);

?>