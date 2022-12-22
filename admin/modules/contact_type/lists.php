<?php
$data = [
    'pageTitle'=>'Danh sách liên hệ của phòng ban'
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
$rows = getRows("select id from `contact_type` $filter");

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
            <a href="<?php echo getLinkAdmin('contact_type','add') ?>" class="btn btn-primary"><i class="fa fa-plus"></i>Thêm liên hệ của phòng ban</a>
            <hr>
            <form action="" method="GET">
                <div class="row">
                    <input type="hidden" name="module" value="contact_type">
                    <div class="col-9">
                        <input type="search" class="form-control" name="keyword" placeholder="Nhập vào tên liên hệ của phòng ban cần tìm kiếm.." value="<?php echo !empty($keywordSql) ? $keywordSql : false ?>">
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
                    <th class="text-center">Tên liên hệ của phòng ban</th>
                    <th class="text-center">Thời gian</th>
                    <th class="text-center" width="10%">Sửa</th>
                    <th class="text-center" width="10%">Xóa</th>
                </tr>
            </thead>
            <tbody>
            <?php
                $index = ($page - 1) * $perPage;
                $listContact = getRaw("SELECT id,name,create_at,update_at,COUNT(type_id) AS soluong FROM contact_type LEFT JOIN 
                (select type_id from contacts ) AS TEMP
                ON contact_type.id = TEMP.type_id
                $filter 
                GROUP BY id,name,create_at,update_at ORDER BY update_at desc limit $index,$perPage");

                
                $n = count($listContact);
                for ($index = 1; $index <= $n; $index++) {
                    $cateDetail = $listContact[$index-1];
                    $id = $cateDetail['id'];
                    $name = $cateDetail['name'];
                    $date_time = empty($cateDetail['update_at'])? $cateDetail['create_at'] : $cateDetail['update_at'];
                    $create_at = getDateFormat($cateDetail['create_at'],'d/m/Y H:i:s');
                    $count = $cateDetail['soluong']
            ?>
                <tr>
                    <td class="text-center"><?php echo $index ?></td>
                    <td class="text-center"><a href="<?php echo getLinkAdmin('contact_type','update',['id'=>$id]) ?>" > <?php echo "$name (SL:$count)" ?></a><br>
                    <a href="<?php echo getLinkAdmin('contact_type','duplicate',['id'=>$id])  ?>" class="btn btn-danger btn-sm" style="padding: 0 5px;margin-left: 8px;" >Nhân bản</a>
                </td></td>
                    <td class="text-center"><?php echo $create_at ?></td>
                    
                    <td class="text-center"><a href="<?php echo getLinkAdmin('contact_type','update',['id'=>$id]) ?>" class="btn btn-warning btn-sm"><i class="fa fa-edit"></i> Sửa</a></td>
                    <?php  if($count==0):?>
                    <td class="text-center"><a href="<?php echo getLinkAdmin('contact_type','delete',['id'=>$id]) ?>" onclick="return confirm('Bạn có thật sự muốn xóa!') " class="btn btn-danger btn-sm"><i class="fa fa-trash"></i> Xóa</a></td>
                    <?php endif; ?>
                </tr>
            <?php 
                }
                if($n == 0){
                    if ($n == 0) {
                        echo "<tr>
                        <td colspan='4'><div style='text-align:center;'>Chưa có liên hệ của phòng ban nào!</div></td></tr>";
                    }
                }
            ?>
            </tbody>
           </table>

           <br>

           <nav aria-label="Page navigation example" class="d-flex justify-content-end" style="display: <?php echo $rows > 0 ? "block" : "none" ?>;">
        <ul class="pagination pagination-sm">
            <li class="page-item"><a class="page-link"
                    href="?module=contact_type&<?php echo $queryStr ?>&page=<?php echo $page > 1 ? $page -= 1 : $page ?>">Previous</a>
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
                $link = _WEB_HOST_ROOT_ADMIN."/?module=contact_type&$queryStr&page=$i";

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
                    href="?module=contact_type&<?php echo $queryStr ?>&page=<?php $index =  empty(getBody()['page']) ? 2 : getBody()['page'] + 1;
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