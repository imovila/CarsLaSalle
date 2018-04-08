<?php
    $_SESSION["CURPAGE"] = "login";
    $_SESSION["LANG"] = "en";

    include "../classes/user.php";

    $msg = "";
    //Change PWD
    if (isset($_POST['submit'])){
        $msg = User::UpdPwd($_POST['email'], $_POST['pwd']);
        unset($_POST['submit']);
    }
?>

    <!DOCTYPE html>
    <html xmlns="http://www.w3.org/1999/xhtml">

    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

        <!-- Page Title -->
        <title>Forgot password</title>
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
                <div class="breadcrumbs">
                    <a href="login.php">Login</a>
                    <img src="../images/marker/marker.gif" alt="" />
                    <span>Forgot password</span>
                </div>

                <form action="#" method="post">
                    <div class="main_wrapper">
                        <h1><strong>Reset</strong> your password</h1>
                        <div class="sell_box sell_box_1">

                            <div class="input_wrapper large">
                                <label><span>* </span><strong>E-mail:</strong></label>
                                <input type="email" name="email" class="txb large" required="required" />
                            </div>
                            <div class="clear"></div>

                            <div class="input_wrapper large">
                                <label><span>* </span><strong>New Password:</strong></label>
                                <input type="password" name="pwd" class="txb large" required="required" />
                            </div>
                            <div class="clear"></div>

                        </div>
                        <div class="clear"></div>
                    </div>
                    <div class="sell_submit_wrapper">
                        <input type="submit" name="submit" value="Reset" class="sell_submit" />
                        <div class="clear"></div>
                    </div>
                </form>

            </div>
        </div>
        <!--EOF CONTENT-->
        <?php include "../includes/footer.php" ?>
    </body>

    </html>
