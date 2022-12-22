<?php
if (!defined("_INCODE")) {
    die("Access deneil!");
}
$data = [
    "pageTitle" => "Thiết lập Footer",
];
layout("header", "admin", $data);
layout("sidebar", "admin", $data);
layout("breadcrumb", "admin", $data);

if (isGet()) {
    $data = getValueOptions("general_footer");
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

    $result = update("options", $dataUpdate ,'opt_key = "general_footer"');
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
        <hr>
        <h5>Footer 1</h5>
        <div class="form-group">
            <label for="">Tiêu đề </label>
            <input type="text" name="title_1" placeholder="Tiêu đề ..." class="form-control" value="<?php getValueInput(
                        $data,
                        "title_1"
                    ); ?>">
            <?php getMsgErr($errs, "title_1"); ?>
        </div>
        <div class="form-group">
            <label for="">Mô tả</label>
            <input type="text" name="des_1" placeholder="Mô tả..." class="form-control" value="<?php getValueInput(
                        $data,
                        "des_1"
                    ); ?>">
            <?php getMsgErr($errs, "des_1"); ?>
        </div>
        <hr>
        <h5>Footer 2</h5>
        <div class="form-group">
            <label for="">Tiêu đề </label>
            <input type="text" name="title_2" placeholder="Tiêu đề ..." class="form-control" value="<?php getValueInput(
                        $data,
                        "title_2"
                    ); ?>">
            <?php getMsgErr($errs, "title_2"); ?>
        </div>

        <h6>Danh sách đường dẫn</h6>

        <div class="group-quicklink">
            <?php
            if(!empty($data['name_quicklink'])){
                foreach ($data['name_quicklink'] as $key => $value) {
                ?>


            <div class="row quicklink">

                <div class="col-6">
                    <div class="form-group">
                        <input type="text" name="name_quicklink[]" placeholder="Tên đường dẫn ..." class="form-control"
                            value="<?php echo $value
                     ?>">
                    </div>
                </div>
                <div class="col-5">
                    <div class="form-group">
                        <input type="text" name="link_quicklink[]" placeholder="Đường dẫn ..." class="form-control"
                            value="<?php echo $data['link_quicklink'][$key] ?>">
                    </div>
                </div>
                <div class="col-1">
                    <button class="btn btn-danger delete-quicklink"><i class="fas fa-trash"></i></button>
                </div>
            </div>
            <?php
            }
            }
            
            ?>
        </div>

        <button class="btn btn-warning btn-sm btn-add-quicklink">Thêm đường dẫn</button>

        <hr>
        <h5>Footer 3</h5>
        <div class="form-group">
            <label for="">Tiêu đề </label>
            <input type="text" name="title_3" placeholder="Tiêu đề ..." class="form-control" value="<?php getValueInput(
                        $data,
                        "title_3"
                    ); ?>">
            <?php getMsgErr($errs, "title_3"); ?>
        </div>
        <h6>Danh sách tài khoản Twitter</h6>

        <div class="group-account_twitter">
            <?php
            if(!empty($data['name_account_twitter'])){
                foreach ($data['name_account_twitter'] as $key => $value) {
                ?>

            <div class="account_twitter">
                <br>
                <div class="row">
                    <div class="col-6">
                        <div class="form-group">
                            <label for="">Tên tài khoản</label>
                            <input type="text" name="name_account_twitter[]" placeholder="Tên tài khoản ..."
                                class="form-control" value="<?php echo $value
                     ?>">
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <label for="">Đường dẫn</label>
                            <input type="text" name="link_account_twitter[]" placeholder="Đường dẫn ..."
                                class="form-control" value="<?php echo $data['link_account_twitter'][$key] ?>">
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="">Mô tả tài khoản</label>
                    <input type="text" name="des_account_twitter[]" placeholder="Mô tả tài khoản..."
                        class="form-control" value="<?php echo $data['des_account_twitter'][$key] ?>">
                </div>


                <button class="btn btn-danger delete-account_twitter"><i class="fas fa-trash"></i></button>

            </div>
            <?php
            }
        }
        
        ?>
        </div>

        <br>
        <button class="btn btn-warning btn-sm btn-add-account_twitter">Thêm tài khoản</button>

        <hr>
        <h5>Footer 4</h5>
        <div class="form-group">
            <label for="">Tiêu đề </label>
            <input type="text" name="title_4" placeholder="Tiêu đề ..." class="form-control" value="<?php getValueInput(
                        $data,
                        "title_4"
                    ); ?>">
            <?php getMsgErr($errs, "title_4"); ?>
        </div>
        <div class="form-group">
            <label for="">Mô tả</label>
            <input type="text" name="des_4" placeholder="Mô tả..." class="form-control" value="<?php getValueInput(
                        $data,
                        "des_4"
                    ); ?>">
            <?php getMsgErr($errs, "des_4"); ?>
        </div>
        <hr>
        <h5>Copyright</h5>
        <div class="form-group">
            <label for="">Nội dung</label>
            <input type="text" name="copy_right" placeholder="Nội dung..." class="form-control" value="<?php getValueInput(
                        $data,
                        "copy_right"
                    ); ?>">
            <?php getMsgErr($errs, "copy_right"); ?>
        </div>
        <hr>

        <button type="submit" class="btn btn-primary">Thiết lập Footer</button>
        <p><a href="<?php echo _WEB_HOST_ROOT ?>">Quay lại</a></p>

    </form>
</div>

<?php layout("footer", "admin", $data);

?>