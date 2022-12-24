<?php
if (!defined("_INCODE")) {
    die("Access deneil!");
}
$data = [
    "pageTitle" => "Thiết lập thông tin",
];
layout("header", "admin", $data);
layout("sidebar", "admin", $data);
layout("breadcrumb", "admin", $data);

if (isGet()) {
    $data = getValueOptions("general_about");
    echo $data;
    if (empty($data)) {
        $data = [];
    } else {
        $data = json_decode($data,true);
    }
    setFlashData("data", $data);
    echo "<pre>";
    print_r($data);
    echo "</pre>";
}

if (isPost()) {
    $body = getBody();

   

    echo "<pre>";
    print_r($body);
    echo "</pre>";

    setFlashData("data", $body);

    $data = json_encode($body);
    echo $data;

    $dataUpdate = ['opt_value'=>$data];

    $result = update("options", $dataUpdate ,'opt_key = "general_about"');
    if ($result) {
        setFlashData("msg", "Thiết lập thông tin thành công!");
        setFlashData("msg_type", "success");
    } else {
        setFlashData("msg", "Thiết lập thông tin không thành công!");
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
        <div class="row">
            <div class="col-6">
                <div class="form-group">
                    <label for="">Tiêu đề nền</label>
                    <input type="text" name="heading" placeholder="Tiêu đề nền..." class="form-control" value="<?php getValueInput(
                        $data,
                        "heading"
                    ); ?>">
                    <?php getMsgErr($errs, "heading"); ?>
                </div>
            </div>
            <div class="col-6">
                <div class="form-group">
                    <label for="">Link Video</label>
                    <input type="text" name="link_video" placeholder="Link Video..." class="form-control" value="<?php getValueInput(
                        $data,
                        "link_video"
                    ); ?>">
                    <?php getMsgErr($errs, "link_video"); ?>
                </div>
            </div>
        </div>

        <div class="form-group">
            <label for="">Tiêu đề nội dung</label>
            <input type="text" name="name" placeholder="Tiêu đề nội dung..." class="form-control" value="<?php getValueInput(
                        $data,
                        "name"
                    ); ?>">
            <?php getMsgErr($errs, "name"); ?>
        </div>

        <div class="row">
            <div class="col-6">
                <div class="form-group">
                    <label for="">Hình ảnh video</label>
                    <div class="row ckfinder-group">
                        <div class="col-10">
                            <input type="text" name="image_1" placeholder="Hình ảnh video..."
                                class="form-control image-render" value="<?php getValueInput(
                                            $data,
                                            "image_1"
                                        ); ?>">
                            <?php getMsgErr($errs, "image_1"); ?>
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
                    <label for="">Chữ nền</label>
                    <input type="text" name="text_bg" placeholder="Chữ nền..." class="form-control" value="<?php getValueInput(
                        $data,
                        "text_bg"
                    ); ?>">
                    <?php getMsgErr($errs, "text_bg"); ?>
                </div>
            </div>
        </div>
        <div class="form-group">
            <label for="">Mô tả</label>
            <textarea class="editor" class="form-control" placeholder="Mô tả..." name="description"><?php getValueInput(
                            $data,
                            "description"
                        ); ?></textarea>
            <?php getMsgErr($errs, "description"); ?>
        </div>
        <div class="form-group">
            <label for="">Nội dung</label>
            <textarea class="editor" class="form-control" placeholder="Nội dung..." name="content"><?php getValueInput(
                            $data,
                            "content"
                        ); ?></textarea>
            <?php getMsgErr($errs, "content"); ?>
        </div>
        <hr>
        <h5>Thiết lập đánh giá</h5>

        <div class="group-evaluate">
            <?php 
            if(!empty($data['range'])):
            foreach ($data['range'] as $key => $value) {
            ?>
            <div class="evaluate">
                <div class="row">
                    <div class="col-6">
                        <div class="form-group">
                            <input name="range_name[]" type="text" class="form-control" placeholder="Tên đánh giá..."
                                value="<?php echo $data['range_name'][$key] ?>">
                        </div>
                    </div>
                    <div class="col-5">
                        <div class="form-group">
                            <input class="form-control range" id="range" type="text" name="range[]"
                                value="<?php echo $value ?>">
                        </div>
                    </div>
                    <div class="col-1">
                        <button class="btn btn-danger delete-evaluate"><i class="fas fa-trash"></i></button>
                    </div>
                </div>
            </div>
            <?php
            }
            endif;
            ?>
        </div>
        <button type="submit" class="btn btn-warning btn-add-evaluate btn-sm">Thêm đánh giá</button>
        <hr>
        <h3>Trang About</h3>
        <div class="form-group">
            <label for="">Tiêu đề trang About</label>
            <div class="form-group">
                <input class="form-control" placeholder="Tiêu đề trang About..." type="text" name="title_about" value="<?php getValueInput(
                            $data,
                            "title_about"
                        ); ?>">
            </div>
        </div>
        <hr>
        <h3>Trang Our Team</h3>
        <div class="form-group">
            <label for="">Tiêu đề trang Our Team</label>
            <div class="form-group">
                <input class="form-control" placeholder="Tiêu đề trang Our Team..." type="text" name="title_team" value="<?php getValueInput(
                            $data,
                            "title_team"
                        ); ?>">
            </div>
        </div>
        <div class="row">
            <div class="col-6">
                <div class="form-group">
                    <label for="">Tiêu đề</label>
                    <div class="form-group">
                        <input class="form-control" placeholder="Tiêu đề..." type="text" name="heading_team" value="<?php getValueInput(
                            $data,
                            "heading_team"
                        ); ?>">
                    </div>
                </div>
            </div>
            <div class="col-6">
                <div class="form-group">
                    <label for="">Tiêu đề nền</label>
                    <div class="form-group">
                        <input class="form-control" placeholder="Tiêu đề nền..." type="text" name="heading_bg" value="<?php getValueInput(
                            $data,
                            "heading_bg"
                        ); ?>">
                    </div>
                </div>
            </div>
        </div>
        <div class="form-group">
            <label for="">Mô tả</label>
            <textarea class="editor" class="form-control" placeholder="Mô tả..." name="des_team"><?php getValueInput(
                            $data,
                            "des_team"
                        ); ?></textarea>
        </div>

        <hr>

        <button type="submit" class="btn btn-primary">Thiết lập thông tin</button>
        <p><a href="<?php echo _WEB_HOST_ROOT ?>">Quay lại</a></p>

    </form>
</div>

<?php layout("footer", "admin", $data);

?>