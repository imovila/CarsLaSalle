<?php
    session_start(); 
    $_SESSION["CURPAGE"] = "index";
    $_SESSION["LANG"] = "fr";

    include "../classes/car.php"; 
    include "../classes/dictionary.php";
     
    //Model
    if(isset($_REQUEST['makeid'])){
        $rez = "<option value='0'>Tout</option>";
        foreach (Dict::GetModel($_REQUEST['makeid']) as $val)
            $rez .= "<option value='".$val['id']."'>".$val['name']."</option>";
        echo $rez;
        exit();
    }
?>

    <!DOCTYPE html>
    <html xmlns="http://www.w3.org/1999/xhtml">

    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

        <!-- Page Title -->
        <title>CarsLasalle - Accueil</title>
        <?php include "../includes/scripts.php" ?>

    </head>

    <body class="page">
        <?php include "../includes/uheader.php"; ?>
        <!--BEGIN CONTENT-->
        <div id="content">
            <div class="content">
                <div class="wrapper_1">
                    <div class="slider_wrapper">
                        <div class="home_slider">
                            <div class="slider slider_1">
                                <?php
                                    $cars = Car::ReadRecentlyCars();
                                    foreach ($cars as $key => $val){
                                        $carid = $val['carid'];                                     
                                        echo "<div class=\"slide\"><a href=\"ucarpage.php?carid=$carid\">".
                                             "<img src=\"data:image/jpeg;base64,".base64_encode(Car::ReadPic($carid))."\" /></a>"
                                             ."<div class=\"description\">"
                                             ."<h2 class=\"title\">".$val['year']." ".Dict::ReadDicData('dicmake', $val['make'])
                                             ." ".Dict::ReadDicData('dicmodel', $val['model'])."</h2>"
                                             ."<p class=\"desc\"><span><strong>Miles: </strong>".$val['mileage']."</span><span><strong>Moteur: </strong>"
                                             .Dict::ReadDicData('dicengine', $val['engine'])."</span></p>"."<div class=\"price\">CAD ".$val['price']
                                             ." ".($val['oldprice'] >0 ? "<del style=\"font-size: 14px; color:red\">".$val['oldprice']."</del>" : "")."</div>"
                                             ."</div></div>";
                                    }
                                ?>
                            </div>
                        </div>
                    </div>
                    <div class="search_auto_wrapper">

                        <form method="post" action="ucarscatalog.php">
                            <div class="search_auto">
                                <h3><strong>Chercher</strong> auto</h3>
                                <div class="clear"></div>
 
                                <script>
                                    function getModel(val) {
                                        var xmlhttp = new XMLHttpRequest();
                                        xmlhttp.onreadystatechange = function r() {
                                            if (this.readyState == 4 && this.status == 200) {
                                                document.getElementById("model").innerHTML = this.responseText;
                                            }
                                        };
                                        xmlhttp.open("GET", "umain.php?makeid=" + val, true);
                                        xmlhttp.send();
                                    }
                                </script>
                               
                                <label><strong>Fabricant:</strong></label>
                                <div class="select_box_1">
                                    <select class="select_1" name="make" id="make" onchange="getModel(this.value);">
                                           <option value="0">Tout</option>
                                           <?php $dic = Dict::GetData('dicmake');
                                                foreach ($dic as $val)
                                                    echo "<option value='".$val['id']."'>".$val['name']."</option>";
                                            ?>
                                    </select>
                                </div>

                                <label><strong>Modèle:</strong></label>
                                <div class="select_box_1">
                                    <select id="model" name="model" style="width: 259px; border-radius: 0; padding: 6px; color: #8B9EAE">
                                     <option value='0'>Tout</option>
								    </select>
                                </div>

                                <label><strong>Type de carrosserie:</strong></label>
                                <div class="select_box_1">
                                    <select class="select_3" id="body" name="body">
                                       <option value="0">Tout</option>
                                       <?php $dic = Dict::GetData('dicbody');
                                            foreach ($dic as $val)
                                                echo "<option value='".$val['id']."'>".$val['name']."</option>";
                                        ?>
								    </select>
                                </div>

                                <label><strong>Année:</strong></label>
                                <div class="select_box_2">
                                    <select class="select_4" id="yearfrom" name="yearfrom">
                                        <option value="0">De</option>
                                        <option value="2018">2018</option>
                                        <option value="2017">2017</option>
                                        <option value="2016">2016</option>
                                        <option value="2015">2015</option>
                                        <option value="2014">2014</option>
                                        <option value="2013">2013</option>
                                        <option value="2012">2012</option>
                                        <option value="2011">2011</option>
                                        <option value="2010">2010</option>
                                        <option value="2009">2009</option>
                                        <option value="2008">2008</option>
								    </select>
                                    <select class="select_4" id="yearto" name="yearto">
                                        <option value="0">À</option>
                                        <option value="2018">2018</option>
                                        <option value="2017">2017</option>
                                        <option value="2016">2016</option>
                                        <option value="2015">2015</option>
                                        <option value="2014">2014</option>
                                        <option value="2013">2013</option>
                                        <option value="2012">2012</option>
                                        <option value="2011">2011</option>
                                        <option value="2010">2010</option>
                                        <option value="2009">2009</option>
                                        <option value="2008">2008</option>
								    </select>
                                    <div class="clear"></div>
                                </div>
                                <label><strong>Prix:</strong></label>
                                <div class="select_box_2">
                                    <select class="select_4" id="pricefrom" name="pricefrom">
                                        <option value="0">De</option>
                                        <option value="2000">2000</option>
                                        <option value="5000">5000</option>
                                        <option value="7000">7000</option>
                                        <option value="9000">9000</option>
                                        <option value="11000">11000</option>
                                        <option value="13000">13000</option>
                                        <option value="15000">15000</option>
                                        <option value="20000">20000</option>
                                        <option value="30000">30000</option>
                                        <option value="40000">40000</option>																		
                                        <option value="60000">60000</option>
                                        <option value="100000">100000</option>
								    </select>
                                    <select class="select_4" id="priceto" name="priceto">
                                        <option value="0">À</option>
                                        <option value="2000">2000</option>
                                        <option value="5000">5000</option>
                                        <option value="7000">7000</option>
                                        <option value="9000">9000</option>
                                        <option value="11000">11000</option>
                                        <option value="13000">13000</option>
                                        <option value="15000">15000</option>
                                        <option value="20000">20000</option>
                                        <option value="30000">30000</option>
                                        <option value="40000">40000</option>																		
                                        <option value="60000">60000</option>
                                        <option value="100000">100000</option>
								    </select>
                                    <div class="clear"></div>
                                </div>
                                <label><strong>Kilométrage:</strong></label>
                                <div class="select_box_2">
                                    <select class="select_4" id="mileagefrom" name="mileagefrom">
                                        <option value="-1">De</option>
                                        <option value="0">0</option>
                                        <option value="5000">5000</option>
                                        <option value="10000">10000</option>
                                        <option value="20000">20000</option>
                                        <option value="40000">40000</option>
                                        <option value="80000">80000</option>
                                        <option value="120000">120000</option>
                                        <option value="200000">200000</option>																	
								    </select>
                                    <select class="select_4" id="mileageto" name="mileageto">
                                        <option value="-1">À</option>
                                        <option value="0">0</option>
                                        <option value="5000">5000</option>
                                        <option value="10000">10000</option>
                                        <option value="20000">20000</option>
                                        <option value="40000">40000</option>
                                        <option value="80000">80000</option>
                                        <option value="120000">120000</option>
                                        <option value="200000">200000</option>	
								    </select>
                                    <div class="clear"></div>
                                </div>
                                <div class="chb_wrapper">
                                    <input type="checkbox" name="newcar"/>
                                    <label class="check_label">Seulement les nouvelles voitures</label>
                                </div>
                                <input type="submit" value="Chercher" class="btn_search" />
                                <div class="clear"></div>
                            </div>
                        </form>

                    </div>
                    <div class="clear"></div>
                </div>
                <div class="recent">
                    <h2><strong>Annonces</strong> récentes</h2>
                    <div class="recent_carousel">

                    <?php
                        $cars = Car::ReadRecentlyCars();
                        foreach ($cars as $key => $val){
                            $carid = $val['carid'];                                     
                            echo "<div class=\"slide\"><a href=\"#\"><img src=\"data:image/jpeg;base64,".base64_encode(Car::ReadPic($carid))."\" /></a>"
                                 ."<div class=\"description\">Immatriculation ".$val['year']."<br />Moteur ".Dict::ReadDicData('dicengine', $val['engine'])
                                 ."<br />Kilométrage ".$val['mileage']." km</div><div class=\"title\">".Dict::ReadDicData('dicmake', $val['make'])." "
                                 .Dict::ReadDicData('dicmodel', $val['model'])."<span class=\"price\">".$val['price']." CAD</span></div></a></div>";
                        }
                    ?>
                   
                    </div>
                </div>
                <div class="wrapper_2">
                    <div>
                        <div class="video_box">
                            <h2><strong>Vidéo</strong> voitures de luxe</h2>
                            <div class="post_block">
                                <div class="preview">
                                    <a href="https://player.vimeo.com/video/86619209">
										<img src="../images/car/phantom.jpg" alt=""/>
										<span class="hover"></span>
										<img src="../images/video/video_play.png" alt="" class="video_play"/>
									</a>
                                </div>
                                <h5><a href="https://goo.gl/A9o5SU">Rolls-Royce Phantom. Le benchmark ultra-luxe.</a></h5>
                                <div class="post">
                                    <p>02 min 29 sec</p>
                                </div>
                            </div>
                            <div class="post_block">
                                <div class="preview">
                                    <a href="https://player.vimeo.com/video/178678917">
										<img src="../images/car/MercedesMaybach.jpg" alt=""/>
										<span class="hover"></span>
										<img src="../images/video/video_play.png" alt="" class="video_play"/>
									</a>
                                </div>
                                <h5><a href="https://goo.gl/7orGoh">Mercedes-Maybach. Présence indubitable.</a></h5>
                                <div class="post">
                                    <p>59 sec</p>
                                </div>
                            </div>
                            <div class="post_block">
                                <div class="preview">
                                    <a href="https://player.vimeo.com/video/61213392">
										<img src="../images/car/bugatti.jpg" alt=""/>
										<span class="hover"></span>
										<img src="../images/video/video_play.png" alt="" class="video_play"/>
									</a>
                                </div>
                                <h5><a href="https://goo.gl/245b9m">Bugatti Veyron. Versions Super Sport.</a></h5>
                                <div class="post">
                                    <p>55 sec</p>
                                </div>
                            </div>
                            <div class="post_block last">
                                <div class="preview">
                                    <a href="http://player.vimeo.com/video/143993091">
										<img src="../images/car/mclaren.jpg" alt=""/>
										<span class="hover"></span>
										<img src="../images/video/video_play.png" alt="" class="video_play"/>
									</a>
                                </div>
                                <h5><a href="https://goo.gl/rWuQU">McLaren - Défier l'impossible</a></h5>
                                <div class="post">
                                    <p>01 min 05 sec</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="clear"></div>
                </div>
            </div>
        </div>
        <!--EOF CONTENT-->
        <?php include "../includes/footer.php" ?>
    </body>

    </html>
