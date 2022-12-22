<?php
if (!defined("_INCODE")) die("Access deneil!");
$data = [
    'pageTitle'=>'Xóa danh mục blog'
];
layout('header','admin',$data);
layout('sidebar','admin',$data);
layout('breadcrumb','admin',$data);

if (isGet()) {
    $body = getBody();

    if(!empty($body['id'])){
        $id = $body['id'];
        echo $id;
    
        $n = getRows("select id from `blog` where id = '$id'");

        if($n>0){
            $result = delete('blog', "id = $id ");
            if ($result) {
                setFlashData('msg',"Xóa danh mục blog thành công!");
                setFlashData('msg_type','success');
            } else {
                setFlashData('msg',"Xóa danh mục blog không thành công!");
                setFlashData('msg_type','danger');
            }   
        }else{
            setFlashData('msg',"Danh mục blog không tồn tại!");
            setFlashData('msg_type','danger');
        }
    
    }
    else{
        setFlashData('msg',"Đường liên kết không tồn tại!");
        setFlashData('msg_type','danger');
    }
    
    redirect('?module=blog');
  
}

?>


<?php
layout('footer','admin',$data);

?>