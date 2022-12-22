<?php
if (!defined("_INCODE")) {
    die("Access deneil!");
}
$data = [
    "pageTitle" => "Thêm danh mục blog",
];
layout("header", "admin", $data);
layout("sidebar", "admin", $data);
layout("breadcrumb", "admin", $data);

$userId = isLogin()['user_id'];

if (isPost()) {
    $body = getBody();

    $arrErr = [];

    $title = trim($body["title"]);
    $slug = trim($body["slug"]);
    $description = trim($body["description"]);
    $content = trim($body["content"]);
    $category_id = trim($body["category_id"]);
    $thumbnail = trim($body["thumbnail"]);

    if (empty($title)) {
        $arrErr["title"]["required"] = "Tên danh mục blog không được để trống!";
    } else {
        if (strlen($title) < 5) {
            $arrErr["title"]["min"] = "Tên danh mục blog phải có ít nhất 5 kí tự!";
        }
    }

    if (empty($slug)) {
        $arrErr["slug"]["required"] = "Đường dẫn tĩnh không được bỏ trống!";
    }


    if (empty($description)) {
        $arrErr["description"]["required"] = "Mô tả danh mục blog không được bỏ trống!";
    }

    if (empty($content)) {
        $arrErr["content"]["required"] = "Nội dung danh mục blog không được bỏ trống!";
    }


    if ($category_id==0) {
        $arrErr["category_id"]["required"] = "Phải lựa chọn danh mục cho danh mục blog!";
    }

    if (empty($thumbnail)) {
        $arrErr["thumbnail"]["required"] = "Hình ảnh danh mục blog không được bỏ trống!";
    }

    

    if (empty($arrErr)) {
        setFlashData("msg", "Dữ liệu hợp lệ!");
        setFlashData("msg_type", "success");
        $dataInsert = [
            "title" => $title,
            "slug" => $slug,
            "description" => $description,
            "content" => $content,
            "user_id" =>$userId,
            "category_id" =>$category_id,
            "thumbnail" =>$thumbnail,
            "create_at" => date("Y-m-d H:i:s"),
            "update_at" => date("Y-m-d H:i:s"),
        ];
        $result = insert("blog", $dataInsert);
        if ($result) {
            setFlashData("msg", "Thêm danh mục blog thành công!");
            setFlashData("msg_type", "success");
        } else {
            setFlashData(
                "msg",
                "Thêm danh mục blog không thành công! Vui lòng thử lại sau!"
            );
            setFlashData("msg_type", "success");
        }
        redirect("?module=blog");
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
    <form method="POST">
        <div class="form-group">
            <label for="">Tên danh mục blog</label>
            <input type="text" name="title" placeholder="Tên danh mục blog..." class="form-control name-service"
                value="<?php getValueInput($data, 'title') ?>">
            <?php getMsgErr($errs, 'title') ?>
        </div>
        <div class="form-group">
            <label for="">Đường dẫn tĩnh</label>
            <input type="text" name="slug" placeholder="Đường dẫn tĩnh..." class="form-control slug"
                value="<?php getValueInput($data, 'slug') ?>">
            <?php getMsgErr($errs, 'slug') ?>
            <p class="render-link"><b>Link: </b><span></span></p>
        </div>

        <div class="form-group">
            <label for="">Mô tả </label>
            <textarea class="form-control" placeholder="Mô tả..."
                name="description"><?php getValueInput($data, 'description') ?></textarea>
            <?php getMsgErr($errs, 'description') ?>
        </div>
        <div class="form-group">
            <label for="">Nội dung</label>
            <textarea class="editor" class="form-control" placeholder="Nội dung..."
                name="content"><?php getValueInput($data, 'content') ?></textarea>
            <?php getMsgErr($errs, 'content') ?>
        </div>

        <div class="form-group">
            <label for="">Danh mục</label>
            <select name="category_id" class="form-control">
                <option value="0">Chọn danh mục</option>
                <?php 
                $cates = getRaw("select id,name from `blog_categories`");
                foreach ($cates as $item) {
                    ?>
                <option <?php echo !empty($category_id) && $category_id == $item['id'] ? "selected" : False ?>
                    value="<?php echo $item['id'] ?>"><?php echo $item['name'] ?></option>
                <?php
                }
                ?>
            </select>
            <?php getMsgErr($errs, 'category_id') ?>
        </div>
        <div class="form-group">
            <label for="">Link hình ảnh</label>
            <div class="row ckfinder-group">
                <div class="col-10">
                    <input type="text" name="thumbnail" placeholder="Hình ảnh..." class="form-control image-render"
                        value="<?php getValueInput($data, 'thumbnail') ?>">
                    <?php getMsgErr($errs, 'thumbnail') ?>
                </div>
                <div class="col-2">
                    <button type="button" class="btn btn-success btn-block choose-image">Chọn ảnh</button>
                </div>
            </div>
        </div>

        <button type="submit" class="btn btn-primary">Thêm danh mục blog</button>
        <p><a href="?module=blog">Quay lại</a></p>

    </form>
</div>

<?php layout("footer", "admin", $data);

?>