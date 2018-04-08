<?php
    session_start();   
    $_SESSION["CURPAGE"] = "login";
    $_SESSION["LANG"] = "fr";
?>

    <!DOCTYPE html>
    <html xmlns="http://www.w3.org/1999/xhtml">

    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

        <!-- Page Title -->
        <title>S'identifier</title>
        <?php include "../includes/scripts.php"; include "../classes/user.php" ?>

    </head>

    <body class="sell">
        <?php include "../includes/header.php" ?>
        <!--BEGIN CONTENT-->
        <div id="content">
            <div class="content">
                    <?php
                        $conmsg = "";
                        if(isset($_POST['Connect']) && !empty($_POST['uname']) && !empty($_POST['pwd']))
                        {
                            $uid = User::UserExists($_POST['uname'], $_POST['pwd']);
                            if($uid === 0)
                                $conmsg = "La combinaison du nom d'utilisateur et du mot de passe est incorrecte. Veuillez réessayer !";
                            else{
                                $_SESSION['uid'] = $uid;
                                header('Location: umain.php');
                            }
                        }
                    ?>
                    
                    <form method="post" action="#">
                        <div class="main_wrapper">
                            <h1><strong>Connectez</strong>-vous à votre compte</h1>
                            <div class="sell_box sell_box_1">
                                <div class="input_wrapper large">
                                    <label><span>* </span><strong>Nom d'utilisateur:</strong></label>
                                    <input type="text" class="txb large" name="uname" required="required" placeholder="test"/>
                                </div>
                                <div class="clear"></div>

                                <div class="input_wrapper large">
                                    <label><span>* </span><strong>Mot de passe:</strong></label>
                                    <input type="password" class="txb large" name="pwd" required="required" placeholder="1111"/>
                                </div>
                                <div class="clear"></div>
                                <strong><font color="#ff6600"><?php echo $conmsg ?></font></strong>    
                            </div>
                            <div class="clear"></div>
                        </div>
                        <div class="sell_submit_wrapper">
                            <strong>Mot de passe&nbsp;<a href="forgotpwd.php">oublié ?</a></strong>
                            <input type="submit" value="Connect" name="Connect" class="sell_submit" />
                            <div class="clear"></div>
                        </div>
                    </form>
            </div>
        </div>
        <!--EOF CONTENT-->
        <?php include "../includes/footer.php" ?>
    </body>

    </html>