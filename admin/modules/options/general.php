<?php
if (!defined("_INCODE")) {
    die("Access deneil!");
}
$data = [
    "pageTitle" => "Thiết lập trang",
];
layout("header", "admin", $data);
layout("sidebar", "admin", $data);
layout("breadcrumb", "admin", $data);

$userId = isLogin()['user_id'];


if (isPost()) {
    $body = getBody();

    

    if (empty($arrErr)) {
        foreach ($body as $key => $value) {
            $dataUpdate = [
                'opt_value'=>trim($value)
            ];
            $result = update("options", $dataUpdate,"opt_key = '$key'");
            if ($result) {
                setFlashData("msg", "Cập nhập thành công!");
                setFlashData("msg_type", "success");
            } else {
                setFlashData(
                    "msg",
                    "Cập nhập không thành công! Vui lòng thử lại sau!"
                );
                setFlashData("msg_type", "success");
            }
        }
        
        
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
            <label for=""><?php echo getValueOptions("general_hotline","name") ?></label>
            <input type="text" name="general_hotline"
                placeholder="<?php echo getValueOptions("general_hotline","name") ?>..."
                class="form-control name-service" value="<?php echo getValueOptions("general_hotline","opt_value") ?>">
            <?php getMsgErr($errs, 'general_hotline') ?>
        </div>
        <div class="form-group">
            <label for=""><?php echo getValueOptions("general_email","name") ?></label>
            <input type="text" name="general_email"
                placeholder="<?php echo getValueOptions("general_email","name") ?>..." class="form-control name-service"
                value="<?php echo getValueOptions("general_email","opt_value") ?>">
            <?php getMsgErr($errs, 'general_email') ?>
        </div>
        <div class="form-group">
            <label for=""><?php echo getValueOptions("general_address","name") ?></label>
            <input type="text" name="general_address"
                placeholder="<?php echo getValueOptions("general_address","name") ?>..."
                class="form-control name-service" value="<?php echo getValueOptions("general_address","opt_value") ?>">
            <?php getMsgErr($errs, 'general_address') ?>
        </div>
        <div class="form-group">
            <label for=""><?php echo getValueOptions("general_time","name") ?></label>
            <input type="text" name="general_time" placeholder="<?php echo getValueOptions("general_time","name") ?>..."
                class="form-control name-service" value="<?php echo getValueOptions("general_time","opt_value") ?>">
            <?php getMsgErr($errs, 'general_time') ?>
        </div>

        <div class="form-group">
            <label for=""><?php echo getValueOptions("general_twitter","name") ?></label>
            <input type="text" name="general_twitter"
                placeholder="<?php echo getValueOptions("general_twitter","name") ?>..."
                class="form-control name-service" value="<?php echo getValueOptions("general_twitter","opt_value") ?>">
            <?php getMsgErr($errs, 'general_twitter') ?>
        </div>
        <div class="form-group">
            <label for=""><?php echo getValueOptions("general_facebook","name") ?></label>
            <input type="text" name="general_facebook"
                placeholder="<?php echo getValueOptions("general_facebook","name") ?>..."
                class="form-control name-service" value="<?php echo getValueOptions("general_facebook","opt_value") ?>">
            <?php getMsgErr($errs, 'general_facebook') ?>
        </div>
        <div class="form-group">
            <label for=""><?php echo getValueOptions("general_linkedin","name") ?></label>
            <input type="text" name="general_linkedin"
                placeholder="<?php echo getValueOptions("general_linkedin","name") ?>..."
                class="form-control name-service" value="<?php echo getValueOptions("general_linkedin","opt_value") ?>">
            <?php getMsgErr($errs, 'general_linkedin') ?>
        </div>
        <div class="form-group">
            <label for=""><?php echo getValueOptions("general_github","name") ?></label>
            <input type="text" name="general_github"
                placeholder="<?php echo getValueOptions("general_github","name") ?>..."
                class="form-control name-service" value="<?php echo getValueOptions("general_github","opt_value") ?>">
            <?php getMsgErr($errs, 'general_github') ?>
        </div>
        <div class="form-group">
            <label for=""><?php echo getValueOptions("general_youtube","name") ?></label>
            <input type="text" name="general_youtube"
                placeholder="<?php echo getValueOptions("general_youtube","name") ?>..."
                class="form-control name-service" value="<?php echo getValueOptions("general_youtube","opt_value") ?>">
            <?php getMsgErr($errs, 'general_youtube') ?>
        </div>
        <div class="form-group">
            <label for=""><?php echo getValueOptions("general_age_company","name") ?></label>
            <input type="text" name="general_age_company"
                placeholder="<?php echo getValueOptions("general_age_company","name") ?>..."
                class="form-control name-service"
                value="<?php echo getValueOptions("general_age_company","opt_value") ?>">
            <?php getMsgErr($errs, 'general_age_company') ?>
        </div>
        <div class="form-group">
            <label for=""><?php echo getValueOptions("general_complete_project","name") ?></label>
            <input type="text" name="general_complete_project"
                placeholder="<?php echo getValueOptions("general_complete_project","name") ?>..."
                class="form-control name-service"
                value="<?php echo getValueOptions("general_complete_project","opt_value") ?>">
            <?php getMsgErr($errs, 'general_complete_project') ?>
        </div>
        <div class="form-group">
            <label for=""><?php echo getValueOptions("general_total_earning","name") ?></label>
            <input type="text" name="general_total_earning"
                placeholder="<?php echo getValueOptions("general_total_earning","name") ?>(Đơn vị: Triệu)..."
                class="form-control name-service"
                value="<?php echo getValueOptions("general_total_earning","opt_value") ?>">
            <?php getMsgErr($errs, 'general_total_earning') ?>
        </div>
        <div class="form-group">
            <label for=""><?php echo getValueOptions("general_award","name") ?></label>
            <input type="text" name="general_award"
                placeholder="<?php echo getValueOptions("general_award","name") ?>..." class="form-control name-service"
                value="<?php echo getValueOptions("general_award","opt_value") ?>">
            <?php getMsgErr($errs, 'general_award') ?>
        </div>

        <button type="submit" class="btn btn-primary">Cập nhập</button>
        <p><a href="?module=pages">Quay lại</a></p>

    </form>
</div>

<?php layout("footer", "admin", $data);

?>