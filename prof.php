<?php
session_start();
include "db.php";

if (!isset($_SESSION['user'])) {
    header("Location: loginn.php");
    exit();
}

$user_id = $_SESSION['user']['id'];  

$sql = "SELECT * FROM utilisateu WHERE id = ?";
$stmt = $connect->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();
$photo_path = (!empty($user['photo']) && file_exists($user['photo'])) ? $user['photo'] : 'profile.jpg';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
    <link rel="stylesheet" href="profile.css">
    <title>Profile</title>
</head>
<body>
    <div class="profile">
        <div class="image">
            <div class="cover">
                <img src="imagesprofile.jpeg" alt="Cover Image">
            </div>
            <div class="image_profile">
                <?php
                if (!empty($user['photo'])&& file_exists($user['photo'])){
                    $photo_path=$user['photo'];
                }else{
                    $photo_path='pp.png';
                }
?>
                <img src="<?php echo $photo_path;?>" alt="Profile Picture">
            </div>
        </div>

        <div class="information">
            <h1><?php echo htmlspecialchars($user['nom']);echo " ";echo htmlspecialchars($user['prenom']); ?></h1>
            <h2><?php echo htmlspecialchars($user['filiere']); ?></h2>
            <h2><?php echo htmlspecialchars($user['competence']); ?></h2>


            <button id="change" >change profile</button>
        </div>


        <form class="update_information" action="update.php" method="post" enctype="multipart/form-data">            <i class="fa-solid fa-close" id="close" style="display: flex;cursor: pointer; color: white; margin-bottom: 30px; font-size: 20px;"></i>

            <label for="photo" style="color: white;">photo profile</label>
            <input type="file" name="photo" placeholder="chose photo" >
            <input type="text" name="name" placeholder="name">
            <input type="text" name="fullname" placeholder="prenom">
            <input type="text" name="filiere" placeholder="filiere">
            <input type="text" name="competence" placeholder="competence">

            <button type="submit" > save</button>


        </form>


        
    </div>

    <div class="project">
        <div class="header_project">
            <h1>Projects</h1>
        </div>
        <div class="project_box">
            <div class="scroll">
                <div class="image">
                    <img src="project1.jpeg" alt="Project 1">

                    <h2>Project 1 Title</h2>
                    <h3>Project 1 Field</h3>
                    <span>Project 1 Description</span>
                </div>


            </div>

            <div class="scroll">
                <div class="image">
                    
                    <img src="project2.jpeg" alt="Project 2">
                    <h2>Project 2 Title</h2>

                    <h3>Project 2 Field</h3>
                    <span>Project 2 Description</span>
                </div>
            </div>
        </div>
    </div>




<script src="profile.js"></script>
</body>
</html>