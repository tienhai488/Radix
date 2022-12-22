<?php
if (!defined("_INCODE")) die("Access deneil!");
$data = [
    'pageTitle'=>'Xóa liên hệ'
];
layout('header','admin',$data);
layout('sidebar','admin',$data);
layout('breadcrumb','admin',$data);

if (isGet()) {
    $body = getBody();

    if(!empty($body['id'])){
        $id = $body['id'];
        echo $id;
    
        $n = getRows("select id from `contacts` where id = '$id'");

        if($n>0){
            $result = delete('contacts', "id = $id ");
            if ($result) {
                setFlashData('msg',"Xóa liên hệ thành công!");
                setFlashData('msg_type','success');
            } else {
                setFlashData('msg',"Xóa liên hệ không thành công!");
                setFlashData('msg_type','danger');
            }   
        }else{
            setFlashData('msg',"liên hệ không tồn tại!");
            setFlashData('msg_type','danger');
        }
    
    }
    else{
        setFlashData('msg',"Đường liên kết không tồn tại!");
        setFlashData('msg_type','danger');
    }
    
    redirect('?module=contacts');
  
}

?>


<?php
layout('footer','admin',$data);

?>