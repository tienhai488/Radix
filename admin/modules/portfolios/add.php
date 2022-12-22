<?php
if (!defined("_INCODE")) {
    die("Access deneil!");
}
$data = [
    "pageTitle" => "Thêm danh mục dự án",
];
layout("header", "admin", $data);
layout("sidebar", "admin", $data);
layout("breadcrumb", "admin", $data);

$userId = isLogin()['user_id'];

if (isPost()) {
    $body = getBody();

    $arrErr = [];

    $name = trim($body["name"]);
    $slug = trim($body["slug"]);
    $description = trim($body["description"]);
    $content = trim($body["content"]);
    $video = trim($body["video"]);
    $portfolio_category_id = trim($body["portfolio_category_id"]);
    $thumbnail = trim($body["thumbnail"]);
    $gallery = $body["gallery"];

    if(!empty($gallery)){
        foreach($gallery as $key=>$item){
            if(empty($item)){
                $arrErr['gallery'][$key]['require'] = 'Vui lòng chọn hình ảnh';
            }
        }
    }

    if (empty($name)) {
        $arrErr["name"]["required"] = "Tên danh mục dự án không được để trống!";
    } else {
        if (strlen($name) < 5) {
            $arrErr["name"]["min"] = "Tên danh mục dự án phải có ít nhất 5 kí tự!";
        }
    }

    if (empty($slug)) {
        $arrErr["slug"]["required"] = "Đường dẫn tĩnh không được bỏ trống!";
    }


    if (empty($description)) {
        $arrErr["description"]["required"] = "Mô tả danh mục dự án không được bỏ trống!";
    }

    if (empty($content)) {
        $arrErr["content"]["required"] = "Nội dung danh mục dự án không được bỏ trống!";
    }

    if (empty($video)) {
        $arrErr["video"]["required"] = "Video danh mục dự án không được bỏ trống!";
    }

    if ($portfolio_category_id==0) {
        $arrErr["portfolio_category_id"]["required"] = "Phải lựa chọn danh mục cho danh mục dự án!";
    }

    if (empty($thumbnail)) {
        $arrErr["thumbnail"]["required"] = "Hình ảnh danh mục dự án không được bỏ trống!";
    }

    if (empty($arrErr)) {
        setFlashData("msg", "Dữ liệu hợp lệ!");
        setFlashData("msg_type", "success");
        $dataInsert = [
            "name" => $name,
            "slug" => $slug,
            "description" => $description,
            "content" => $content,
            "user_id" =>$userId,
            "portfolio_category_id" =>$portfolio_category_id,
            "thumbnail" =>$thumbnail,
            "video" =>$video,
            "update_at" => date("Y-m-d H:i:s"),
        ];
        $result = insert("portfolios", $dataInsert);
        if ($result) {
            $idInsert = insertId();
            foreach($gallery as $item){
                $dataInsert = [
                    "image"=> $item,
                    "portfolio_id"=>$idInsert,
                    "create_at" => date("Y-m-d H:i:s"),
                    "update_at" => date("Y-m-d H:i:s"),
                ];
                $result = insert("portfolio_images", $dataInsert);
            }

            setFlashData("msg", "Thêm danh mục dự án thành công!");
            setFlashData("msg_type", "success");
        } else {
            setFlashData(
                "msg",
                "Thêm danh mục dự án không thành công! Vui lòng thử lại sau!"
            );
            setFlashData("msg_type", "success");
        }
        redirect("?module=portfolios");
    } else {
        setFlashData("data", $body);
        setFlashData("errs", $arrErr);
        setFlashData("msg", "Vui lòng kiểm tra lại dữ liệu!");
        setFlashData("msg_type", "danger");
    }
}

$errs = getFlashData("errs");
$msg = getFlashData("msg");
$msg_type = getFlashData("msg_type");
$data = getFlashData("data");

