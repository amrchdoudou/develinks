<?php
session_start();
include "db.php";

if (!isset($_SESSION['user'])) {
    header('Location: loginn.php');
    exit();
}

$user_id = $_SESSION['user']['id'];
$user_photo = !empty($_SESSION['user']['photo']) ? $_SESSION['user']['photo'] : 'profile.jpg';
/* $sql_profile = "SELECT * FROM utilisateu WHERE id != ?";
$stmt_profile = $connect->prepare($sql_profile);
$stmt_profile->bind_param("i", $user_id);*/
if (!empty($_GET['search'])) {
    $search = '%' . $_GET['search'] . '%';
    $sql_profile = "SELECT * FROM utilisateu WHERE id != ? AND (nom LIKE ? OR filiere LIKE ?)";
    $stmt_profile = $connect->prepare($sql_profile);
    $stmt_profile->bind_param("iss", $user_id, $search, $search);
} else {
    $sql_profile = "SELECT * FROM utilisateu WHERE id != ?";
    $stmt_profile = $connect->prepare($sql_profile);
    $stmt_profile->bind_param("i", $user_id);
}
$stmt_profile->execute();
$result_profile = $stmt_profile->get_result();


$liked_user_ids = [];
$like_query = $connect->prepare("SELECT liked_user_id FROM liked WHERE user_id = ?");
$like_query->bind_param("i", $user_id);
$like_query->execute();
$liked_result = $like_query->get_result();
while ($row = $liked_result->fetch_assoc()) {
    $liked_user_ids[] = $row['liked_user_id'];
}

$sql_projects = "SELECT projet.*, utilisateu.nom, utilisateu.prenom 
                 FROM projet
                 JOIN utilisateu ON projet.id_utilisateur = utilisateu.id
                 ORDER BY projet.date DESC";
$stmt_projects = $connect->prepare($sql_projects);
$stmt_projects->execute();
$result_projects = $stmt_projects->get_result();
$photo_path = (!empty($profile['photo'])&& file_exists($profile['photo']))? $profile['photo'] : 'profile.jpg';


$stmt_user = $connect->prepare("SELECT photo FROM utilisateu WHERE id = ?");
$stmt_user->bind_param("i", $user_id);
$stmt_user->execute();
$res = $stmt_user->get_result();
$user = $res->fetch_assoc();
$user_photo = !empty($user['photo']) ? $user['photo'] : 'profile.jpg';
?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
    <link rel="stylesheet" href="interface.css">
    <title>Document</title>
</head>

<body>
    <header>
        <div>
             <i class="fa-solid fa-bars" id="menu" style="display: none;"></i>
             <a href="prof.php" id="prof">
  <img src="<?php echo htmlspecialchars($user_photo); ?>" alt="user" style="width: 40px; height: 40px; border-radius: 50%;">
</a>        </div>
       


             <div class="but">
                     <i class="fa-brands fa-facebook-messenger" id="messenger"></i>
                     <i class="fa-solid fa-heart" id="liked"></i>
               <a href="logout.php">     <i class="fa-solid fa-right-from-bracket" id="logout"></i></a> 
             
               </div>


    </header>

    

    <div class="profile_project" id="pp">
        <div class="info_add_projet" style="margin-top:50px;">
            <h1>project</h1>
            <button id="addprojet">add projet</button>
        </div>

     

       
        <div class="containe_projet">
         <?php while($row =$result_projects->fetch_assoc()){?>

            <div class="scroll projet"
            data-id-utilisateur="<?php echo htmlspecialchars($row['id_utilisateur']); ?>"
        data-photo="<?php echo !empty($row['photo_pro']) ? htmlspecialchars($row['photo_pro']) : 'pp.png'; ?>"
        data-nom="<?php echo htmlspecialchars($row['nom']); ?>"
        data-prenom="<?php echo htmlspecialchars($row['prenom']); ?>"
        data-titre="<?php echo htmlspecialchars($row['titre']); ?>"
        data-description="<?php echo htmlspecialchars($row['description']); ?>">
                <div class="image">
                <img src="<?php echo !empty($row['photo_pro']) ? htmlspecialchars($row['photo_pro']) : 'pp.png'; ?>" alt="">
                <h2><?php echo htmlspecialchars($row['nom']) . ' ' . htmlspecialchars($row['prenom']); ?></h2>
                    <h3><?php echo htmlspecialchars($row['titre']); ?></h3>

                </div>
            </div>
            <?php
}?>

        </div>

        <div class="info_add_projet">
            <h1>profile</h1>
            <form method="get" action="interface.php" style="margin: 20px;">
    <input type="text" style="padding:10px;margin-right:20px;border-radius:10px;border:none;width:300px;" name="search" placeholder="Rechercher par nom ou filière" value="<?php echo isset($_GET['search']) ? htmlspecialchars($_GET['search']) : ''; ?>">
    <button type="submit">Rechercher</button>
