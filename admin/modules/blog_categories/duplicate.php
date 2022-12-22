<?php
if (!defined("_INCODE")) die("Access deneil!");
$data = [
    'pageTitle'=>'Nhân bản blog'
];
layout('header','admin',$data);
layout('sidebar','admin',$data);
layout('breadcrumb','admin',$data);

if (isGet()) {
    $body = getBody();

    if(!empty($body['id'])){
        
        $id = $body['id'];
        $n = getRows("select id from blog_categories where id = $id");

        if($n!=0){
            $cateDetail = firstRaw("select * from blog_categories where id = $id");
            $id = $cateDetail["id"];
            update('blog_categories',["duplicate"=>$cateDetail['duplicate'] + 1],"id = $id");
            
            $dup = $cateDetail['duplicate'];
            if($dup>1){
                $index =  strrpos($cateDetail['name'],"(");
                $index2 =  strrpos($cateDetail['name'],")");
                $dup = $cateDetail['duplicate']+1;
                if(!$index){
                    $cateDetail['name'] = $cateDetail['name']." ($dup)";
                }else {
                    $cateDetail['name'] = substr_replace($cateDetail['name'],"($dup)",$index,$index2+1-$index);
                }
            }else {
                $dup += 1;
                $cateDetail['name'] .= " ($dup)";
            }

            $cateDetail['duplicate']+=1;
            unset($cateDetail['id']);
            $cateDetail['update_at'] = date("Y-m-d H:i:s");
            $cateDetail['create_at'] = date("Y-m-d H:i:s");

            insert('blog_categories',$cateDetail);
        }else {
            setFlashData('msg',"Không tồn tại blog!");
            setFlashData('msg_type','danger');
        }
    }
    else{
        setFlashData('msg',"Đường liên kết không tồn tại!");
        setFlashData('msg_type','danger');
    }
    
  
}
redirect('?module=blog_categories');

?>


<?php
layout('footer','admin',$data);

?>