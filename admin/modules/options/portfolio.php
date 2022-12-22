<?php
if (!defined("_INCODE")) {
    die("Access deneil!");
}
$data = [
    "pageTitle" => "Thiết lập dịch vụ",
];
layout("header", "admin", $data);
layout("sidebar", "admin", $data);
layout("breadcrumb", "admin", $data);

if (isGet()) {
    $data = getValueOptions("general_portfolio");
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

    $result = update("options", $dataUpdate ,'opt_key = "general_portfolio"');
    if ($result) {
        setFlashData("msg", "Thiết lập dự án thành công!");
        setFlashData("msg_type", "success");
    } else {
        setFlashData("msg", "Thiết lập dự án không thành công!");
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
                    <label for="">Tiêu đề </label>
                    <input type="text" name="heading" placeholder="Tiêu đề ..." class="form-control" value="<?php getValueInput(
                        $data,
                        "heading"
                    ); ?>">
                    <?php getMsgErr($errs, "heading"); ?>
                </div>
            </div>
            <div class="col-6">
                <div class="form-group">
                    <label for="">Tiêu đề nền</label>
                    <input type="text" name="title_bg" placeholder="Tiêu đề nền..." class="form-control" value="<?php getValueInput(
                        $data,
                        "title_bg"
                    ); ?>">
                    <?php getMsgErr($errs, "title_bg"); ?>
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

        <div class="row">
            <div class="col-6">
                <div class="form-group">
                    <label for="">Tên nút bấm</label>
                    <input type="text" name="btn_name" placeholder="Tên nút bấm..." class="form-control" value="<?php getValueInput(
                        $data,
                        "btn_name"
                    ); ?>">
                    <?php getMsgErr($errs, "btn_name"); ?>
                </div>
            </div>
            <div class="col-6">
                <div class="form-group">
                    <label for="">Link nút bấm</label>
                    <input type="text" name="btn_link" placeholder="Link nút bấm..." class="form-control" value="<?php getValueInput(
                        $data,
                        "btn_link"
                    ); ?>">
                    <?php getMsgErr($errs, "btn_link"); ?>
                </div>
            </div>
        </div>

        <hr>
        <h3>Trang Portfolio</h3>
        <div class="form-group">
            <label for="">Tiêu đề trang Portfolio</label>
            <div class="form-group">
                <input class="form-control" placeholder="Tiêu đề trang Portfolio..." type="text" name="title_portfolio"
                    value="<?php getValueInput(
                            $data,
                            "title_portfolio"
                        ); ?>">
            </div>
        </div>

        <hr>

        <button type="submit" class="btn btn-primary">Thiết lập thành tích</button>
        <p><a href="<?php echo _WEB_HOST_ROOT ?>">Quay lại</a></p>

    </form>
</div>

<?php layout("footer", "admin", $data);

?>