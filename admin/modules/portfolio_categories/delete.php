<?php
if (!defined("_INCODE")) die("Access deneil!");
$data = [
    'pageTitle'=>'Xóa dự án'
];
layout('header','admin',$data);
layout('sidebar','admin',$data);
layout('breadcrumb','admin',$data);

if (isGet()) {
    $body = getBody();

    if(!empty($body['id'])){
        $id = $body['id'];
        echo $id;
    
        $n_user = getRows("select id from portfolios where portfolio_category_id = '$id'");
        if($n_user==0){
            $n = getRows("select id from `portfolio_categories` where id = '$id'");
    
            if($n>0){
                $result = delete('portfolio_categories', "id = $id ");
                if ($result) {
                    setFlashData('msg',"Xóa dự án thành công!");
                    setFlashData('msg_type','success');
                } else {
                    setFlashData('msg',"Xóa dự án không thành công!");
                    setFlashData('msg_type','danger');
                }   
            }else{
                setFlashData('msg',"dự án không tồn tại!");
                setFlashData('msg_type','danger');
            }
        }else {
            setFlashData('msg',"Xóa dự án không thành công! ");
            setFlashData('msg_type','danger');
        }
    }
    else{
        setFlashData('msg',"Đường liên kết không tồn tại!");
        setFlashData('msg_type','danger');
    }
    
    redirect('?module=portfolio_categories');
  
}

?>


<?php
layout('footer','admin',$data);

?>