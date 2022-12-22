<?php
if (!defined("_INCODE")) die("Access deneil!");
$data = [
    'pageTitle'=>'Xóa danh mục dự án'
];
layout('header','admin',$data);
layout('sidebar','admin',$data);
layout('breadcrumb','admin',$data);

if (isGet()) {
    $body = getBody();

    if(!empty($body['id'])){
        $id = $body['id'];
        echo $id;
    
        $n = getRows("select id from `portfolios` where id = '$id'");

        if($n>0){
            delete('portfolio_images', "portfolio_id = $id ");
            $result = delete('portfolios', "id = $id ");
            if ($result) {
                setFlashData('msg',"Xóa danh mục dự án thành công!");
                setFlashData('msg_type','success');
            } else {
                setFlashData('msg',"Xóa danh mục dự án không thành công!");
                setFlashData('msg_type','danger');
            }   
        }else{
            setFlashData('msg',"Danh mục dự án không tồn tại!");
            setFlashData('msg_type','danger');
        }
    
    }
    else{
        setFlashData('msg',"Đường liên kết không tồn tại!");
        setFlashData('msg_type','danger');
    }
    
    redirect('?module=portfolios');
  
}

?>


<?php
layout('footer','admin',$data);

?>