<?php
if (!defined("_INCODE")) {
    die("Access deneil!");
}
$data = [
    "pageTitle" => "Cập nhập bình luận ",
];
layout("header", "admin", $data);
layout("sidebar", "admin", $data);
layout("breadcrumb", "admin", $data);


if(isGet()){
    $body = getBody();
    if(!empty($body['id'])){
        $id = $body['id'];
        $n = getRows("select id from comments where id = $id");
        if($n==0){
            setFlashData("msg", "Không tìm thấy bình luận!");
            setFlashData("msg_type", "danger");
            redirect("?module=comments");
        }else{
            $item = firstRaw("select * from comments where id = $id");
            $item['status']+=1;
            setFlashData('data',$item);
        }
        
    }else{
        setFlashData("msg", "Không tồn tại đường liên kết!");
        setFlashData("msg_type", "danger");
        redirect("?module=comments");
    }
}

if (isPost()) {
    $body = getBody();

    $arrErr = [];

    $id = $body['id'];
    $content = $body['content'];
    $status = $body['status'];

    
    

    if (empty($content)) {
        $arrErr["content"]["required"] = "Nội dung bình luận không được để trống!";
    } else {
        if (strlen($content) < 10) {
            $arrErr["content"]["min"] = "Nội dung bình luận phải có ít nhất 10 kí tự!";
        }
    }

    if (empty($status)) {
        $arrErr["status"]["required"] = "Vui lòng chọn trạng thái của bình luận!";
    } 


    if (empty($arrErr)) {
        $dataUpdate = [
            "content" => $content,
            "status" => $status - 1,
            "update_at" => date("Y-m-d H:i:s"),
        ];
        $result = update("comments", $dataUpdate,"id = $id");
        if ($result) {
            setFlashData("msg", "Cập nhập bình luận thành công!");
            setFlashData("msg_type", "success");
        } else {
            setFlashData(
                "msg",
                "Cập nhập bình luận không thành công! Vui lòng thử lại sau!"
            );
            setFlashData("msg_type", "success");
        }
        redirect("?module=comments");
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
    <?php getMsg($msg, $msg_type); 
    echo "<h3>Thông tin người bình luận</h3>";
    echo "Name : <strong>".$data['name']."</strong> <br/>";
    echo "Email <strong>: ".$data['email']." </strong><br/>";
    if($data['parent_id']!=0){
        $replay = firstRaw('select * from comments where id = '.$data['parent_id']);
        echo "Trả lời : <strong>".$replay['name']."</strong>";
    }
    ?>
    <hr>
    <form method="POST">
        <input type="hidden" name="id" value="<?php echo $data['id'] ?>">
        <div class="form-group">
            <label for="">Nội dung bình luận</label>
            <input class="form-control" type="text" name="content" placeholder="Nội dung bình luận..."
                value="<?php getValueInput($data, 'content') ?>">
            <?php getMsgErr($errs, 'content') ?>
        </div>
        <div class="form-group">
            <label for="">Trạng thái</label>
            <select name="status" class="form-control">
                <option value="0">Chọn trạng thái</option>
                <option value="1" <?php echo !empty($data['status']) && $data['status'] == 1 ? "selected" : False ?>>
                    Chưa
                    duyệt</option>
                <option value="2" <?php echo !empty($data['status']) && $data['status'] == 2 ? "selected" : False ?>>Đã
                    duyệt</option>
            </select>
            <?php getMsgErr($errs, 'status') ?>
        </div>

        <button type="submit" class="btn btn-primary">Cập nhập</button>
        <p><a href="?module=comments">Quay lại</a></p>

    </form>
</div>

<?php layout("footer", "admin", $data);

?>