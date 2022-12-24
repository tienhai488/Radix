<?php
if (!defined("_INCODE")) {
    die("Access deneil!");
}
$data = [
    "pageTitle" => "Xóa bình luận",
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
            $arrId = getRaw("select id from comments where parent_id = $id");
            deleteComment($arrId);
            $result = delete("comments","id = $id");
            if ($result) {
                setFlashData("msg", "Xóa bình luận thành công!");
                setFlashData("msg_type", "success");
            } else {
                setFlashData(
                    "msg",
                    "Xóa bình luận không thành công! Vui lòng thử lại sau!"
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