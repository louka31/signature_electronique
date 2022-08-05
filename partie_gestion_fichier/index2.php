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
    <style>
      input[type=submit] {
        display: inline-block;
        background-color: #5cc6ce;
        border-radius: 10px;
        border: 2px double #cccccc;
        color: #ffffff;
        text-align: center;
        font-size: 23px;
        padding: 20px;
        width: 150px;
        transition: all 0.5s;
        cursor: pointer;
        margin: 5px;
      }
      input[type=submit] span {
        cursor: pointer;
        display: inline-block;
        position: centers;
        transition: 0.5s;
      }
      input[type=submit] span:after {
        content: "\00bb";
        position: absolute;
        opacity: 0;
        top: 0;
        right: -20px;
        transition: 0.5s;
      }
      input[type=submit]:hover {
        background-color: #db7267;
      }
      input[type=submit]:hover span {
        padding-right: 25px;
      }
      input[type=submit]:hover span:after {
        opacity: 1;
        right: 0;
      }
    </style>
</head>
<body>
<br>

            <div class="container">
                <div class="signup-content">
                    <div class="signup-form">
                        <h2 class="form-title">Nouveau structure</h2>
                        <form method="post" enctype="multipart/form-data" action="pages/ajoutersecteur.php">
                            <div class="form-group">
                                
                                <input name="sec" type="text" id="sec" placeholder="Nom structure" />
                            </div>
                           
                            <div class="form-group form-button">
                                
                                <input type="submit" name="upload" id="upload" class="form-submit" value="Ajouter"/>
                            </div>
                        </form>
                    </div>
                    <div class="signup-image">
                        <figure><img src="images/elec.jpg" alt="sing up image"></figure>
                       
                    </div>
                </div>
            </div>


    <!-- JS -->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="js1/main.js"></script>
</body>
</html>
