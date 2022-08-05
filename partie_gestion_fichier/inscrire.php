<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Sign Up Form by Colorlib</title>

    <!-- Font Icon -->
    <link rel="stylesheet" href="fonts/material-icon/css/material-design-iconic-font.min.css">

    <!-- Main css -->
    <link rel="stylesheet" href="css1/style.css">
    <link rel="stylesheet" href="style.css">

</head>
<body>
<br>

            <div class="container">
                <div class="signup-content">
                    <div class="signup-form">
                        <h2 class="form-title">Sign up</h2>
                        <form method="POST" class="register-form" id="register-form" action="inscription2.php">
                            <div class="form-group">
                                <label for="name"><i class="zmdi zmdi-account material-icons-name"></i></label>
                                <input type="text" name="nom" id="nom" placeholder="Your First Name" minlength="3" pattern="[A-Za-z]{3,20}" maxlength="20" title="le champs nom doit contenir au moins 3 lettres"  required />
                            </div>
                            <div class="form-group">
                                <label for="name"><i class="zmdi zmdi-account material-icons-name"></i></label>
                                <input type="text" name="prenom" id="prenom" placeholder="Your Last Name" minlength="3" required pattern="[A-Za-z]{3,20}" title="le champs prenom doit contenir au moins 3 lettres"  />
                            </div>
                            <div class="form-group">
                                <label for="re-pass"><i class="zmdi zmdi-account material-icons-name"></i></label>
                                <input type="password" name="cin" id="cin" placeholder="Your CIN" minlength="8" maxlength="8" required pattern="[0-9]{8}" title="le champs cin doit contenir 8 chiffres"   />
                            </div>
                            <div class="form-group">
                                <label for="email"><i class="zmdi zmdi-email"></i></label>
                                <input type="email" name="email" id="email" placeholder="Your Email" title="email@gct.com.tn" pattern="[a-zA-Z0-9._%+-]+@gct\.com\.tn" required />
                            </div>
                            <div class="form-group">
                                <label for="pass"><i class="zmdi zmdi-lock"></i></label>
                                <input type="password" name="pass" id="pass" placeholder="Password" minlength="6" required pattern="[A-Za-z0-9]{6}" title="le champs nom doit contenir au moins 6lettres"  />
                            </div>
                            <div class="form-group">
                                <label for="re-pass"><i class="zmdi zmdi-lock-outline"></i></label>
                                <input type="password" name="pass1" id="pass1" placeholder="Repeat your password" required />
                            </div>
                            <div class="select-dropdown">
  <select id="secteur" name="secteur" required >
    <option>Choisir votre structure</option>
    <option value="X">X</option>
    <option value="Y" >Y</option>
    <option value="Z" >Z</option>
    
  </select>
                            </div>
                            <div class="form-group form-button">
                                <input type="submit" name="signup" id="signup" class="form-submit" value="Register"/>
                            </div>
                        </form>
                    </div>
                    <div class="signup-image">
                        <figure><img src="images/signup-image.jpg" alt="sing up image"></figure>
                        <a href="login.php" class="signup-image-link">I am already member</a>
                    </div>
                </div>
            </div>


    <!-- JS -->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="js1/main.js"></script>
</body>
</html>