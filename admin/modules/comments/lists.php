<?php
$data = [
    'pageTitle' => 'Quản lý bình luận'
];
layout('header', 'admin', $data);
layout('sidebar', 'admin', $data);
layout('breadcrumb', 'admin', $data);


$filter = "";
$keyword = "";
if (isGet()) {
    $body = getBody();

    if (!empty($body['status'])) {
        if ($body['status'] != 0) {
            $status = $body['status'];

            $statusSql = $status;
            if ($status == 2) {
                $statusSql = 0;
            }
            $filter = "WHERE status = $statusSql";
        }
    }

    if (!empty($body['blog_id'])) {
        if ($body['blog_id'] != 0) {
            $blog_id = $body['blog_id'];

            $groupIdSql = $blog_id;

            if (empty($filter)) {
                $filter = " WHERE blog_id = $groupIdSql";
            } else {
                $filter .= " and blog_id = $groupIdSql ";
            }
        }
    }


    if (!empty($body['keyword'])) {
        $keyword = $body['keyword'];

        setFlashData("keyword", $keyword);

        $keywordSql = $keyword;

        if (empty($filter)) {
            $filter = "WHERE name like '%$keywordSql%'";
        } else {
            $filter .= " and name like '%$keywordSql%' ";
        }
    }
}


if (!empty(getBody()['page'])) {
    $page = getBody()['page'];
} else {
    $page = 1;
}

$temp = $keyword;
// str_replace(" ","+",$temp);
$queryStr = "keyword=$temp";

$perPage = _PER_PAGE;
// so dong hien thi tren mot trang
$rows = getRows("select id from `comments` $filter");

$maxpage = ceil($rows / $perPage);

if ($page < 1 || $page > $maxpage) {
    $page = 1;
}

$msg = getFlashData('msg');
$msg_type = getFlashData('msg_type');

?>

