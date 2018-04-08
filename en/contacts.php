<?php 
    $_SESSION["CURPAGE"] = "contacts";
    $_SESSION["LANG"] = "en";

    include "../classes/message.php";

    $msg = "";

    //Message - Send
    if (isset($_POST['submit'])){
        $mes = new Message($_POST['name'],$_POST['email'],$_POST['tel'],$_POST['message']);
        $msg = $mes->Set();
        unset($_POST['submit']);
    }

?>

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

    <!-- Page Title -->
    <title>Contacts</title>
    <?php include "../includes/scripts.php" ?>
</head>

<body class="contacts">
   
  <?php if (!empty($msg)) { ?>
    <div class="alert success">
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
            <div class="main_wrapper">
                <h1><strong>Contact</strong></h1>
                <div class="contacts_box">
                    <div class="left">
                        <h3><strong>Contact</strong> details</h3>
                        <div class="addr detail">2000, Sainte-Catherine Street W, Montréal, QC, H3H 2T3</div>
                        <div class="phones detail">+1 (777) 777-7777<br/>+1 (777) 888-8888</div>
                        <div class="email detail single_line"><a href="mailto:#" class="markered">carslasalle@carslasalle.abc</a></div>
                        <div class="web detail single_line"><a href="#">http://www.carslasalle.abc</a></div>
                    </div>
                    <div class="map">
                        <iframe width="668" height="288" src="https://www.google.com/maps/embed/v1/place?q=2000%20Rue%20Sainte-Catherine%20O%2C%20Montr%C3%A9al%20QC%20H3H%202T3&key=AIzaSyBR135dx-k0FDUnw7xpuhzJK9QmpKWyGW0" frameborder="0"></iframe>
                    </div>
                </div>
                <div class="contact_form">
                    <h2><strong>Drop</strong> us a line</h2>

                    <form method="post" action="#">
                        <div class="fld_box">
                            <label>Full name: </label>
                            <input type="text" name="name" required="required"/>
                        </div>
                        <div class="fld_box center">
                            <label>E-mail: </label>
                            <input type="email" name="email" required="required" />
                        </div>
                        <div class="fld_box last">
                            <label>Phone: </label>
                            <input type="tel" name="tel" value="" />
                        </div>
                        <div class="clear"></div>
                        <label>Message: </label>
                        <textarea cols="20" rows="20" name="message" required="required"></textarea>
                        <div class="sell_submit_wrapper">
                            <input type="submit" name="submit" value="submit" class="sell_submit" />
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
    <!--EOF CONTENT-->
    <?php include "../includes/footer.php" ?>
</body>

</html>