echo "<pre>";
print_r($data);
echo "</pre>";
?>
<div style="max-width: 1200px;margin:0 auto; ">
    <?php getMsg($msg, $msg_type); ?>
    <form  method="POST">
        <div class="form-group">
            <label for="">Tên danh mục dự án</label>
            <input type="text" name="name" placeholder="Tên danh mục dự án..." class="form-control name-service" value="<?php getValueInput($data, 'name') ?>">
            <?php getMsgErr($errs, 'name') ?>
        </div>
        <div class="form-group">
            <label for="">Đường dẫn tĩnh</label>
            <input type="text" name="slug" placeholder="Đường dẫn tĩnh..." class="form-control slug" value="<?php getValueInput($data, 'slug') ?>">
            <?php getMsgErr($errs, 'slug') ?>
            <p class="render-link"><b>Link: </b><span></span></p>
        </div>
        
        <div class="form-group">
            <label for="">Mô tả </label>
            <textarea  class="form-control" placeholder="Mô tả..." name="description"><?php getValueInput($data, 'description') ?></textarea>
            <?php getMsgErr($errs, 'description') ?>
        </div>
        <div class="form-group">
            <label for="">Nội dung</label>
            <textarea class="editor" class="form-control" placeholder="Nội dung..." name="content" ><?php getValueInput($data, 'content') ?></textarea>
            <?php getMsgErr($errs, 'content') ?>
        </div>
        <div class="form-group">
            <label for="">Link video</label>
            <input type="text" name="video" placeholder="Link video..." class="form-control" value="<?php getValueInput($data, 'video') ?>">
            <?php getMsgErr($errs, 'video') ?>
        </div>
        <div class="form-group">
            <label for="">Danh mục</label>
            <select name="portfolio_category_id" class="form-control">
                <option value="0">Chọn danh mục</option>
                <?php 
                $cates = getRaw("select id,name from `portfolio_categories`");
                foreach ($cates as $item) {
                    ?>
                    <option <?php echo !empty($portfolio_category_id) && $portfolio_category_id == $item['id'] ? "selected" : False ?> value="<?php echo $item['id'] ?>" ><?php echo $item['name'] ?></option>
                    <?php
                }
                ?>
            </select>
            <?php getMsgErr($errs, 'portfolio_category_id') ?>
        </div>
        <div class="form-group">
            <label for="">Link hình ảnh đại diện</label>
            <div class="row ckfinder-group">
                <div class="col-10">
                    <input type="text" name="thumbnail" placeholder="Hình ảnh đại diện..." class="form-control image-render" value="<?php getValueInput($data, 'thumbnail') ?>">
                    <?php getMsgErr($errs, 'thumbnail') ?>
                </div>
                <div class="col-2">
                    <button type="button" class="btn btn-success btn-block choose-image">Chọn ảnh</button>
                </div>
            </div>
        </div>
        <div class="form-group">
            <label for="">Ảnh dự án</label>
            <div class="gallery-group">
                <?php
                if(!empty($data['gallery'])){
                    $gallery = $data['gallery'];
                    foreach($gallery as $key=>$item){
                        ?>
                            <div class="gallery-item mb-2">
                                <div class="row ckfinder-group">
                                    <div class="col-9">
                                        <input type="text" name="gallery[]" placeholder="Hình ảnh..." class="form-control image-render" value="<?php echo $item ?>">
                                        <?php empty($errs) || empty($errs['gallery'])  ? false : getMsgErr($errs['gallery'], $key) ?> 
                                    </div>
                                    <div class="col-2">
                                        <button type="button" class="btn btn-success btn-block choose-image">Chọn ảnh</button>
                                    </div>
                                    <div class="col-1">
                                        <button type="button" onclick="return comfirm('Bạn chắc chắn muốn xóa?')" class="btn btn-danger btn-block delete-image"><i class="fa fa-trash"></i></button>
                                    </div>
                                </div>
                            </div>
                        <?php
                    }
                }
                ?>
            </div>
            <button type="button" class="btn btn-sm btn-danger gallery-add-img">Thêm ảnh</button>
        </div>
        
        <button type="submit" class="btn btn-primary">Thêm danh mục dự án</button>
        <p><a href="?module=portfolios">Quay lại</a></p>

    </form>
</div>

<?php layout("footer", "admin", $data);

?>