<section class="content">
    <div class="container-fluid">
        <?php
        getMsg($msg, $msg_type);
        ?>

        <hr>
        <form action="" method="GET">
            <div class="row">
                <input type="hidden" name="module" value="comments">
                <div class="col-2">
                    <div class="form-group">
                        <select name="status" class="form-control">
                            <option value="0">Chọn trạng thái</option>
                            <option value="1" <?php echo !empty($status) && $status == 1 ? "selected" : False ?>>Đã
                                duyệt</option>
                            <option value="2" <?php echo !empty($status) && $status == 2 ? "selected" : False ?>>Chưa
                                duyệt</option>
                        </select>
                    </div>
                </div>
                <div class="col-4">
                    <div class="form-group">
                        <select name="blog_id" class="form-control">
                            <option value="0">Chọn Blog</option>
                            <?php
                            $blogs = getRaw("select id,title from `blog`");
                            foreach ($blogs as $item) {
                            ?>
                            <option <?php echo !empty($blog_id) && $blog_id == $item['id'] ? "selected" : False ?>
                                value="<?php echo $item['id'] ?>"><?php echo $item['title'] ?></option>
                            <?php
                            }
                            ?>
                        </select>
                    </div>
                </div>
                <div class="col-4">
                    <input type="search" class="form-control" name="keyword"
                        placeholder="Nhập vào tên người đã bình luận.."
                        value="<?php echo !empty($keywordSql) ? $keywordSql : false ?>">
                </div>
                <div class="col-2">
                    <button type="submit" class="btn btn-primary btn-block">Tìm kiếm</button>
                </div>
            </div>
        </form>
        <hr>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th class="text-center" width="5%">STT</th>
                    <th class="text-center" width="">Thông tin</th>
                    <th class="text-center" width="">Nội dung</th>
                    <th class="text-center" width="">Blog</th>
                    <th class="text-center" width="10%">Thời gian</th>
                    <th class="text-center" width="10%">Trạng thái</th>
                    <th class="text-center" width="5%">Sửa</th>
                    <th class="text-center" width="5%">Xóa</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $index = ($page - 1) * $perPage;
                $comments = getRaw("select * from `comments` $filter ORDER BY create_at desc limit $index,$perPage");

                $n = count($comments);
                for ($index = 1; $index <= $n; $index++) {
                    $comment = $comments[$index - 1];
                    $id = $comment['id'];

                    $name = $comment['name'];

                    $email = $comment['email'];
                    
                    $content = $comment['content'];

                    $blog_id = $comment['blog_id'];
                    $blog = firstRaw("select * from blog where id = $blog_id");

                    $status = $comment['status'];
                    
                    $date_time = $comment['create_at'];
                    $create_at = getDateFormat($date_time, 'd/m/Y H:i:s');
                ?>
                <tr>
                    <td class="text-center"><?php echo $index ?></td>
                    <td class="text-center">
                        <?php 
                        echo "Name : <strong>$name</strong> <br/>";
                        echo "Email : <strong>$email</strong> <br/>";
                        if($comment['parent_id']!=0){
                            $replay = firstRaw('select * from comments where id = '.$comment['parent_id']);
                            echo "Trả lời : <strong>".$replay['name']."</.strong>";
                        }
                        ?>
                    </td>
                    <td class="text-center"><?php echo $content ?></td>
                    <td class="text-center"><a target="_blank"
                            href="<?php echo _WEB_HOST_ROOT.'/?module=blog&action=detail&id='.$blog_id ?>"><?php echo $blog['title'] ?></a>
                    </td>
                    </td>
                    <td class="text-center"><?php echo $create_at  ?></td>
                    <td class="text-center"><a
                            href="<?php echo getLinkAdmin('comments', 'update-status', ['id' => $id]) ?>"
                            class="btn <?php echo $status ? "btn-success" : "btn-warning" ?> btn-sm"><?php echo $status ? "Đã duyệt" : "Chưa duyệt" ?></a>
                    </td>
                    <td class="text-center"><a href="<?php echo getLinkAdmin('comments', 'update', ['id' => $id]) ?>"
                            class="btn btn-warning btn-sm"><i class="fa fa-edit"></i> </a></td>
                    <?php if (isLogin()['user_id'] != $id) : ?>
                    <td class="text-center"><a href="<?php echo getLinkAdmin('comments', 'delete', ['id' => $id]) ?>"
                            onclick="return confirm('Bạn có thật sự muốn xóa!') " class="btn btn-danger btn-sm"><i
                                class="fa fa-trash"></i> </a></td>
                    <?php endif; ?>
                </tr>
                <?php
                }
                if ($n == 0) {
                    if ($n == 0) {
                        echo "<tr>
                        <td colspan='8'><div style='text-align:center;'>Chưa có bình luận nào!</div></td></tr>";
                    }
                }
                ?>
            </tbody>
        </table>

        <br>

        <nav aria-label="Page navigation example" class="d-flex justify-content-end"
            style="display: <?php echo $rows > 0 ? "block" : "none" ?>;">
            <ul class="pagination pagination-sm">
                <li class="page-item"><a class="page-link"
                        href="?module=comments&<?php echo $queryStr ?>&page=<?php echo $page > 1 ? $page -= 1 : $page ?>">Previous</a>
                </li>
                <?php
                $start = $page - 2;
                if ($start < 1) {
                    $start = 1;
                }
                $end = $start + 4;
                if ($end > $maxpage) {
                    $end = $maxpage;
                    $start = $end - 4;
                    if ($start < 1) {
                        $start = 1;
                    }
                }
                for ($i = $start; $i <= $end; $i++) {
                    $link = _WEB_HOST_ROOT_ADMIN . "/?module=comments&$queryStr&page=$i";

                ?>
                <li class='<?php
                                $active = 1;
                                if (!empty(getBody()['page'])) {
                                    $active = getBody()['page'];
                                    if($active<1||$active>$maxpage){
                                        $active = 1;
                                    }
                                }
                                echo $active == $i ? 'page-item active' : 'page-item' ?>'><a class="page-link"
                        href="<?php echo $link ?>"> <?php echo $i ?></a>
                </li>
                <?php
                }
                ?>
                <li class="page-item"><a class="page-link"
                        href="?module=comments&<?php echo $queryStr ?>&page=<?php $index =  empty(getBody()['page']) ? 2 : getBody()['page'] + 1;
                        if($index<1){
                            $index = 1;
                        }
                                                                                                            echo ($index > $maxpage) ? $maxpage : $index; ?>">Next</a>
                </li>
            </ul>
        </nav>

    </div>
</section>
<!-- /.content -->

<?php
layout('footer', 'admin', $data);
?>