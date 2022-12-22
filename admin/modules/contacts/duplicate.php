<?php
if (!defined("_INCODE")) die("Access deneil!");
$data = [
    'pageTitle'=>'Nhân bản liên hệ'
];
layout('header','admin',$data);
layout('sidebar','admin',$data);
layout('breadcrumb','admin',$data);

if (isGet()) {
    $body = getBody();

    if(!empty($body['id'])){
        
        $id = $body['id'];
        $n = getRows("select id from contacts where id = $id");

        if($n!=0){
            $cateDetail = firstRaw("select * from contacts where id = $id");
            $id = $cateDetail["id"];
            update('contacts',["duplicate"=>$cateDetail['duplicate'] + 1],"id = $id");
            
            $dup = $cateDetail['duplicate'];
            if($dup>1){
                $index =  strrpos($cateDetail['fullname'],"(");
                $index2 =  strrpos($cateDetail['fullname'],")");
                $dup = $cateDetail['duplicate']+1;
                if(!$index){
                    $cateDetail['fullname'] = $cateDetail['fullname']." ($dup)";
                }else {
                    $cateDetail['fullname'] = substr_replace($cateDetail['fullname'],"($dup)",$index,$index2+1-$index);
                }
            }else {
                $dup += 1;
                $cateDetail['fullname'] .= " ($dup)";
            }

            $cateDetail['duplicate']+=1;
            unset($cateDetail['id']);
            $cateDetail['update_at'] = date("Y-m-d H:i:s");
            $cateDetail['create_at'] = date("Y-m-d H:i:s");

            insert('contacts',$cateDetail);
        }else {
            setFlashData('msg',"Không tồn tại liên hệ!");
            setFlashData('msg_type','danger');
        }
    }
    else{
        setFlashData('msg',"Đường liên kết không tồn tại!");
        setFlashData('msg_type','danger');
    }
    
  
}
redirect('?module=contacts');

?>


<?php
layout('footer','admin',$data);

?>