<?php
$data = [
    'pageTitle'=>'Quản lý liên hệ'
];
layout('header','admin',$data);
layout('sidebar','admin',$data);
layout('breadcrumb','admin',$data);

// a();

$filter = "";
$keyword = "";
if (isGet()) {
    $body = getBody();

    if (!empty($body['status']) ) {
        $status = $body['status'];
        if($body['status']!=0){
            $statusSql = $status-1;
            $filter = "WHERE status = $statusSql";
        }
    }

    if (!empty($body['group_id']) ) {
        if($body['group_id']!=0){
            $group_id = $body['group_id'];

        $groupIdSql = $group_id;
        
        if (empty($filter)) {
            $filter = " WHERE type_id = $groupIdSql";
        } else {
            $filter .= " and type_id = $groupIdSql ";
        }
        }
    }


    if (!empty($body['keyword'])) {
        $keyword = $body['keyword'];

        setFlashData("keyword",$keyword);

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
$rows = getRows("select id from `contacts` $filter");

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
            <a href="<?php echo getLinkAdmin('contacts','add') ?>" class="btn btn-primary"><i class="fa fa-plus"></i>Thêm liên hệ</a>
            <hr>
            <form action="" method="GET">
                <div class="row">
                    <input type="hidden" name="module" value="contacts">
                    <div class="col-2">
                        <div class="form-group">
                            <select name="status" class="form-control">
                                <option value="0">Chọn trạng thái</option>
                                <option value="1" <?php echo !empty($status) && $status == 1 ? "selected" : False ?>>Chưa xử lý</option>
                                <option value="2" <?php echo !empty($status) && $status == 2 ? "selected" : False ?>>Đang xử lý</option>
                                <option value="3" <?php echo !empty($status) && $status == 3 ? "selected" : False ?>>Đã xử lý</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-2">
                        <div class="form-group">
                            <select name="group_id" class="form-control">
                                <option value="0">Chọn phòng ban</option>
                                <?php 
                                $groups = getRaw("select id,name from `contact_type`");
                                foreach ($groups as $item) {
                                    ?>
                                    <option <?php echo !empty($group_id) && $group_id == $item['id'] ? "selected" : False ?> value="<?php echo $item['id'] ?>" ><?php echo $item['name'] ?></option>
                                    <?php
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-5">
                        <input type="search" class="form-control" name="keyword" placeholder="Nhập vào tên nhóm cần tìm kiếm.." value="<?php echo !empty($keywordSql) ? $keywordSql : false ?>">
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
                    <th class="text-center" width="15%">Tên liên hệ</th>
                    <th class="text-center" width="15%">Email</th>
                    <th class="text-center" width="15%">Phòng ban</th>
                    <th class="text-center" width="15%">Thời gian</th>
                    <th class="text-center" width="15%">Trạng thái</th>
                    <th class="text-center" width="10%">Sửa</th>
                    <th class="text-center" width="10%">Xóa</th>
                </tr>
            </thead>
            <tbody>
            <?php
                $index = ($page - 1) * $perPage;
                $contacts = getRaw("select * from `contacts` $filter ORDER BY update_at desc limit $index,$perPage");
                
                $n = count($contacts);
                for ($index = 1; $index <= $n; $index++) {
                    $user = $contacts[$index-1];
                    $id = $user['id'];
                    $type_id = $user['type_id']; 

                    $group = firstRaw("select * from `contact_type` where id = $type_id");
                    $name_group = $group['name'];

                    $fullname = $user['fullname'];
                    $email = $user['email'];
                    $status = $user['status'];
                    $date_time = empty($user['update_at'])? $user['create_at'] : $user['update_at'];
                    $create_at = getDateFormat($date_time ,'d/m/Y H:i:s');
            ?>
                <tr>
                    <td class="text-center"><?php echo $index ?></td>
                    <td class="text-center"><?php echo $fullname ?><a href="<?php echo getLinkAdmin('contacts','duplicate',['id'=>$id])  ?>" class="btn btn-danger btn-sm" style="padding: 0 5px;margin-left: 8px;" >Nhân bản</a></td>
                    <td class="text-center"><?php echo $email ?></td>
                    <td class="text-center"><?php echo $name_group ?></td></td>
                    <td class="text-center"><?php echo $create_at  ?></td>
                    <td class="text-center"><a href="" class="btn <?php
                    if($status==0){
                        echo "btn-danger";
                    }elseif($status==1){
                        echo "btn-warning";
                    }elseif($status==2){
                        echo "btn-success";
                    }
                    ?> btn-sm"><?php 
                    if($status==0){
                        echo "Chưa xử lý";
                    }elseif($status==1){
                        echo "Đang xử lý";
                    }elseif($status==2){
                        echo "Đã xử lý";
                    }
                    ?></a></td>
                    <td class="text-center"><a href="<?php echo getLinkAdmin('contacts','update',['id'=>$id]) ?>" class="btn btn-warning btn-sm"><i class="fa fa-edit"></i> Sửa</a></td>
                    <td class="text-center"><a href="<?php echo getLinkAdmin('contacts','delete',['id'=>$id]) ?>" onclick="return confirm('Bạn có thật sự muốn xóa!') " class="btn btn-danger btn-sm"><i class="fa fa-trash"></i> Xóa</a></td>
                </tr>
            <?php 
                }
                if($n == 0){
                    if ($n == 0) {
                        echo "<tr>
                        <td colspan='8'><div style='text-align:center;'>Chưa có liên hệ nào!</div></td></tr>";
                    }
                }
            ?>
            </tbody>
           </table>

           <br>

           <nav aria-label="Page navigation example" class="d-flex justify-content-end" style="display: <?php echo $rows > 0 ? "block" : "none" ?>;">
        <ul class="pagination pagination-sm">
            <li class="page-item"><a class="page-link"
                    href="?module=contacts&<?php echo $queryStr ?>&page=<?php echo $page > 1 ? $page -= 1 : $page ?>">Previous</a>
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
                $link = _WEB_HOST_ROOT_ADMIN."/?module=contacts&$queryStr&page=$i";

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
                    href="?module=contacts&<?php echo $queryStr ?>&page=<?php $index =  empty(getBody()['page']) ? 2 : getBody()['page'] + 1;
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