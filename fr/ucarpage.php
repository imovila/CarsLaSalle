<?php 
    session_start(); 
    $_SESSION["CURPAGE"] = "";
    $_SESSION["LANG"] = "fr";

    include "../classes/car.php";
    include "../classes/dictionary.php";
    include "../classes/comment.php";
    include "../classes/rating.php";   
    include "../classes/favorite.php"; 
    include "../classes/file.php";

    $carid = $_REQUEST['carid']; 
    $msg = "";

    //Comment
    if (isset($_POST['submit'])){
        $com = new Comment($carid, $_SESSION['uid'], $_POST['comment']);    
        $msg = $com->Set();
        unset($_POST['submit']);
    }

    //Rating
    if (isset($_POST['rating'])){
        $rat = new Rating($carid, $_SESSION['uid'], $_POST['rating']);    
        $msg = $rat->Set();
        unset($_POST['rating']);
    }

    //Favorite list
    if (isset($_POST['favlist'])){
        $fav = new Favorite($carid, $_SESSION['uid']);    
        $msg = $fav->Set();
        unset($_POST['favlist']);
    }

    $cars = Car::ReadCar($carid);
?>

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <!-- Page Title -->
    <title>Voiture</title>
    <?php include "../includes/scripts.php" ?>

</head>

<body class="car">

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

    <?php include "../includes/uheader.php"; ?>
    <!--BEGIN CONTENT-->
    <?php foreach ($cars as $key => $val){ ?>
    <div id="content">
        <div class="content">
            <div class="breadcrumbs">
                <a href="umain.php">Accueil</a>
                <img src="../images/marker/marker.gif" alt="" />
                <a href="<?php if (isset($_REQUEST['p'])) { if ($_REQUEST['p'] === 'c') echo 'ucarscatalog.php'; else echo 'ucarscataloggrid.php'; } else { echo 'ucarscatalog.php'; $_REQUEST['crt'] = "1=1"; } ?>?crt=<?php echo urlencode($_REQUEST['crt']) ?>">Voitures</a>
                <img src="../images/marker/marker.gif" alt="" />
                <span><?php echo Dict::ReadDicData('dicmake', $val['make'])." ".Dict::ReadDicData('dicmodel', $val['model']) ?></span>
            </div>
            <div class="main_wrapper">
                <div class="cars_id">
                    <div class="id">ID de l'offre <span><?php echo $val['carid'] ?></span></div>
                    <div class="views">
                        <form action="#" method="post">
                            <input type="submit" name="favlist" value="Ajouter à ma liste préférée" class="favbtn btnaddfav" />
                        </form>
                    </div>
                </div>
                <h1><strong><?php echo Dict::ReadDicData('dicmake', $val['make']) ?></strong>
                    <?php echo Dict::ReadDicData('dicmodel', $val['model']) ?>
                </h1>
                <div class="car_image_wrapper car_group">

                    <?php 
                        File::delete_files("../images/tmp/");
                        $pics = Car::ReadPics($val['carid']); $k = 0; $random = 0; $imgno = 0;
                        foreach ($pics as $key => $picval){
                            $path = "../images/tmp/".$imgno.rand(1,1000).".png";
                            file_put_contents($path, base64_decode(base64_encode($picval['pic'])));
                            if ($k == 0) { 
                    ?>

                    <div class="big_image">
                        <a href="<?php echo $path ?>?v=1" class="car_group">
                            <img src="../images/zoom/zoom.png" alt="" class="zoom"/>
                            <img src="data:image/jpeg;base64,<?php echo base64_encode($picval['pic']) ?>" alt=""/>
                        </a>
                    </div>
                    <?php $k++; ?>
                    <div class="small_img">
                        <?php continue; } $path = "../images/tmp/".$imgno.rand(1,1000).".png"; 
                                    file_put_contents($path, base64_decode(base64_encode($picval['pic']))); ?>
                        <a href="<?php echo $path ?>?v=1" class="car_group">
                                        <img src="data:image/jpeg;base64,<?php echo base64_encode($picval['pic']) ?>" alt=""/>
                                    </a>
                        <?php } ?>
                    </div>
                </div>
                <div class="car_characteristics">
                    <div class="price">
                        <?php echo $val['price'] ?> CAD
                        <?php if ($val['oldprice'] > 0) { ?><span style="color: #cc3300; font-weight: bold;">*était&nbsp;<?php echo $val['oldprice'] ?></span>
                        <?php } ?>
                    </div>
                    <div class="clear"></div>
                    <div class="features_table">
                        <div class="line grey_area">
                            <div class="left">Modèle, Type de carrosserie:</div>
                            <div class="right">
                                <?php echo Dict::ReadDicData('dicmake', $val['make'])." ".Dict::ReadDicData('dicmodel', $val['model']) ?>,
                                <?php echo Dict::ReadDicData('dicbody', $val['body']) ?>
                            </div>
                        </div>
                        <div class="line">
                            <div class="left">Fabrication:</div>
                            <div class="right">
                                <?php echo $val['year'] ?>
                            </div>
                        </div>
                        <div class="line grey_area">
                            <div class="left">Carburant:</div>
                            <div class="right">
                                <?php echo Dict::ReadDicData('dicfuel', $val['fuel']) ?>
                            </div>
                        </div>
                        <div class="line">
                            <div class="left">Moteur:</div>
                            <div class="right">
                                <?php echo Dict::ReadDicData('dicengine', $val['engine']) ?>
                            </div>
                        </div>
                        <div class="line grey_area">
                            <div class="left">Transmision:</div>
                            <div class="right">
                                <?php echo Dict::ReadDicData('dictransmission', $val['transmission']) ?>
                            </div>
                        </div>
                        <div class="line">
                            <div class="left">Couleur intérieure:</div>
                            <div class="right">
                                <?php echo Dict::ReadDicData('diccolor', $val['incolor']) ?>
                            </div>
                        </div>
                        <div class="line grey_area">
                            <div class="left">Couleur extérieure:</div>
                            <div class="right">
                                <?php echo Dict::ReadDicData('diccolor', $val['outcolor']) ?>
                            </div>
                        </div>
                        <div class="line">
                            <div class="left">Portes:</div>
                            <div class="right">
                                <?php echo $val['doors'] ?>
                            </div>
                        </div>
                        <div class="line grey_area">
                            <div class="left">Sièges:</div>
                            <div class="right">
                                <?php echo $val['seats'] ?>
                            </div>
                        </div>
                        <div class="line">
                            <div class="left">Transmission secondaire:</div>
                            <div class="right">
                                <?php echo Dict::ReadDicData('dicdrivetrain', $val['drivetrain']) ?>
                            </div>
                        </div>
                        <div class="line grey_area">
                            <div class="left">Kilométrage (km):</div>
                            <div class="right">
                                <?php echo $val['mileage'] ?>
                            </div>
                        </div>
                        <div class="line">
                            <div class="left">Statut:</div>
                            <div class="right"><b>
                                    <?php echo Dict::ReadDicData('diccarstatus', $val['status']) ?></b>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="clear"></div>
                <div class="info_box">
                    <div class="car_info">
                        <div class="info_left">
                            <h2><strong>Informations</strong> sur le véhicule</h2>
                            <p><strong>Caractéristiques:</strong><br/><?php echo $val['features'] ?></p>
                            <p><strong>D'autres paramètres:</strong><br/><?php echo $val['otherparams'] ?></p>
                            <p><strong>Sécurité:</strong><br/><?php echo $val['safety'] ?></p>
                            <p><strong>Confort:</strong><br/><?php echo $val['comfort'] ?></p>
                        </div>
                        <div class="info_right">

                            <?php $com = Comment::Get($carid);
                                if (count($com) > 0){
                                    echo "<h2><strong>Tous</strong> les commentaires ici:</h2><ul>";
                                    foreach ($com as $key => $val){
                                        echo "<li><strong>Utilisateur:</strong>&nbsp;".$val['username']."<br /><strong>Commentaire:</strong>&nbsp;".$val['comment']."</li>";
                                    }
                                    echo "</ul><br />";
                                }
                            ?>
                            <h2><strong>Écrivez</strong> votre commentaire ici</h2>

                            <form action="#" method="post">
                                <input type="hidden" name="carid" value="<?php echo $carid ?>" />
                                <p><textarea rows="6" cols="42" name="comment" style="resize: none;" placeholder="S'il vous plaît ajouter votre commentaire"></textarea>
                                </p>
                                <div class="sell_submit_wrapper">
                                    <input type="submit" value="Send" name="submit" class="sell_submit" />
                                    <div class="clear"></div>
                                </div>
                            </form>
                        </div>
                        <div class="clear"></div>
                    </div>
                </div>
                <div class="ratings">
                    <form action="#" method="post">
                        <fieldset class="rating" <?php $rat=Rating::Get($carid, $_SESSION['uid']); if (isset($rat[0])) echo "disabled='disabled'";?> >
                            <legend>Veuillez évaluer:</legend>
                            <input type="radio" id="star5" name="rating" value="5" <?php if ($rat[0]==5 ) echo "checked='checked'"; ?> onchange="this.form.submit();" /><label for="star5" title="Excellent">5 stars</label>
                            <input type="radio" id="star4" name="rating" value="4" <?php if ($rat[0]==4 ) echo "checked='checked'"; ?> onchange="this.form.submit();" /><label for="star4" title="Bien">4 stars</label>
                            <input type="radio" id="star3" name="rating" value="3" <?php if ($rat[0]==3 ) echo "checked='checked'"; ?> onchange="this.form.submit();" /><label for="star3" title="Moyenne">3 stars</label>
                            <input type="radio" id="star2" name="rating" value="2" <?php if ($rat[0]==2 ) echo "checked='checked'"; ?> onchange="this.form.submit();" /><label for="star2" title="Équitable">2 stars</label>
                            <input type="radio" id="star1" name="rating" value="1" <?php if ($rat[0]==1 ) echo "checked='checked'"; ?> onchange="this.form.submit();" /><label for="star1" title="Faible">1 star</label>
                        </fieldset>
                    </form>
                </div>

            </div>
            <div class="clear"></div>
        </div>
    </div>
    <?php } ?>
    <!--EOF CONTENT-->
    <?php include "../includes/footer.php" ?>
</body>

</html>
