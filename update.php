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
    $new_nom=trim($_POST['name']);
    $new_prenom=trim($_POST['fullname']);
    $new_filere=trim($_POST['filiere']);
    $new_competence=trim($_POST['competence']);
if(isset($_FILES['photo'])&&$_FILES['photo']['error']==0){
    $photo_tmp_name=$_FILES['photo']['tmp_name'];
    $photo_name=basename($_FILES['photo']['name']);
    $upload_dir='uploads/';

    if(!is_dir($upload_dir)){
        mkdir($upload_dir,0777,true);
    }
    $photo_path=$upload_dir . $photo_name;
    move_uploaded_file($photo_tmp_name,$photo_path);

    $sql = "UPDATE utilisateu SET nom=?, prenom=?, filiere=?, photo=?, competence=? WHERE id=?";
    $stmt=$connect->prepare($sql);
$stmt->bind_param("sssssi",$new_nom,$new_prenom,$new_filere,$photo_path,$new_competence,$user_id);
}else{

    $sql = "UPDATE utilisateu SET nom=?, prenom=?, filiere=?, competence=? WHERE id=?";
    $stmt=$connect->prepare($sql);
$stmt->bind_param("ssssi",$new_nom,$new_prenom,$new_filere,$new_competence,$user_id);

}
if($stmt->execute()){
    header("Location: prof.php");
    exit();
}else{
    echo "not update" . $stmt->error;
}




$stmt->close();
$connect->close();
}

?>