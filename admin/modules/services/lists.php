<?php
$data = [
    'pageTitle' => 'Quản lý dịch vụ'
];
layout('header', 'admin', $data);
layout('sidebar', 'admin', $data);
layout('breadcrumb', 'admin', $data);


$filter = "";
$keyword = "";
if (isGet()) {
    $body = getBody();


    if (!empty($body['user_id'])) {
        if ($body['user_id'] != 0) {
            $user_id = $body['user_id'];

            $userIdSql = $user_id;

            if (empty($filter)) {
                $filter = " WHERE user_id = $userIdSql";
            } else {
                $filter .= " and user_id = $userIdSql ";
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
$rows = getRows("select id from `services` $filter");

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
        <a href="<?php echo getLinkAdmin('services', 'add') ?>" class="btn btn-primary"><i class="fa fa-plus"></i>Thêm
            dịch vụ</a>
        <hr>
        <form action="" method="GET">
            <div class="row">
                <input type="hidden" name="module" value="services">
                <div class="col-3">
                    <div class="form-group">
                        <select name="user_id" class="form-control">
                            <option value="0">Chọn người đăng</option>
                            <?php
                            $users = getRaw("select id,fullname,email from `users`");
                            foreach ($users as $item) {
                                $fullname = $item['fullname'];
                                $email = $item['email'];
                            ?>
                            <option <?php echo !empty($user_id) && $user_id == $item['id'] ? "selected" : False ?>
                                value="<?php echo $item['id'] ?>"><?php echo "$fullname ($email)" ?></option>
                            <?php
                            }
                            ?>
                        </select>
                    </div>
                </div>
                <div class="col-6">
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
                    <th class="text-center" width="15%">Ảnh</th>
                    <th class="text-center" width="20%">Tên dịch vụ</th>
                    <th class="text-center" width="15%">Đăng bởi</th>
                    <th class="text-center" width="15%">Thời gian</th>
                    <th class="text-center" width="10%">Xem</th>
                    <th class="text-center" width="10%">Sửa</th>
                    <th class="text-center" width="10%">Xóa</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $index = ($page - 1) * $perPage;
                $services = getRaw("select * from `services` $filter ORDER BY update_at desc limit $index,$perPage");

                $n = count($services);
                for ($index = 1; $index <= $n; $index++) {
                    $service = $services[$index - 1];

                    $id = $service['id'];

                    $name = $service['name'];

                    $icon = $service['icon'];


                    $user_id = $service['user_id'];

                    $user = firstRaw("select * from `users` where id = $user_id");

                    $date_time = empty($service['update_at']) ? $service['create_at'] : $service['update_at'];
                    $create_at = getDateFormat($date_time, 'd/m/Y H:i:s');
                ?>
                <tr>
                    <td class="text-center"><?php echo $index ?></td>

                    <!-- <td class="text-center">
                        <i class="fas fa-viruses"></i>
                    </td> -->
                    <td class="text-center"><?php echo checkIcon($icon) ? "$icon" : "<img src='$icon' width='60' /> " ?>
                    </td>

                    <td class="text-center"><?php echo $name ?><a
                            href="<?php echo getLinkAdmin('services', 'duplicate', ['id' => $id])  ?>"
                            class="btn btn-danger btn-sm" style="padding: 0 5px;margin-left: 8px;">Nhân bản</a></td>

                    <td class="text-center"><a
                            href="<?php echo _WEB_HOST_ROOT_ADMIN . '/?' . getLink('user_id', $user['id']) ?>"><?php echo $user['fullname'] ?></a>

                    </td>

                    <td class="text-center"><?php echo $create_at  ?></td>

                    <td class="text-center"><a href="" class="btn btn-primary btn-sm"><?php echo "Xem" ?></a></td>

                    <td class="text-center"><a href="<?php echo getLinkAdmin('services', 'update', ['id' => $id]) ?>"
                            class="btn btn-warning btn-sm"><i class="fa fa-edit"></i> Sửa</a></td>

                    <td class="text-center"><a href="<?php echo getLinkAdmin('services', 'delete', ['id' => $id]) ?>"
                            onclick="return confirm('Bạn có thật sự muốn xóa!') " class="btn btn-danger btn-sm"><i
                                class="fa fa-trash"></i> Xóa</a></td>
                </tr>
                <?php
                }
                if ($n == 0) {
                    if ($n == 0) {
                        echo "<tr>
                        <td colspan='8'><div style='text-align:center;'>Chưa có dịch vụ nào!</div></td></tr>";
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
                        href="?module=services&<?php echo $queryStr ?>&page=<?php echo $page > 1 ? $page -= 1 : $page ?>">Previous</a>
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
                    $link = _WEB_HOST_ROOT_ADMIN . "/?module=services&$queryStr&page=$i";

                ?>
                <li class='<?php
                                $active = 1;
                                if (!empty(getBody()['page'])) {
                                    $active = getBody()['page'];
                                }
                                echo $active == $i ? 'page-item active' : 'page-item' ?>'><a class="page-link"
                        href="<?php echo $link ?>"> <?php echo $i ?></a>
                </li>
                <?php
                }
                ?>
                <li class="page-item"><a class="page-link"
                        href="?module=services&<?php echo $queryStr ?>&page=<?php $index =  empty(getBody()['page']) ? 2 : getBody()['page'] + 1;
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