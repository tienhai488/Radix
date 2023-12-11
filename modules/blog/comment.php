<?php 
$id = getBody()['id'];

$listComment = getRaw('select * from comments where parent_id = 0 and status=1 and blog_id = '.$id.' order by create_at desc');



$listId = getRaw("select id from comments where blog_id = $id and parent_id = 0 and status = 1");
$n_comment = countCommnent($listId,count($listId));


?>

<div class="blog-comments">
    <h2 class="title"><?php echo $n_comment ?> Bình Luận</h2>
    <div class="comments-body">
        <?php 
        if(!empty($listComment)):
           
            foreach ($listComment as $key => $value) {
                ?>
        <div class="single-comments">
            <div class="main">
                <div class="head" style="width:auto">
                    <img src="https://cdn-icons-png.flaticon.com/512/149/149071.png" alt="#">
                </div>
                <div class="body">
                    <h4><?php echo $value['name'] ?> <span class="badge badge-danger"><?php
                    if(!empty($value['user_id'])){
                        $dataGroup = firstRaw("select name from groups where id = ".$value['user_id']);
                        echo reset($dataGroup);
                    }
                    ?></span> </h4>
                    <div class="comment-info">
                        <p><span><?php echo getDateFormat($value['create_at'],'m-Y') ?> at<i
                                    class="fa fa-clock-o"></i><?php echo getDateFormat($value['create_at'],'H:i') ?>,</span><a
                                href="<?php echo _WEB_HOST_ROOT.'?module=blog&action=detail&id='.$id.'&replay-id='.$value['id'] ?>"><i
                                    class="fa fa-comment-o"></i>Trả lời</a>
                            <?php 
                                    if(isLogin() && $value['status']==1):
                                        ?>
                            ,
                            <a href="<?php echo getLinkAdmin('comments', 'update-status', ['id' => $value['id']]) ?>"><i
                                    class="far fa-eye-slash"></i>Ẩn</a>
                            <?php
                                    endif;
                                    ?>
                        </p>
                    </div>
                    <p><?php echo $value['content'] ?></p>
                </div>
            </div>

            <?php 
            getReplayComment($value['id'],$id);
            ?>
        </div>
        <?php
            }

        endif;
        ?>


    </div>
</div>