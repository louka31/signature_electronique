<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>E_signature</title>

    <!-- Font Icon -->
    <link rel="stylesheet" href="fonts/material-icon/css/material-design-iconic-font.min.css">

    <!-- Main css -->
    <link rel="stylesheet" href="css1/style.css">
    <link rel="stylesheet" href="style.css">
    <style>
      input[type=submit] {
        display: inline-block;
        background-color: #bc20bf;
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
        background-color: #f7e094;
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
                        <h2 class="form-title">Modifier dossier de stockage</h2>
                        <form method="post" enctype="multipart/form-data" action="test.php">
                            <div class="form-group">
                                
                                <input name="chemin" type="text" id="chemin" placeholder="Chemin de dossier C:\... " required pattern="(C:\\)[A-Za-z\\]{3,}" >
                            </div>
                           
                            <div class="form-group form-button">
                                
                                <input type="submit" name="upload" id="upload" class="form-submit" value="Modifier"/>
                            </div>
                        </form>
                    </div>
                    <div class="signup-image">
                        <figure><img src="images/dossier.png" alt="sing up image"></figure>
                       
                    </div>
                </div>
            </div>


    <!-- JS -->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="js1/main.js"></script>
</body><!-- This templates was made by Colorlib (https://colorlib.com) -->
</html>
