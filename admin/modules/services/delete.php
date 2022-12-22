<?php
if (!defined("_INCODE")) die("Access deneil!");
$data = [
    'pageTitle'=>'Xóa dịch vụ'
];
layout('header','admin',$data);
layout('sidebar','admin',$data);
layout('breadcrumb','admin',$data);

if (isGet()) {
    $body = getBody();

    if(!empty($body['id'])){
        
        $id = $body['id'];
        $n = getRows("select id from services where id = $id");

        if($n!=0){
            $result = delete('services', "id = $id ");
            if ($result) {
                setFlashData('msg',"Xóa dịch vụ thành công!");
                setFlashData('msg_type','success');
            } else {
                setFlashData('msg',"Xóa dịch vụ không thành công!");
                setFlashData('msg_type','danger');
            }  
        }else {
            setFlashData('msg',"Không tồn tại dịch vụ!");
            setFlashData('msg_type','danger');
        }
    }
    else{
        setFlashData('msg',"Đường liên kết không tồn tại!");
        setFlashData('msg_type','danger');
    }
    
  
}

redirect('?module=services');
?>


<?php
layout('footer','admin',$data);

?>