<?php
if (!defined("_INCODE")) die("Access deneil!");
$data = [
    'pageTitle'=>'Xóa người dùng'
];
layout('header','admin',$data);
layout('sidebar','admin',$data);
layout('breadcrumb','admin',$data);

if (isGet()) {
    $body = getBody();

    if(!empty($body['id'])){
        $id = $body['id'];
    
        $result = delete('users', "id = $id ");
        if ($result) {
            setFlashData('msg',"Xóa người dùng thành công!");
            setFlashData('msg_type','success');
        } else {
            setFlashData('msg',"Xóa người dùng không thành công!");
            setFlashData('msg_type','danger');
        }  
  
    }
    else{
        setFlashData('msg',"Đường liên kết không tồn tại!");
        setFlashData('msg_type','danger');
    }
    
  
}

redirect('?module=users');
?>


<?php
layout('footer','admin',$data);

?>