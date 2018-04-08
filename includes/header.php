<!--BEGIN HEADER-->
<div id="header">
    <div class="top_info">
        <div class="logo">
            <a href="#">Cars<span>Lasalle</span></a>
        </div>
        <div class="header_contacts">
            <div class="phone">+1 (777) 777-7777</div>
            <div> <?php if ($_SESSION["LANG"] == "fr") echo "2000 Rue Sainte-Catherine O, Montréal, QC, H3H 2T3"; 
                        else echo "2000, Sainte-Catherine Street W, Montréal, QC, H3H 2T3"?></div>
        </div>
        <div class="socials">
            <a href="../en/main.php" style="margin-right: 35px;">
                    <img src="../images/lang/eng.png" />English
                </a>
            <a href="../fr/main.php" style="margin-right: 5px;">
                    <img src="../images/lang/fr.png" />Français
                </a>
        </div>
    </div>
    <div class="bg_navigation">
        <div class="navigation_wrapper">
            <div id="navigation">
                <span>Home</span>
                
                <ul>
                    <li <?php if ($_SESSION["CURPAGE"] == 'index') echo 'class="current"' ?> ><a href="main.php">
                       <?php if ($_SESSION["LANG"] == "fr") echo "Accueil"; else echo "Home"?></a></li>
                    <li <?php if ($_SESSION["CURPAGE"] == 'register') echo 'class="current"' ?>><a href="register.php">
                        <?php if ($_SESSION["LANG"] == "fr") echo "Créer un compte"; else echo "Register"?></a></li>
                    <li <?php if ($_SESSION["CURPAGE"] == 'login') echo 'class="current"' ?> ><a href="login.php">
                        <?php if ($_SESSION["LANG"] == "fr") echo "Connexion"; else echo "Login"?></a></li>
                    <li <?php if ($_SESSION["CURPAGE"] == 'contacts') echo 'class="current"' ?> ><a href="contacts.php">Contacts</a></li>
                </ul>
            </div>
        </div>
    </div>
</div>
<!--EOF HEADER-->
