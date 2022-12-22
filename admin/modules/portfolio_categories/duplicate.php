<?php
if (!defined("_INCODE")) die("Access deneil!");
$data = [
    'pagename'=>'Nhân bản dự án'
];
layout('header','admin',$data);
layout('sidebar','admin',$data);
layout('breadcrumb','admin',$data);

if (isGet()) {
    $body = getBody();

    if(!empty($body['id'])){
        
        $id = $body['id'];
        $n = getRows("select id from portfolio_categories where id = $id");

        if($n!=0){
            $cateDetail = firstRaw("select * from portfolio_categories where id = $id");
            $id = $cateDetail["id"];
            update('portfolio_categories',["duplicate"=>$cateDetail['duplicate'] + 1],"id = $id");
            
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

            insert('portfolio_categories',$cateDetail);
        }else {
            setFlashData('msg',"Không tồn tại dự án!");
            setFlashData('msg_type','danger');
        }
    }
    else{
        setFlashData('msg',"Đường liên kết không tồn tại!");
        setFlashData('msg_type','danger');
    }
    
  
}
redirect('?module=portfolio_categories');

?>


<?php
layout('footer','admin',$data);

?>