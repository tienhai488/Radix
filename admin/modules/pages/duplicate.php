<?php
if (!defined("_INCODE")) die("Access deneil!");
$data = [
    'pageTitle'=>'Nhân bản trang'
];
layout('header','admin',$data);
layout('sidebar','admin',$data);
layout('breadcrumb','admin',$data);

if (isGet()) {
    $body = getBody();

    if(!empty($body['id'])){
        
        $id = $body['id'];
        $n = getRows("select id from pages where id = $id");

        if($n!=0){
            $pageDetail = firstRaw("select * from pages where id = $id");
            $id = $pageDetail["id"];
            update('pages',["duplicate"=>$pageDetail['duplicate'] + 1],"id = $id");
            
            $dup = $pageDetail['duplicate'];
            if($dup>1){
                $index =  strrpos($pageDetail['title'],"(");
                $index2 =  strrpos($pageDetail['title'],")");
                $dup = $pageDetail['duplicate']+1;
                if(!$index){
                    $pageDetail['title'] = $pageDetail['title']." ($dup)";
                }else {
                    $pageDetail['title'] = substr_replace($pageDetail['title'],"($dup)",$index,$index2+1-$index);
                }
            }else {
                $dup += 1;
                $pageDetail['title'] .= " ($dup)";
            }

            $pageDetail['duplicate']+=1;
            unset($pageDetail['id']);
            $pageDetail['update_at'] = date("Y-m-d H:i:s");
            $pageDetail['create_at'] = date("Y-m-d H:i:s");

            insert('pages',$pageDetail);
        }else {
            setFlashData('msg',"Không tồn tại trang!");
            setFlashData('msg_type','danger');
        }
    }
    else{
        setFlashData('msg',"Đường liên kết không tồn tại!");
        setFlashData('msg_type','danger');
    }
    
  
}
redirect('?module=pages');

?>


<?php
layout('footer','admin',$data);

?>