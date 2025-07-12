<?php
session_start();
include "db.php";
if (!isset($_SESSION['user'])) {
    header("Location: loginn.php");
    exit();
}

$user_id=$_SESSION['user']['id'];

if($_SERVER["REQUEST_METHOD"]==="POST")
{
    $titre=trim($_POST['titre']);
    $description=trim($_POST['description']);
   if(isset($_FILES['photo_pro'])&&$_FILES['photo_pro']['error']==0){
    $photo_tmp_name=$_FILES['photo_pro']['tmp_name'];
    $photo_name=basename($_FILES['photo_pro']['name']);
    $upload_dir='uploads/';

    if(!is_dir($upload_dir)){
        mkdir($upload_dir,0777,true);
    }

    $photo_path=$upload_dir . $photo_name;
    move_uploaded_file($photo_tmp_name,$photo_path);
}
    $sql = "INSERT INTO projet (id_utilisateur,titre,description,photo_pro) VALUES (?,?,?,?)";
    $stmt=$connect->prepare($sql);
$stmt->bind_param("isss",$user_id,$titre,$description,$photo_path);


if($stmt->execute()){
    header("Location: interface.php");
    exit();
}else{
    echo "not update" . $stmt->error;
}




$stmt->close();
$connect->close();
}

?>