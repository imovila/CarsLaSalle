<!--BEGIN FOOTER-->
<div id="footer">
    <div class="bg_top_footer">
        <div class="top_footer">
            <div class="f_widget first">
                <h3><strong><?php if ($_SESSION["LANG"] == "fr") echo "À propos"; else echo "About"?></strong>
                    <?php if ($_SESSION["LANG"] == "fr") echo " de nous"; else echo " us"?>
                </h3>
                <a href="#" class="footer_logo">CarsLasalle</a><br/>
                <?php if ($_SESSION["LANG"] == "fr") echo "Retrouvez ici le plus grand choix de voitures neuves et usagées.<br/>
                Des milliers de voitures de toutes marques disponibles au meilleur prix."; else echo "Find the largest selection of new and used cars here. <br/>
                 Thousands of cars of all brands available at the best price."?>
            </div>
            <div class="f_widget divide second">
                <h3><strong><?php if ($_SESSION["LANG"] == "fr") echo "Heures"; else echo "Open"?></strong>
                    <?php if ($_SESSION["LANG"] == "fr") echo " d'ouverture"; else echo " hours"?>
                </h3>
                <ul class="schedule">
                    <li>
                        <strong><?php if ($_SESSION["LANG"] == "fr") echo "Lundi"; else echo "Monday"?></strong>
                        <span>9:30 am - 6:00 pm</span>
                    </li>
                    <li>
                        <strong><?php if ($_SESSION["LANG"] == "fr") echo "Mardi"; else echo "Tuesday"?></strong>
                        <span>9:30 am - 6:00 pm</span>
                    </li>
                    <li>
                        <strong><?php if ($_SESSION["LANG"] == "fr") echo "Mercredi"; else echo "Wednesday"?></strong>
                        <span>9:30 am - 6:00 pm</span>
                    </li>
                    <li>
                        <strong><?php if ($_SESSION["LANG"] == "fr") echo "Jeudi"; else echo "Thursday"?></strong>
                        <span>9:30 am - 6:00 pm</span>
                    </li>
                    <li>
                        <strong><?php if ($_SESSION["LANG"] == "fr") echo "Vendredi"; else echo "Friday"?></strong>
                        <span>9:30 am - 6:00 pm</span>
                    </li>
                    <li>
                        <strong><?php if ($_SESSION["LANG"] == "fr") echo "Samedi"; else echo "Saturday"?></strong>
                        <span>9:30 am - 4:00 pm</span>
                    </li>
                    <li>
                        <strong><?php if ($_SESSION["LANG"] == "fr") echo "Dimanche"; else echo "Sunday"?></strong>
                        <span><?php if ($_SESSION["LANG"] == "fr") echo "fermé"; else echo "closed"?></span>
                    </li>
                </ul>
            </div>
            <div class="fwidget_separator"></div>
            <div class="f_widget third">
                <h3><strong><?php if ($_SESSION["LANG"] == "fr") echo "Nos"; else echo "Our"?></strong> contacts</h3>
                <div class="f_contact f_contact_1"><strong>
                    <?php if ($_SESSION["LANG"] == "fr") echo "Adresse Infos:"; else echo "Address Info:"?>
                    <br/></strong>
                    <?php if ($_SESSION["LANG"] == "fr") echo "2000 Rue Sainte-Catherine O, Montréal, QC H3H 2T3"; 
                        else echo "2000, Sainte-Catherine Street West Montréal, Québec H3H 2T3"?>
                </div>
                <div class="f_contact f_contact_2"><strong><?php if ($_SESSION["LANG"] == "fr") echo "Téléphone:"; else echo "Phone:"?></strong> +1 (777) 777-7777 <br/><strong>FAX:</strong> +1 (777) 888-8888</div>
                <div class="f_contact f_contact_3"><strong>Email:</strong> <a href="mailto:#">carslasalle@carslasalle.abc</a></div>
            </div>

        </div>
    </div>
    <div class="copyright_wrapper">
        <div class="copyright">&copy; 2018 CarsLasalle<br/>
            <?php if ($_SESSION["LANG"] == "fr") echo "Développé par Ion Movila"; else echo "Developed by Ion Movila"?>
        </div>
    </div>
</div>
<!--EOF FOOTER-->
