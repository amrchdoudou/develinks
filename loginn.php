<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
    <link rel="stylesheet" href="login.css">
    <title>Document</title>
</head>
<body>
  <div class="container" id="container">
    <div class="form-container sign-in" id="sign-inn">
        <form action="login.php" method="post">
            <h1>Sign In</h1>
            <div class="social-icons">
                <a href="#" class="icon"><i class="fa-brands fa-google"></i></a>
                <a href="#" class="icon"><i class="fa-brands fa-facebook-f"></i></a>

                <a href="#" class="icon"><i class="fa-brands fa-github"></i></a>
                <a href="#" class="icon"><i class="fa-brands fa-linkedin-in"></i></a>
            </div>
                <span> or use email password </span>
                <input type="email" name="email" placeholder="Email">
                <input type="password" name="password" placeholder="password">
                <a href="#">forget your password</a>
                <button type="submit">sign in</button>
                <span id="h1" style="margin-top: 30px;"></span>
                <button id="buton_up" style="display: none; justify-content: center;">sign up</button>

           
        </form>

    </div>
    <div class="form-container sign-up" id="sign-upp">
        <form action="register.php" method="post">
            <h1>creat acount</h1>
            <div class="social-icons">
                <a href="#" class="icon"><i class="fa-brands fa-google"></i></a>
                <a href="#" class="icon"><i class="fa-brands fa-facebook-f"></i></a>

                <a href="#" class="icon"><i class="fa-brands fa-github"></i></a>
                <a href="#" class="icon"><i class="fa-brands fa-linkedin-in"></i></a>
            </div>
                <span> or use email for registration </span>
                <input type="text" name="name" placeholder="Name">
                <input type="text" name="fullname" placeholder="full Name">
                <input type="email" name="email" placeholder="Email">
                <input type="password" name="password" placeholder="password">
                <button type="submit" >sign up</button>
                <span id="h2" style="margin-top: 30px;"></span>
                <button id="buto" style="display: none; justify-content: center;">sign innnn</button>


            
        </form>

    </div>

        <div class="toggle-panel toggle-left" id="toggle-left" style="">
                <h1 id="h1">Welcome back!</h1>
                <p>enter your personal details to use your site features</p>
                <button class="hidden" id="login">sign in</button>
            </div>
            
            <div class="toggle-panel toggle-right" id="toggle-right" style="">
                <h1 id="h11">hello friend</h1>
                <p>enter your personal details to use your site features</p>
                <button class="hidden" id="register">sign up</button>
            </div>
        

        </div>






    <script src="loginn.js"></script>
</body>
</html>