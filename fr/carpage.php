<?php
    $_SESSION["CURPAGE"] = "";
    $_SESSION["LANG"] = "fr";
    include "../classes/car.php";
    include "../classes/dictionary.php";
    include "../classes/file.php";

    $cars = Car::ReadCar($_GET['carid']);
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
        <?php include "../includes/header.php"; ?>
        <!--BEGIN CONTENT-->
        <?php foreach ($cars as $key => $val){ ?>
        <div id="content">
            <div class="content">
                <div class="breadcrumbs">
                    <a href="main.php">Accueil</a>
                    <img src="../images/marker/marker.gif" alt="" />
                    <a href="<?php if (isset($_REQUEST['p'])) { if ($_REQUEST['p'] === 'c') echo 'carscatalog.php'; else echo 'carscataloggrid.php'; } else { echo 'carscatalog.php'; $_REQUEST['crt'] = "1=1"; } ?>?crt=<?php echo urlencode($_REQUEST['crt']) ?>">Voitures</a>
                    <img src="../images/marker/marker.gif" alt="" />
                    <span><?php echo Dict::ReadDicData('dicmake', $val['make'])." ".Dict::ReadDicData('dicmodel', $val['model']) ?></span>
                </div>
                <div class="main_wrapper">
                    <div class="cars_id">
                        <div class="id">ID de l'offre <span><?php echo $val['carid'] ?></span></div>
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
                                if ($k == 0) { ?>
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
                            </div>
                            <div class="clear"></div>
                        </div>
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