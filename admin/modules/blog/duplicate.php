<?php
if (!defined("_INCODE")) die("Access deneil!");
$data = [
    'pageTitle'=>'Nhân bản danh mục blog'
];
layout('header','admin',$data);
layout('sidebar','admin',$data);
layout('breadcrumb','admin',$data);

if (isGet()) {
    $body = getBody();

    if(!empty($body['id'])){
        
        $id = $body['id'];
        $n = getRows("select id from blog where id = $id");

        if($n!=0){
            $cateDetail = firstRaw("select * from blog where id = $id");
            $id = $cateDetail["id"];
            update('blog',["duplicate"=>$cateDetail['duplicate'] + 1],"id = $id");
            
            $dup = $cateDetail['duplicate'];
            if($dup>1){
                $index =  strrpos($cateDetail['title'],"(");
                $index2 =  strrpos($cateDetail['title'],")");
                $dup = $cateDetail['duplicate']+1;
                if(!$index){
                    $cateDetail['title'] = $cateDetail['title']." ($dup)";
                }else {
                    $cateDetail['title'] = substr_replace($cateDetail['title'],"($dup)",$index,$index2+1-$index);
                }
            }else {
                $dup += 1;
                $cateDetail['title'] .= " ($dup)";
            }

            $cateDetail['user_id'] = isLogin()['user_id'];
            $cateDetail['duplicate']+=1;
            unset($cateDetail['id']);
            $cateDetail['update_at'] = date("Y-m-d H:i:s");
            $cateDetail['create_at'] = date("Y-m-d H:i:s");

            insert('blog',$cateDetail);
        }else {
            setFlashData('msg',"Không tồn tại danh mục blog!");
            setFlashData('msg_type','danger');
        }
    }
    else{
        setFlashData('msg',"Đường liên kết không tồn tại!");
        setFlashData('msg_type','danger');
    }
    
  
}
redirect('?module=blog');

?>


<?php
layout('footer','admin',$data);

?>