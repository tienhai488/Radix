<?php
if (!defined("_INCODE")) {
    die("Access deneil!");
}
$data = [
    "pageTitle" => "Thiết lập thành viên",
];
layout("header", "admin", $data);
layout("sidebar", "admin", $data);
layout("breadcrumb", "admin", $data);

if (isGet()) {
    $data = getValueOptions("general_team");
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

    $result = update("options", $dataUpdate ,'opt_key = "general_team"');
    if ($result) {
        setFlashData("msg", "Thiết lập footer thành công!");
        setFlashData("msg_type", "success");
    } else {
        setFlashData("msg", "Thiết lập footer không thành công!");
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


        <h6>Danh sách đường dẫn</h6>

        <div class="group-ourteam">




            <?php
            if(!empty($data['name'])){
                foreach ($data['name'] as $key => $value) {
                ?>

            <div class="ourteam">
                <br>
                <div class="row">
                    <div class="col-6">
                        <div class="form-group">
                            <label for="">Tên thành viên</label>
                            <input type="text" name="name[]" placeholder="Tên thành viên ..." class="form-control"
                                value="<?php echo $value ?>">
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <label for="">Chức vụ</label>
                            <input type="text" name="position[]" placeholder="Chức vụ ..." class="form-control"
                                value="<?php echo $data['position'][$key] ?>">
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-6">
                        <div class="form-group">
                            <label for="">Hình ảnh</label>
                            <div class="row ckfinder-group">
                                <div class="col-10">
                                    <input type="text" name="image[]" placeholder="Hỉnh ảnh..."
                                        class="form-control image-render" value="<?php echo $data['image'][$key] ?>">
                                </div>
                                <div class="col-2">
                                    <button type="button" class="btn btn-success btn-block choose-image"><i
                                            class="fas fa-upload"></i></button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <label for="">Đường dẫn</label>
                            <input type="text" name="link[]" placeholder="Đường dẫn ..." class="form-control"
                                value="<?php echo $data['link'][$key] ?>">
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-6">
                        <div class="form-group">
                            <label for="">Facebook</label>
                            <input type="text" name="facebook[]" placeholder="Facebook..." class="form-control"
                                value="<?php echo $data['facebook'][$key] ?>">
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <label for="">Twitter</label>
                            <input type="text" name="twitter[]" placeholder="Twitter ..." class="form-control"
                                value="<?php echo $data['twitter'][$key] ?>">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-6">
                        <div class="form-group">
                            <label for="">Youtube</label>
                            <input type="text" name="youtube[]" placeholder="Youtube ..." class="form-control"
                                value="<?php echo $data['youtube'][$key] ?>">
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <label for="">Github</label>
                            <input type="text" name="github[]" placeholder="Github ..." class="form-control"
                                value="<?php echo $data['github'][$key] ?>">
                        </div>
                    </div>
                </div>
                <hr>
            </div>

            <?php
            }
            }
            
            ?>
        </div>

        <button class="btn btn-warning btn-sm btn-add-ourteam">Thêm thành viên</button>


        <hr>

        <button type="submit" class="btn btn-primary">Thiết lập thành viên</button>
        <p><a href="<?php echo _WEB_HOST_ROOT ?>">Quay lại</a></p>

    </form>
</div>

<?php layout("footer", "admin", $data);

?>