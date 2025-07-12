<?php
include "db.php";

$sql="SELECT * FROM  utilisateu where id='user_id'";
$result=$connect->query($sql);
$user=$result->fetch_assoc;

?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
    <link rel="stylesheet" href="profile.css">
    <title>profile</title>
</head>
<body>
    <div class="profile">
        <div class="image">
            <div class="cover">
                <img src="imagesprofile.jpeg" alt="">

            </div>
            <div class="image_profile">
                <img src="profile.jpg" alt="">
            
            </div>
        </div>

        <div class="information">

            <h1><?php echo htmlspecialchars($user['nom']) ?></h1>
            <h2>computer science</h2>
            <h3>mahammed yahia ben sadik</h3>
            <span>jijel,algeria</span>
            <h3>2 likes</h3>
        </div>

    </div>

    <div class="project">
        <div class="header_project">
            <h1>projects</h1>

        </div>
        <div class="project_box">
            <div class="scroll">
                <div class="image">
                    <img src="project1.jpeg" alt="">

                    <h2>amirouche abdelwadoud</h2>
                    <h3>computer science</h3>
                    <span>development d'application est de web</span>

                </div>



            </div>

            <div class="scroll">
                <div class="image">
                    <img src="project2.jpeg" alt="">

                    <h2>amirouche abdelwadoud</h2>
                    <h3>computer science</h3>
                    <span>development d'application est de web</span>

                </div>



            </div>

        </div>





    </div>


    
</body>
</html>