<?php
if (!defined("_INCODE")) die("Access deneil!");
$data = [
    'pageTitle'=>'Nhân bản dịch vụ'
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
            $serviceDetail = firstRaw("select * from services where id = $id");
            $id = $serviceDetail["id"];
            update('services',["duplicate"=>$serviceDetail['duplicate'] + 1],"id = $id");
            
            $dup = $serviceDetail['duplicate'];
            if($dup>1){
                $index =  strrpos($serviceDetail['name'],"(");
                $index2 =  strrpos($serviceDetail['name'],")");
                $dup = $serviceDetail['duplicate']+1;
                if(!$index){
                    $serviceDetail['name'] = $serviceDetail['name']." ($dup)";
                }else {
                    $serviceDetail['name'] = substr_replace($serviceDetail['name'],"($dup)",$index,$index2+1-$index);
                }
            }else {
                $dup += 1;
                $serviceDetail['name'] .= " ($dup)";
            }

            $serviceDetail['duplicate']+=1;
            unset($serviceDetail['id']);
            $serviceDetail['update_at'] = date("Y-m-d H:i:s");
            $serviceDetail['create_at'] = date("Y-m-d H:i:s");

            insert('services',$serviceDetail);
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