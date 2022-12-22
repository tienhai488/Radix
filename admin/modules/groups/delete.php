<?php
if (!defined("_INCODE")) die("Access deneil!");
$data = [
    'pageTitle'=>'Xóa nhóm'
];
layout('header','admin',$data);
layout('sidebar','admin',$data);
layout('breadcrumb','admin',$data);

if (isGet()) {
    $body = getBody();

    if(!empty($body['id'])){
        $id = $body['id'];
        echo $id;
    
        $n_user = getRows("select id from users where group_id = '$id'");
        if($n_user==0){
            $n = getRows("select id from `groups` where id = '$id'");
    
            if($n>0){
                $result = delete('groups', "id = $id ");
                if ($result) {
                    setFlashData('msg',"Xóa nhóm thành công!");
                    setFlashData('msg_type','success');
                } else {
                    setFlashData('msg',"Xóa nhóm không thành công!");
                    setFlashData('msg_type','danger');
                }   
            }else{
                setFlashData('msg',"Nhóm không tồn tại!");
                setFlashData('msg_type','danger');
            }
        }else {
            setFlashData('msg',"Xóa nhóm không thành công! Kiểm tra nhóm còn người dùng hay không!");
            setFlashData('msg_type','danger');
        }
    }
    else{
        setFlashData('msg',"Đường liên kết không tồn tại!");
        setFlashData('msg_type','danger');
    }
    
  
}

redirect('?module=groups');
?>


<?php
layout('footer','admin',$data);

?>