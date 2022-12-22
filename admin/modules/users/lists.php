<?php
$data = [
    'pageTitle' => 'Quản lý người dùng'
];
layout('header', 'admin', $data);
layout('sidebar', 'admin', $data);
layout('breadcrumb', 'admin', $data);

// a();

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

    if (!empty($body['group_id'])) {
        if ($body['group_id'] != 0) {
            $group_id = $body['group_id'];

            $groupIdSql = $group_id;

            if (empty($filter)) {
                $filter = " WHERE group_id = $groupIdSql";
            } else {
                $filter .= " and group_id = $groupIdSql ";
            }
        }
    }


    if (!empty($body['keyword'])) {
        $keyword = $body['keyword'];

        setFlashData("keyword", $keyword);

        $keywordSql = $keyword;

        if (empty($filter)) {
            $filter = "WHERE fullname like '%$keywordSql%'";
        } else {
            $filter .= " and fullname like '%$keywordSql%' ";
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
$rows = getRows("select id from `users` $filter");

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
        <a href="<?php echo getLinkAdmin('users', 'add') ?>" class="btn btn-primary"><i class="fa fa-plus"></i>Thêm
            người dùng</a>
        <hr>
        <form action="" method="GET">
            <div class="row">
                <input type="hidden" name="module" value="users">
                <div class="col-2">
                    <div class="form-group">
                        <select name="status" class="form-control">
                            <option value="0">Chọn trạng thái</option>
                            <option value="1" <?php echo !empty($status) && $status == 1 ? "selected" : False ?>>Kích
                                hoạt</option>
                            <option value="2" <?php echo !empty($status) && $status == 2 ? "selected" : False ?>>Chưa
                                kích hoạt</option>
                        </select>
                    </div>
                </div>
                <div class="col-2">
                    <div class="form-group">
                        <select name="group_id" class="form-control">
                            <option value="0">Chọn nhóm</option>
                            <?php
                            $groups = getRaw("select id,name from `groups`");
                            foreach ($groups as $item) {
                            ?>
                            <option <?php echo !empty($group_id) && $group_id == $item['id'] ? "selected" : False ?>
                                value="<?php echo $item['id'] ?>"><?php echo $item['name'] ?></option>
                            <?php
                            }
                            ?>
                        </select>
                    </div>
                </div>
                <div class="col-5">
                    <input type="search" class="form-control" name="keyword"
                        placeholder="Nhập vào tên nhóm cần tìm kiếm.."
                        value="<?php echo !empty($keywordSql) ? $keywordSql : false ?>">
                </div>
                <div class="col-3">
                    <button type="submit" class="btn btn-primary btn-block">Tìm kiếm</button>
                </div>
            </div>
        </form>
        <hr>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th class="text-center" width="5%">STT</th>
                    <th class="text-center" width="15%">Họ tên</th>
                    <th class="text-center" width="15%">Email</th>
                    <th class="text-center" width="15%">Nhóm</th>
                    <th class="text-center" width="15%">Thời gian</th>
                    <th class="text-center" width="15%">Trạng thái</th>
                    <th class="text-center" width="10%">Sửa</th>
                    <th class="text-center" width="10%">Xóa</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $index = ($page - 1) * $perPage;
                $users = getRaw("select * from `users` $filter ORDER BY update_at desc limit $index,$perPage");

                $n = count($users);
                for ($index = 1; $index <= $n; $index++) {
                    $user = $users[$index - 1];
                    $id = $user['id'];
                    $group_id = $user['group_id'];

                    $group = firstRaw("select * from `groups` where id = $group_id");
                    $name_group = $group['name'];

                    $fullname = $user['fullname'];
                    $email = $user['email'];
                    $status = $user['status'];
                    $date_time = empty($user['update_at']) ? $user['create_at'] : $user['update_at'];
                    $create_at = getDateFormat($date_time, 'd/m/Y H:i:s');
                ?>
                <tr>
                    <td class="text-center"><?php echo $index ?></td>
                    <td class="text-center"><?php echo $fullname ?></td>
                    <td class="text-center"><?php echo $email ?></td>
                    <td class="text-center"><?php echo $name_group ?></td>
                    </td>
                    <td class="text-center"><?php echo $create_at  ?></td>
                    <td class="text-center"><a href=""
                            class="btn <?php echo $status ? "btn-success" : "btn-danger" ?> btn-sm"><?php echo $status ? "Kích hoạt" : "Chưa kích hoạt" ?></a>
                    </td>
                    <td class="text-center"><a href="<?php echo getLinkAdmin('users', 'update', ['id' => $id]) ?>"
                            class="btn btn-warning btn-sm"><i class="fa fa-edit"></i> Sửa</a></td>
                    <?php if (isLogin()['user_id'] != $id) : ?>
                    <td class="text-center"><a href="<?php echo getLinkAdmin('users', 'delete', ['id' => $id]) ?>"
                            onclick="return confirm('Bạn có thật sự muốn xóa!') " class="btn btn-danger btn-sm"><i
                                class="fa fa-trash"></i> Xóa</a></td>
                    <?php endif; ?>
                </tr>
                <?php
                }
                if ($n == 0) {
                    if ($n == 0) {
                        echo "<tr>
                        <td colspan='8'><div style='text-align:center;'>Chưa có người dùng nào!</div></td></tr>";
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
                        href="?module=users&<?php echo $queryStr ?>&page=<?php echo $page > 1 ? $page -= 1 : $page ?>">Previous</a>
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
                    $link = _WEB_HOST_ROOT_ADMIN . "/?module=users&$queryStr&page=$i";

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
                        href="?module=users&<?php echo $queryStr ?>&page=<?php $index =  empty(getBody()['page']) ? 2 : getBody()['page'] + 1;
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