</form>
        </div>
      


 <div class="container_profile">


            <?php while($row =$result_profile->fetch_assoc()){?>
                <div class="scroll profile"
     data-id="<?php echo htmlspecialchars($row['id']); ?>"
     data-photo="<?php echo !empty($row['photo']) ? htmlspecialchars($row['photo']) : 'profile.jpg'; ?>"
     data-name="<?php echo htmlspecialchars($row['nom'] . ' ' . $row['prenom']); ?>"
     data-filiere="<?php echo htmlspecialchars($row['filiere']); ?>"
     data-competence="<?php echo htmlspecialchars($row['competence']); ?>">

                    <div class="image">
                      <img src="<?php echo !empty($row['photo']) ? htmlspecialchars($row['photo']) : 'profile.jpg';  ?>" alt="">

                      <h2><?php echo htmlspecialchars($row['nom']);echo " ";echo htmlspecialchars($row['prenom']); ?></h2>
                      <h3><?php echo htmlspecialchars($row['filiere']); ?></h3>
                      <span><?php echo htmlspecialchars($row['competence']); ?></span>

                  </div>

                  <div class="interaction">
    <a href="interface.php?chat_with=<?php echo $row['id']; ?>">
        <i class="fa-solid fa-message"></i>
    </a>

    <?php
    $is_liked = in_array($row['id'], $liked_user_ids); 
    $liked_class = $is_liked ? 'liked' : '';
    ?>
    <i class="fa-solid fa-heart like-button <?php echo $liked_class; ?>" data-id="<?php echo $row['id']; ?>"></i>
</div>

</div>     


<?php
}?>
         

      </div>
    
       

    </div>


    <div class="messenger messa" id="message">
        <div class="message_box">
            <i class="fa-brands fa-facebook-messenger"></i>
            <h1>messages</h1>
        </div>
       
        <div class="list_message">
<?php
$current_user = $_SESSION['user']['id'];

// Get all users who sent or received a message with current user
$sql = "
    SELECT DISTINCT u.id, u.nom, u.prenom, u.photo
    FROM utilisateu u
    INNER JOIN message m ON (u.id = m.id_expediteur AND m.id_destinataire = ?)
                       OR (u.id = m.id_destinataire AND m.id_expediteur = ?)
    WHERE u.id != ?
";
$stmt = $connect->prepare($sql);
$stmt->bind_param("iii", $current_user, $current_user, $current_user);
$stmt->execute();
$contacts = $stmt->get_result();

while ($contact = $contacts->fetch_assoc()) {
    $photo = !empty($contact['photo']) ? htmlspecialchars($contact['photo']) : 'profile.jpg';
    $name = htmlspecialchars($contact['nom'] . ' ' . $contact['prenom']);
    $chat_link = 'interface.php?chat_with=' . urlencode($contact['id']);

    echo "
    <a href=\"$chat_link\" class=\"person\">
        <img src=\"$photo\" alt=\"\">
        <h3>$name</h3>
    </a>
    ";
}
?>
</div>

    </div>




    <div class="messenger liked" id="like">
    <div class="list_message">
<?php
$current_user = $_SESSION['user']['id'];
$sql = "SELECT u.* FROM liked l 
        JOIN utilisateu u ON u.id = l.liked_user_id 
        WHERE l.user_id = ?";
$stmt = $connect->prepare($sql);
$stmt->bind_param("i", $current_user);
$stmt->execute();
$liked_users = $stmt->get_result();

