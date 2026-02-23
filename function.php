<?php

function filterRequest($requestname){
    return htmlspecialchars(strip_tags($_POST[$requestname]));
}

function getAllData($table, $where = null, $values = null,$json =true)
{
    global $con;
    $data = array();
    if($where ==null){
            $stmt = $con->prepare("SELECT  * FROM $table  ");

    }else{
            $stmt = $con->prepare("SELECT  * FROM $table WHERE   $where ");

    }
    $stmt->execute($values);
    $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $count  = $stmt->rowCount();
    if($json){
        if ($count > 0){
        echo json_encode(array("status" => "success", "data" => $data));
    } else {
        echo json_encode(array("status" => "failure"));
    }
    }else{
        return $data;
    }
    
}

function getData($table, $where = null, $values = null)
{
    global $con;
    $data = array();
    $stmt = $con->prepare("SELECT  * FROM $table WHERE   $where ");
    $stmt->execute($values);
    $data = $stmt->fetch(PDO::FETCH_ASSOC);
    $count  = $stmt->rowCount();
    if ($count > 0){
        echo json_encode(array("status" => "success", "data" => $data));
    } else {
        echo json_encode(array("status" => "failure"));
    }
    return $count;
}

function insertData($table, $data, $json = true)
{
    global $con;
    foreach ($data as $field => $v)
        $ins[] = ':' . $field;
    $ins = implode(',', $ins);
    $fields = implode(',', array_keys($data));
    $sql = "INSERT INTO $table ($fields) VALUES ($ins)";

    $stmt = $con->prepare($sql);
    foreach ($data as $f => $v) {
        $stmt->bindValue(':' . $f, $v);
    }
    $stmt->execute();
    $count = $stmt->rowCount();
    if ($json == true) {
    if ($count > 0) {
        echo json_encode(array("status" => "success"));
    } else {
        echo json_encode(array("status" => "failure"));
    }
  }
    
}
function deleteData($table, $where, $json = true)
{
    global $con;

    $stmt = $con->prepare("DELETE FROM $table WHERE $where");
    $stmt->execute();
    $count = $stmt->rowCount();

    if ($json == true) {
        if ($count > 0) {
            echo json_encode(["status" => "success"]);
        } else {
            echo json_encode(["status" => "failure"]);
        }
    }

    return $count;
}



function updateData($table, $data, $where, $json = true)
{
    global $con;
    $cols = array();
    $vals = array();

    foreach ($data as $key => $val) {
        $vals[] = "$val";
        $cols[] = "`$key` =  ? ";
    }
    $sql = "UPDATE $table SET " . implode(', ', $cols) . " WHERE $where";

    $stmt = $con->prepare($sql);
    $stmt->execute($vals);
    $count = $stmt->rowCount();
    if ($json == true) {
    if ($count > 0) {
        echo json_encode(array("status" => "success"));
    } else {
        echo json_encode(array("status" => "failure"));
    }
    }
    return $count;
}



define('MB', 1048576);
//الدالة الخاصة برفع الصور
function imageUpload($requestName){

  if(!isset($_FILES[$requestName])){
    return "fail_no_file";
  }

  $msgError = [];

  $imagename     = rand(1000,10000) . "_" . $_FILES[$requestName]['name'];
  $imagetempname = $_FILES[$requestName]['tmp_name'];
  $imagesize     = $_FILES[$requestName]['size'];

  $allowExt = array("png","jpg","jpeg","pdf","mp3");

  $extlower = strtolower(pathinfo($imagename, PATHINFO_EXTENSION));

  if(!in_array($extlower, $allowExt)){
    $msgError[] = "error:Ext";
  }

  if($imagesize > 8 * MB){
    $msgError[] = "error:Size";
  }

  if(empty($msgError)){
    move_uploaded_file($imagetempname, "upload/" . $imagename);
    return $imagename;
  }else{
    return implode(",", $msgError);
  }
}

//دالة حذف الملف مع الملاحظة
function deleteFile($dir ,$imagename){
  if(file_exists($dir."/".$imagename)){
   unlink($dir."/".$imagename);
  }
}
//دالة الsecurity

function checkAuthenticate()
    {
      if (isset($_SERVER['PHP_AUTH_USER'])  && isset($_SERVER['PHP_AUTH_PW'])) {

        if ($_SERVER['PHP_AUTH_USER'] != "wael" ||  $_SERVER['PHP_AUTH_PW'] != "wael12345"){
            header('WWW-Authenticate: Basic realm="My Realm"');
            header('HTTP/1.0 401 Unauthorized');
            echo 'Page Not Found';
            exit;
        }
    } else {
        exit;
    }
    }

    //دالة رسالة الخطأ
    function printFailure($msg){
        echo json_encode(array("status" => "failure", "message" => $msg));
    }
    function printSuccess($msg){
        echo json_encode(array("status" => "success", "message" => $msg));
    }
    function result($count){
        if($count>0){
            printSuccess("success");
        }else{
            printFailure("failure");
        }
    }
    //دالة ارسال رسالة للبريد الالكتروني
    function sendEmail(String $email, String $subject, String $body){
    require_once 'phpmailer/mail.php';
    $mail = createMailer();

    $mail->setFrom('sharifnoura413@gmail.com', "noura hassanin");
    $mail->addAddress($email);
    $mail->Subject = $subject;
    $mail->Body = $body;

    return $mail->send(); // بدون أي echo
}


?>