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
    
        $n_user = getRows("select id from contacts where type_id = '$id'");
        if($n_user==0){
            $n = getRows("select id from `contact_type` where id = '$id'");
    
            if($n>0){
                $result = delete('contact_type', "id = $id ");
                if ($result) {
                    setFlashData('msg',"Xóa liên hệ thành công!");
                    setFlashData('msg_type','success');
                } else {
                    setFlashData('msg',"Xóa liên hệ không thành công!");
                    setFlashData('msg_type','danger');
                }   
            }else{
                setFlashData('msg',"Liên hệ không tồn tại!");
                setFlashData('msg_type','danger');
            }
        }else {
            setFlashData('msg',"Xóa liên hệ không thành công! ");
            setFlashData('msg_type','danger');
        }
    }
    else{
        setFlashData('msg',"Đường liên kết không tồn tại!");
        setFlashData('msg_type','danger');
    }
    
    redirect('?module=contact_type');
  
}

?>


<?php
layout('footer','admin',$data);

?>