<?php
    session_start();   
    $_SESSION["CURPAGE"] = "login";
    $_SESSION["LANG"] = "en";
?>

    <!DOCTYPE html>
    <html xmlns="http://www.w3.org/1999/xhtml">

    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

        <!-- Page Title -->
        <title>Login</title>
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
                                $conmsg = "User Name and Password combination is incorrect. Please try again !";
                            else{
                                $_SESSION['uid'] = $uid;
                                header('Location: umain.php');
                            }
                        }
                    ?>
                    
                    <form method="post" action="#">
                        <div class="main_wrapper">
                            <h1><strong>Login</strong> to your account</h1>
                            <div class="sell_box sell_box_1">
                                <div class="input_wrapper large">
                                    <label><span>* </span><strong>User name:</strong></label>
                                    <input type="text" class="txb large" name="uname" required="required" placeholder="test" />
                                </div>
                                <div class="clear"></div>

                                <div class="input_wrapper large">
                                    <label><span>* </span><strong>Password:</strong></label>
                                    <input type="password" class="txb large" name="pwd" required="required" placeholder="1111" />
                                </div>
                                <div class="clear"></div>
                                <strong><font color="#ff6600"><?php echo $conmsg ?></font></strong>    
                            </div>
                            <div class="clear"></div>
                        </div>
                        <div class="sell_submit_wrapper">
                            <strong>Forgot&nbsp;<a href="forgotpwd.php">password ?</a></strong>
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