<?php
$data = [
    'pageTitle'=>'Danh sách nhóm'
];
layout('header','admin',$data);
layout('sidebar','admin',$data);
layout('breadcrumb','admin',$data);


$filter = "";
$keyword = "";
if (isGet()) {
    $body = getBody();

    if (!empty($body['keyword'])) {
        $keyword = $body['keyword'];

        setFlashData("keyword",$keyword);

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
$rows = getRows("select id from `groups` $filter");

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
            getMsg($msg,$msg_type); 
            ?>
        <a href="<?php echo getLinkAdmin('groups','add') ?>" class="btn btn-primary"><i class="fa fa-plus"></i>Thêm nhóm
            mới</a>
        <hr>
        <form action="" method="GET">
            <div class="row">
                <input type="hidden" name="module" value="groups">
                <div class="col-9">
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
                    <th class="text-center">Tên</th>
                    <th class="text-center">Thời gian</th>
                    <th class="text-center" width="15%">Phân quyền</th>
                    <th class="text-center" width="10%">Sửa</th>
                    <th class="text-center" width="10%">Xóa</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $index = ($page - 1) * $perPage;
                $groups = getRaw("select * from `groups` $filter ORDER BY update_at desc limit $index,$perPage");
                
                $n = count($groups);
                for ($index = 1; $index <= $n; $index++) {
                    $group = $groups[$index-1];
                    $id = $group['id'];
                    $name = $group['name'];
                    // $permission = $group['permission'];
                    $date_time = empty($group['update_at'])? $group['create_at'] : $group['update_at'];
                    $create_at = getDateFormat($group['create_at'],'d/m/Y H:i:s');
            ?>
                <tr>
                    <td class="text-center"><?php echo $index ?></td>
                    <td class="text-center"><a href="<?php echo getLinkAdmin('groups','update',['id'=>$id]) ?>">
                            <?php echo $name ?></a></td>
                    </td>
                    <td class="text-center"><?php echo $create_at ?></td>
                    <td class="text-center"><a href="" class="btn btn-primary btn-sm">Phân quyền</a></td>
                    <td class="text-center"><a href="<?php echo getLinkAdmin('groups','update',['id'=>$id]) ?>"
                            class="btn btn-warning btn-sm"><i class="fa fa-edit"></i> Sửa</a></td>
                    <td class="text-center"><a href="<?php echo getLinkAdmin('groups','delete',['id'=>$id]) ?>"
                            onclick="return confirm('Bạn có thật sự muốn xóa!') " class="btn btn-danger btn-sm"><i
                                class="fa fa-trash"></i> Xóa</a></td>
                </tr>
                <?php 
                }
                if($n == 0){
                    if ($n == 0) {
                        echo "<tr>
                        <td colspan='6'><div style='text-align:center;'>Chưa có nhóm nào!</div></td></tr>";
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
                        href="?module=groups&<?php echo $queryStr ?>&page=<?php echo $page > 1 ? $page -= 1 : $page ?>">Previous</a>
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
            for ($i = $start ; $i <= $end; $i++) {
                $link = _WEB_HOST_ROOT_ADMIN."/?module=groups&$queryStr&page=$i";

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
                        href="?module=groups&<?php echo $queryStr ?>&page=<?php $index =  empty(getBody()['page']) ? 2 : getBody()['page'] + 1;
                                                                                            echo ($index > $maxpage) ? $maxpage : $index; ?>">Next</a>
                </li>
            </ul>
        </nav>

    </div>
</section>
<!-- /.content -->

<?php
layout('footer','admin',$data);
?>