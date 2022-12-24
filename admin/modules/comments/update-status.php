<?php
if (!defined("_INCODE")) {
    die("Access deneil!");
}
$data = [
    "pageTitle" => "Cập nhập bình luận",
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
            $data = firstRaw("select * from comments where id = $id");
            $dataUpdate = [
                "status" => $data['status'] == 0 ? 1: 0,
                "update_at" => date("Y-m-d H:i:s"),
            ];
            $result = update("comments", $dataUpdate,"id = $id");
            if ($result) {
                setFlashData("msg", "Cập nhập bình luận thành công!");
                setFlashData("msg_type", "success");
                if(!empty($_SERVER['HTTP_REFERER'])){
                    redirect($_SERVER['HTTP_REFERER']);
                }
            } else {
                setFlashData(
                    "msg",
                    "Cập nhập bình luận không thành công! Vui lòng thử lại sau!"
                );
                setFlashData("msg_type", "success");
            }
            redirect("?module=comments");
        }
        
    }else{
        setFlashData("msg", "Không tồn tại đường liên kết!");
        setFlashData("msg_type", "danger");
        redirect("?module=comments");
    }
}


layout("footer", "admin", $data);

?>