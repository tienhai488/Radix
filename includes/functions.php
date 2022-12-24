<?php
if (!defined('_INCODE')) die('Access Deined...');

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

function layout($layoutName='header', $dir = "", $data = []){

    if(!empty($dir)){
        $dir = '/'.$dir;
    }
    if (file_exists(_WEB_PATH_TEMPLATE.$dir.'/layouts/'.$layoutName.'.php')){
        require_once _WEB_PATH_TEMPLATE.$dir.'/layouts/'.$layoutName.'.php';
    }
}

function sendMail($to, $subject, $content)
{
    $mail = new PHPMailer(true);

    try {
        //Server settings
        $mail->SMTPDebug = SMTP::DEBUG_OFF;
        $mail->isSMTP();
        $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
        $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
        $mail->Username   = 'tienhai488@gmail.com';                     //SMTP username
        $mail->Password   = 'wxwpuldcoanvfbbu';                               //SMTP password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
        $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

        //Recipients
        $mail->setFrom('tienhai@gmail.com', 'Unicode');
        $mail->addAddress($to);
        // $mail->addReplyTo($to, 'TienHai');

        //Content
        $mail->isHTML(true);
        $mail->Subject = $subject;
        $mail->Body    = $content;

        $mail->CharSet = 'UTF-8';

        // ssl
        $mail->SMTPOptions = array(
            'ssl' => array(
                'verify_peer' => false,
                'verify_peer_name' => false,
                'allow_self_signed' => true
            )
        );

        return $mail->send();
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
}

//Kiểm tra phương thức POST
function isPost(){
    if ($_SERVER['REQUEST_METHOD']=='POST'){
        return true;
    }

    return false;
}

//Kiểm tra phương thức GET
function isGet(){
    if ($_SERVER['REQUEST_METHOD']=='GET'){
        return true;
    }

    return false;
}

//Lấy giá trị phương thức POST, GET
function getBody(){

    $bodyArr = [];

    if (isGet()){
        //Xử lý chuỗi trước khi hiển thị ra
        //return $_GET;
        /*
         * Đọc key của mảng $_GET
         *
         * */
        if (!empty($_GET)){
            foreach ($_GET as $key=>$value){
                $key = strip_tags($key);
                if (is_array($value)){
                    $bodyArr[$key] = filter_input(INPUT_GET, $key, FILTER_SANITIZE_SPECIAL_CHARS, FILTER_REQUIRE_ARRAY);
                }else{
                    $bodyArr[$key] = filter_input(INPUT_GET, $key, FILTER_SANITIZE_SPECIAL_CHARS);
                }

            }
        }

    }

    if (isPost()){
        if (!empty($_POST)){
            foreach ($_POST as $key=>$value){
                $key = strip_tags($key);
                if (is_array($value)){
                    $bodyArr[$key] = filter_input(INPUT_POST, $key, FILTER_SANITIZE_SPECIAL_CHARS, FILTER_REQUIRE_ARRAY);
                }else{
                    $bodyArr[$key] = filter_input(INPUT_POST, $key, FILTER_SANITIZE_SPECIAL_CHARS);
                }

            }
        }
    }

    return $bodyArr;
}

//Kiểm tra email
function isEmail($email){
    $checkEmail = filter_var($email, FILTER_VALIDATE_EMAIL);
    return $checkEmail;
}

//Kiểm tra số nguyên
function isNumberInt($number, $range=[]){
    /*
     * $range = ['min_range'=>1, 'max_range'=>20];
     *
     * */
    if (!empty($range)){
        $options = ['options'=>$range];
        $checkNumber = filter_var($number, FILTER_VALIDATE_INT, $options);
    }else{
        $checkNumber = filter_var($number, FILTER_VALIDATE_INT);
    }

    return $checkNumber;

}

//Kiểm tra số thực
function isNumberFloat($number, $range=[]){
    /*
     * $range = ['min_range'=>1, 'max_range'=>20];
     *
     * */
    if (!empty($range)){
        $options = ['options'=>$range];
        $checkNumber = filter_var($number, FILTER_VALIDATE_FLOAT, $options);
    }else{
        $checkNumber = filter_var($number, FILTER_VALIDATE_FLOAT);
    }

    return $checkNumber;

}

//Kiểm tra số điện thoại (0123456789 - Bắt đầu bằng số 0, nối tiếp là 9 số)
function isPhone($phone){

    $checkFirstZero = false;

    if ($phone[0]=='0'){
        $checkFirstZero = true;
        $phone = substr($phone, 1);
    }

    $checkNumberLast = false;

    if (isNumberInt($phone) && strlen($phone)==9){
        $checkNumberLast = true;
    }

    if ($checkFirstZero && $checkNumberLast){
        return true;
    }

    return false;
}

//Hàm tạo thông báo
function getMsg($msg, $type='success'){
    if (!empty($msg)){
    echo '<div class="alert alert-'.$type.'">';
    echo $msg;
    echo '</div>';
    }
}

function getValueInput($data, $field)
{
    if (!empty($data) && !empty(trim($data["$field"]))) {
        echo $data["$field"];
    }
}


function getMsgErr($errs, $field)
{
    if (!empty($errs) && !empty($errs[$field])) {
        $msg = reset($errs[$field]);
        echo "<span style='color:red;'>$msg</span><br/>";
    }
}


//Hàm chuyển hướng
function redirect($path='index.php'){
    header("Location: $path");
    exit;
}

//Hàm thông báo lỗi
function form_error($fieldName, $errors, $beforeHtml='', $afterHtml=''){
    return (!empty($errors[$fieldName]))?$beforeHtml.reset($errors[$fieldName]).$afterHtml:null;
}

//Hàm hiển thị dữ liệu cũ
function old($fieldName, $oldData, $default=null){
    return (!empty($oldData[$fieldName]))?$oldData[$fieldName]:$default;
}

//Kiểm tra trạng thái đăng nhập
function isLogin(){
    $checkLogin = false;
    if (getSession('login_token')){
        $tokenLogin = getSession('login_token');

        $queryToken = firstRaw("SELECT user_id FROM login_token WHERE token='$tokenLogin'");

        if (!empty($queryToken)){
            //$checkLogin = true;
            $checkLogin = $queryToken;
        }else{
            removeSession('login_token');
        }
    }

    return $checkLogin;
}

//Tự động xoá token login đếu đăng xuất
function autoRemoveTokenLogin(){
    $allUsers = getRaw("SELECT * FROM users WHERE status=1");

    if (!empty($allUsers)){
        foreach ($allUsers as $user){
            $now = date('Y-m-d H:i:s');

            $before = $user['last_activity'];

            $diff = strtotime($now)-strtotime($before);
            $diff = floor($diff/60);

            if ($diff>=1){
                delete('login_token', "user_id=".$user['id']);
            }
        }
    }
}

//Lưu lại thời gian cuối cùng hoạt động
function saveActivity(){
    $user_id = isLogin()['user_id'];
    update('users', ['last_activity'=>date('Y-m-d H:i:s')], "id=$user_id");
}

//Lấy thông tin user
function getUserInfo($user_id){
    $info = firstRaw("SELECT * FROM users WHERE id=$user_id");
    return $info;
}

function getActiveSidebar($module){
    if(empty(getBody()['module']) ){
        if(!$module){
            return true;
        }
        return false;
    }
    if(getBody()['module']==$module){
        return true;
    }
    return false;
}


function getLinkAdmin($module = "",$action = "",$params = []){
    if(empty($module)){
        return _WEB_HOST_ROOT_ADMIN;
    }
    $url = _WEB_HOST_ROOT_ADMIN."?module=$module";
    if(!empty($action)){
        $url .= "&action=$action";
    }

    if(!empty($params)){
        $paramsStr = http_build_query($params);
        $url .="&$paramsStr";
    }

    return $url;
}


function getDateFormat($strDate,$format){
    $dateObject = date_create($strDate);
    if(!empty($dateObject)){
        return date_format($dateObject,$format);
    }
    return false;
}

function checkIcon($str){
    $str = html_entity_decode($str);
    return strpos($str,"</i>") ;
}

function getLink($key = '',$value = ''){
    $body = getBody();
    $body[$key] = $value;
    $str = "";
    foreach ($body as $item=>$value) {
        $str .= $item.'='.$value.'&';
    }
    $str = trim($str,'&');
    return $str;
}

function showExceptionError($exception) {
    require_once _WEB_PATH_ROOT.'/modules/errors/exception.php';
    die();
}

function showErrorHandler($errno, $errstr, $errfile, $errline) {
    throw new ErrorException($errstr,0,$errno,$errfile,$errline);
}


function getValueOptions($key,$field = "opt_value"){
    $data = firstRaw("select * from options where opt_key = '$key'");
    if(!empty($data)){
        if(!empty($data[$field])){
            return $data[$field];
        }
        return "";
    }
    return "";
}

function loadErr($err='404'){
    $pathErr = _WEB_PATH_ROOT.'/modules/errors/'.$err.'.php';
    require_once $pathErr;
    die();
}


function getYoutubeId($url){
    $result = [];
    $urlStr = parse_url($url,PHP_URL_QUERY);
    parse_str($urlStr,$result);
    if(!empty($result['v'])){
        return $result['v'];
    }
    return false;
}

function getReplayComment($id,$blog_id){
    $dataSub = getRaw("select * from comments where  parent_id = $id and status = 1 order by create_at");
    
    if(!empty($dataSub)):
        foreach ($dataSub as $key => $value) {
        ?>
<div class="comment-list" style="width:auto">
    <div class="main">
        <div class="head" style="width:auto">
            <img src="https://cdn-icons-png.flaticon.com/512/149/149071.png" alt="#">
        </div>
        <div class="body">
            <h4><?php echo $value['name'] ?><span class="badge badge-danger"><?php
                    if(!empty($value['user_id'])){
                        $dataGroup = firstRaw("select name from groups where id = ".$value['user_id']);
                        echo reset($dataGroup);
                    }
                    ?></span></h4>
            <div class="comment-info">
                <p><span><?php echo getDateFormat($value['create_at'],'m-Y') ?> at<i
                            class="fa fa-clock-o"></i><?php echo getDateFormat($value['create_at'],'H:i') ?>,</span><a
                        href="<?php echo _WEB_HOST_ROOT.'?module=blog&action=detail&id='.$blog_id.'&replay-id='.$value['id'] ?>"><i
                            class="fa fa-comment-o"></i>Trả lời</a></p>
            </div>
            <p><?php echo $value['content'] ?></p>
        </div>
    </div>
    <?php getReplayComment($value['id'],$blog_id); ?>
</div>
<?php
        }
    endif;
    
}


function countCommnent($arrId = [],$result=0){
    if(!empty($arrId)){
        foreach ($arrId as $key => $value) {
            $id = $value['id'];
            $arrTemp = getRaw("select id from comments where parent_id = $id and status = 1");
            if(!empty($arrTemp)){
                $result += count($arrTemp);
                return countCommnent($arrTemp,$result);
            }
        }
    }
    return $result;
}

function deleteComment($arrId){
    if(!empty($arrId)){
        $arrTemp = [];
        foreach ($arrId as $key => $value) {
          $arrTemp[] = $value['id'];
        }
        $strSql = implode(",",$arrTemp);
        delete("comments","id in ($strSql)");
        foreach ($arrTemp as $key => $value) {
            $arrId = getRaw("select id from comments where parent_id = $value");
            deleteComment($arrId);
        }
    }

  
}