<?php
if (!defined("_INCODE")) {
    die("Access deneil!");
}
$data = [
    "pageTitle" => "Thêm liên hệ",
];
layout("header", "admin", $data);
layout("sidebar", "admin", $data);
layout("breadcrumb", "admin", $data);

$userId = isLogin()['user_id'];

if (isPost()) {
    $body = getBody();

    $arrErr = [];

    $fullname = trim($body["fullname"]);
    $email = trim($body["email"]);
    $message = trim($body["message"]);
    $note = trim($body["note"]);
    $status = $body["status"];
    $type_id = $body["type_id"];

    if($status==0){
        $arrErr["status"]["required"] = "Vui lòng chọn trạng thái!";
    }

    if($type_id==0){
        $arrErr["type_id"]["required"] = "Vui lòng chọn phòng ban!";
    }

    if (empty($fullname)) {
        $arrErr["fullname"]["required"] = "Tên liên hệ không được để trống!";
    } else {
        if (strlen($fullname) < 5) {
            $arrErr["fullname"]["min"] = "Tên liên hệ phải có ít nhất 5 kí tự!";
        }
    }

    if (empty($email)) {
        $arrErr["email"]["required"] = "Email không được bỏ trống!";
    }

    if (empty($message)) {
        $arrErr["message"]["required"] = "Message không được bỏ trống!";
    }

    if (empty($note)) {
        $arrErr["note"]["required"] = "Note không được bỏ trống!";
    }



    

    if (empty($arrErr)) {
        $dataInsert = [
            "fullname" => $fullname,
            "email" => $email,
            "message" => $message,
            "note" => $note,
            "status" => $status - 1,
            "type_id" => $type_id,
            "create_at" => date("Y-m-d H:i:s"),
            "update_at" => date("Y-m-d H:i:s"),
        ];
        $result = insert("contacts", $dataInsert);
        if ($result) {
            setFlashData("msg", "Thêm liên hệ thành công!");
            setFlashData("msg_type", "success");
        } else {
            setFlashData(
                "msg",
                "Thêm liên hệ không thành công! Vui lòng thử lại sau!"
            );
            setFlashData("msg_type", "success");
        }
        redirect("?module=contacts");
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
            <label for="">Tên liên hệ</label>
            <input type="text" name="fullname" placeholder="Tên liên hệ..." class="form-control name-service" value="<?php getValueInput($data, 'fullname') ?>">
            <?php getMsgErr($errs, 'fullname') ?>
        </div>
        <div class="form-group">
            <label for="">Email</label>
            <input type="text" name="email" placeholder="Email..." class="form-control name-service" value="<?php getValueInput($data, 'email') ?>">
            <?php getMsgErr($errs, 'email') ?>
        </div>
       
        <div class="form-group">
            <label for="">Phòng ban</label>
            <select name="type_id" class="form-control">
                <option value="0">Chọn phòng ban</option>
                <?php 
                $cates = getRaw("select id,name from `contact_type`");
                $category_id = 0;
                if(!empty($data['type_id'])){
                    $category_id = $data['type_id'];
                }
                foreach ($cates as $item) {
                    ?>
                    <option <?php echo !empty($category_id) && $category_id == $item['id'] ? "selected" : False ?> value="<?php echo $item['id'] ?>" ><?php echo $item['name'] ?></option>
                    <?php
                }
                ?>
            </select>
            <?php getMsgErr($errs, 'type_id') ?>
        </div>

        <div class="form-group">
            <label for="">Message</label>
            <textarea class="editor" class="form-control" placeholder="Message..." name="message" ><?php getValueInput($data, 'message') ?></textarea>
            <?php getMsgErr($errs, 'message') ?>
        </div>

        <div class="form-group">
            <label for="">Trạng thái</label>
            <select name="status" class="form-control">
                <option value="0">Chọn trạng thái</option>
                <option value="1" <?php echo !empty($data['status']) && $data['status'] == 1 ? "selected" : False ?>>Chưa xử lý</option>
                <option value="2" <?php echo !empty($data['status']) && $data['status'] == 2 ? "selected" : False ?>>Đang xử lý</option>
                <option value="3" <?php echo !empty($data['status']) && $data['status'] == 3 ? "selected" : False ?>>Đã xử lý</option>
            </select>
            <?php getMsgErr($errs, 'status') ?>
        </div>

        <div class="form-group">
            <label for="">Note</label>
            <textarea class="editor" class="form-control" placeholder="Note..." name="note" ><?php getValueInput($data, 'note') ?></textarea>
            <?php getMsgErr($errs, 'note') ?>
        </div>
            
        <button type="submit" class="btn btn-primary">Thêm liên hệ</button>
        <p><a href="?module=contacts">Quay lại</a></p>

    </form>
</div>

<?php layout("footer", "admin", $data);

?>
