<?php
if (!defined('_INCODE')) die('Access Deined...');
$dataItem = [];
if(empty(getBody()['id'])){
    loadErr();
}else{
    $id = getBody()['id'];
    $dataItem = firstRaw("select * from services where id = $id");
    if(empty($dataItem)){
        loadErr();
    }
}
$dataService = firstRaw("select opt_value from options where opt_key = 'general_service'");
$dataService = reset($dataService);
$dataService = json_decode($dataService, true);



$data = [
    "pageTitle" =>  !empty($dataItem['name']) ? $dataItem['name']: "Dịch vụ" ,
    "parentLink" => "<li><a href="._WEB_HOST_ROOT.'?module=service'."><i
    class=\"fa fa-clone\"></i>".$dataService['title_service']."</a></li>"
];
layout("header", "client", $data);
layout("breadcrumb", "client", $data);

              
?>
<section id="team" class="team section">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="section-title">
                    <span class="title-bg"><?php echo $dataService['title_service'] ?></span>
                    <h1><?php echo html_entity_decode($dataItem['name']) ?></h1>
                    <p><?php echo html_entity_decode($dataItem['content']) ?>
                    <p>
                </div>
            </div>
        </div>
    </div>
</section>
<?php
layout("footer", "client", $data);
?>