while ($row = $liked_users->fetch_assoc()) {
    $photo = !empty($row['photo']) ? htmlspecialchars($row['photo']) : 'profile.jpg';
    $name = htmlspecialchars($row['nom'] . ' ' . $row['prenom']);
    $id = $row['id'];

    echo "
    <div class=\"person\">
        <img src=\"$photo\" alt=\"\">
        <h3>$name</h3>
        <button class=\"unlike-button\" data-id=\"$id\" style=\"background:none;border:none;color:red;cursor:pointer;\">
            <i class=\"fa-solid fa-heart-crack\"></i>
        </button>
    </div>";
}
?>
</div>
    </div>





    <form class="comunnication" action="message.php" method="post">
        <div class="chat_header">
            <h2>Chat</h2>
        </div>

        
        <div class="chat_box">
<?php
if (isset($_SESSION['user']) && isset($_GET['chat_with'])) {
    $current_user = $_SESSION['user']['id'];
    $destinataire_id = intval($_GET['chat_with']);

    $sql = "SELECT * FROM message
            WHERE (id_expediteur = ? AND id_destinataire = ?)
               OR (id_expediteur = ? AND id_destinataire = ?)
            ORDER BY datte ASC";
    $stmt = $connect->prepare($sql);
    $stmt->bind_param("iiii", $current_user, $destinataire_id, $destinataire_id, $current_user);
    $stmt->execute();
    $messages = $stmt->get_result();

    while ($msg = $messages->fetch_assoc()) {
        $class = ($msg['id_expediteur'] == $current_user) ? 'send' : 'rec';
        echo '<div class="mess ' . $class . '">';
        if ($class === 'rec') {
            echo '<img src="profile.jpg" alt="">';
        }
        echo '<span>' . htmlspecialchars($msg['contenu']) . '</span>';
        echo '</div>';
    }
}
?>



        </div>

        <div class="chat_input">
        <input type="hidden" name="destinataire_id" id="destinataire_id">
                    <input type="text" name="contenu" id="contenu" placeholder="message" required>
    <button type="submit"><i class="fa-solid fa-paper-plane"></i></button>
</div>

</form>




    <div class="projectproject">
        <div class="scroll projet">
            <div class="image">
                <img src="project6.jpeg" alt="">
            </div>
                <div class="infoprojet">
                <h2>amirouche abdelwadoud</h2>
                <h3>computer science</h3>
                <span>development d'application est de web development d'application est de web development d'application est de web development d'application est de web</span>

                <span>create at 26/04/2025</span>

            </div>
        </div> 
    </div>
<!--
<div class="projectproject" style="">
    <div class="scroll projet">
        <div class="image">
            <img src="pp.png" alt="Project Image" id="popupProjectImage">
        </div>
        <div class="infoprojet">
            <h2 id="popupProjectName">User Name</h2>
            <h3 id="popupProjectTitle">Project Title</h3>
            <span id="popupProjectDescription">Project description goes here...</span>
            <span id="popupProjectDate">Created at: --/--/----</span>
        </div>
        <i id="closeProjectPopup" class="fa-solid fa-xmark" style="position:absolute;top:10px;right:20px;cursor:pointer;color:white;font-size:24px;"></i>
    </div> 
</div>
-->

    <div class="projectproject profile">
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
    
                <h1>amirouche abdelwadoud</h1>
                <h2>computer science</h2>
                <h3>mahammed yahia ben sadik</h3>
               
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
    
                        <h2></h2>
                        <h3></h3>
                        <span></span>
    
                    </div>
                </div>
    
              
               
    
            </div>
    
    
    
    
    
        </div>
    </div>

    <form class="update_information" action="addprojet.php" method="post" enctype="multipart/form-data">            <i class="fa-solid fa-close" id="close" style="display: flex;cursor: pointer; color: white; margin-bottom: 30px; font-size: 20px;"></i>

            <label for="photo" style="color: white;">photo profile</label>
            <input type="file" name="photo_pro" placeholder="chose photo" >
            <input type="text" name="titre" placeholder="titre">
            <input type="text" name="description" placeholder="description">
           

            <button type="submit" > save</button>


        </form>

    <script src="interface1.js"></script>


    <script>
const url = new URL(window.location.href);
if (url.searchParams.has('chat_with')) {
    const commBox = document.querySelector('.comunnication');
    commBox.classList.add('active');
    // Also set the hidden input so your form knows who you're talking to
    const destInput = document.getElementById('destinataire_id');
    destInput.value = url.searchParams.get('chat_with');
}
</script>
</body>

</html>