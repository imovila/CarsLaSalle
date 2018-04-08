<?php
    $_SESSION["CURPAGE"] = "register";
    $_SESSION["LANG"] = "fr";

    include "../classes/user.php";

    $msg = $name = $pwd = $email = "";
    //Reg
    if (isset($_POST['submit'])){
        if (isset($_POST['term'])){
            $user = new User($_POST['uname'], $_POST['pwd'], $_POST['email']);
            $msg = $user->Save();
            unset($_POST['submit']);
        }    
        else {
            $msg = "0Veuillez accepter les termes et conditions";
            $name = $_POST['uname']; $pwd = $_POST['pwd']; $email = $_POST['email'];
        }
    }
?>

    <!DOCTYPE html>
    <html xmlns="http://www.w3.org/1999/xhtml">

    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

        <!-- Page Title -->
        <title>S'enregistrer</title>
        <?php include "../includes/scripts.php" ?>

    </head>

    <body class="sell">
        
        <?php if (!empty($msg)) { ?>
        <div class="<?php if (substr($msg, 0, 1) == '0'){ $msg = substr($msg, 1); echo 'alert warning'; } else echo 'alert success';?>">
            <span class="closebtn">&times;</span>
            <strong>Information: </strong>
            <?php echo $msg; unset($msg); ?>
        </div>
        <?php } ?>

        <script>
            var close = document.getElementsByClassName("closebtn");
            var i;

            for (i = 0; i < close.length; i++) {
                close[i].onclick = function() {
                    var div = this.parentElement;
                    div.style.opacity = "0";
                    setTimeout(function() {
                        div.style.display = "none";
                    }, 600);
                }
            }
        </script>        
               
        <?php include "../includes/header.php" ?>
        <!--BEGIN CONTENT-->
        <div id="content">
            <div class="content">
               
                <form method="post" action="#">
                    <div class="sell_box sell_box_5">
                        <br/>
                        <h2><strong>Créer</strong> votre <strong>CarsLasalle</strong> compte</h2>
                        <p align="center" style="margin-bottom: 15px;">Merci de remplir ce formulaire pour créer un compte.</p>
                        <div class="input_wrapper">
                            <label><span>* </span><strong>Nom d'utilisateur: </strong></label>
                            <input type="text" class="txb" name="uname" value="<?php echo $name; ?>" required="required" />
                        </div>
                        <div class="input_wrapper">
                            <label><span>* </span><strong>E-mail: </strong></label>
                            <input type="email" class="txb"  value="<?php echo $email; ?>" name="email" required="required" />
                        </div>
                        <div class="input_wrapper last">
                            <label><span>* </span><strong>Mot de passe:</strong></label>
                            <input type="password" class="txb" value="<?php echo $pwd; ?>" name="pwd" required="required" />
                        </div>
                        <div class="clear"></div>
                    </div>
                    <div class="sell_submit_wrapper">
                        <span class="custom_chb_wrapper fL">
							<span class="custom_chb">
								<input type="checkbox" name="term"/>
							</span>
                        <label>J'accepte les termes et conditions</label>
                        </span>
                        <input type="submit" name="submit" value="Submit" class="sell_submit" />
                        <div class="clear"></div>
                    </div>

                </form>
            </div>
        </div>
        <!--EOF CONTENT-->
        <?php include "../includes/footer.php" ?>
    </body>

    </html>
