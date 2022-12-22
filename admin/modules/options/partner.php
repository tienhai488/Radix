<?php
if (!defined("_INCODE")) {
    die("Access deneil!");
}
$data = [
    "pageTitle" => "Thiết lập đối tác",
];
layout("header", "admin", $data);
layout("sidebar", "admin", $data);
layout("breadcrumb", "admin", $data);

if (isGet()) {
    $data = getValueOptions("general_partner");
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

    $result = update("options", $dataUpdate ,'opt_key = "general_partner"');
    if ($result) {
        setFlashData("msg", "Thiết lập thành công!");
        setFlashData("msg_type", "success");
    } else {
        setFlashData("msg", "Thiết lập không thành công!");
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



        <hr>
        <h5>Danh sách đối tác</h5>

        <div class="group-partner">
            <?php
            if(!empty($data['image'])){
                ?>

            <?php
            foreach ($data['image'] as $key => $value) {
               ?>

            <div class="row partner">

                <div class="col-6">
                    <div class="form-group">
                        <div class="row ckfinder-group">
                            <div class="col-10">
                                <input type="text" name="image[]" placeholder="Logo..."
                                    class="form-control image-render" value="<?php echo $value ?>">
                            </div>
                            <div class="col-2">
                                <button type="button" class="btn btn-success btn-block choose-image"><i
                                        class="fas fa-upload"></i></button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-5">
                    <div class="form-group">
                        <input type="text" name="link[]" placeholder="Link ..." class="form-control"
                            value="<?php echo $data['link'][$key] ?>">
                    </div>
                </div>
                <div class="col-1">
                    <button class="btn btn-danger delete-partner"><i class="fas fa-trash"></i></button>
                </div>
            </div>
            <?php
            }
            }
            
            ?>
        </div>

        <button class="btn btn-warning btn-sm btn-add-partner">Thêm đối tác</button>
        <hr>

        <button type="submit" class="btn btn-primary">Thiết lập đối tác</button>
        <p><a href="<?php echo _WEB_HOST_ROOT ?>">Quay lại</a></p>

    </form>
</div>

<?php layout("footer", "admin", $data);

?>