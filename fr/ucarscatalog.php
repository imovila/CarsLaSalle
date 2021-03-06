<?php 
    $_SESSION["CURPAGE"] = "";
    $_SESSION["LANG"] = "fr";

    include "../classes/car.php"; 
    include "../classes/dictionary.php";
    include "../classes/sorting.php";

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
    <title>Catalogue</title>
    <?php include "../includes/scripts.php"; ?>

</head>

<body class="catalog catalog-list">
    <?php include "../includes/uheader.php"; ?>
    <!--BEGIN CONTENT-->
    <?php 
    
        if (!isset($_REQUEST['crt'])){
            $crt = "";
            $criteria = "";
            if($_POST['make']>0)
                $criteria .= 'make='.$_POST['make'];
            if($_POST['model']>0)
                $criteria .= (strlen($criteria) === 0 ? "" : " and ")."model=".$_POST['model'];
            if($_POST['body']>0)
                $criteria .= (strlen($criteria) === 0 ? "" : " and ")."body=".$_POST['body'];   
            if($_POST['yearfrom']>0 && $_POST['yearto']>0)
                $criteria .= (strlen($criteria) === 0 ? "" : " and ")."year between ".$_POST['yearfrom']." and ".$_POST['yearto'];   
            if($_POST['yearfrom']>0 && $_POST['yearto']==0)
                $criteria .= (strlen($criteria) === 0 ? "" : " and ")."year >= ".$_POST['yearfrom'];           
            if($_POST['yearfrom']==0 && $_POST['yearto']>0)
                $criteria .= (strlen($criteria) === 0 ? "" : " and ")."year <= ".$_POST['yearto'];       
            if($_POST['pricefrom']>0 && $_POST['priceto']>0)
                $criteria .= (strlen($criteria) === 0 ? "" : " and ")."price between ".$_POST['pricefrom']." and ".$_POST['priceto'];   
            if($_POST['pricefrom']>0 && $_POST['priceto']==0)
                $criteria .= (strlen($criteria) === 0 ? "" : " and ")."price >= ".$_POST['pricefrom'];           
            if($_POST['pricefrom']==0 && $_POST['priceto']>0)
                $criteria .= (strlen($criteria) === 0 ? "" : " and ")."price <= ".$_POST['priceto'];       
            if($_POST['mileagefrom']>-1 && $_POST['mileageto']>-1)
                $criteria .= (strlen($criteria) === 0 ? "" : " and ")."mileage between ".$_POST['mileagefrom']." and ".$_POST['mileageto'];   
            if($_POST['mileagefrom']>-1 && $_POST['mileageto']==-1)
                $criteria .= (strlen($criteria) === 0 ? "" : " and ")."mileage >= ".$_POST['mileagefrom'];           
            if($_POST['mileagefrom']==-1 && $_POST['mileageto']>-1)
                $criteria .= (strlen($criteria) === 0 ? "" : " and ")."mileage <= ".$_POST['mileageto'];       
            if (isset($_POST['newcar']))
                $criteria .= (strlen($criteria) === 0 ? "" : " and ")."status = 2"; 
            $crt = strlen($criteria) === 0 ? "1=1" : $criteria;
            $cars = Car::ReadCarWithCriteria($crt);
        }
        else{
            $cars = Car::ReadCarWithCriteria($_REQUEST['crt']);
            $crt = $_REQUEST['crt']; 
            unset($_REQUEST['crt']);
        }

    
        //Sorting
        $sel = 0; $opt = 0;
        if(isset($_POST["option"])){
            $sel = $_POST["sort"];
            $opt = $_POST["option"];
            switch($sel){
                case 1: switch($opt){
                            case 1:
                                    Sorting::sortAsc($cars, 'price');
                                    break;
                            case 2:
                                    Sorting::sortDesc($cars, 'price');
                                    break;
                        }
                        break;
                case 2: switch($opt){
                            case 1:
                                    Sorting::sortAsc($cars, 'year');
                                    break;
                            case 2:
                                    Sorting::sortDesc($cars, 'year');
                                    break;
                        }
                        break;
                case 3: switch($opt){
                            case 1:
                                    Sorting::sortAsc($cars, 'mileage');
                                    break;
                            case 2:
                                    Sorting::sortDesc($cars, 'mileage');
                                    break;
                        }
                        break;
                case 4: switch($opt){
                            case 1:
                                    Sorting::sortAsc($cars, 'make');
                                    break;
                            case 2:
                                    Sorting::sortDesc($cars, 'make');
                                    break;
                        }
                        break;
            }
        }
    
    ?>
    <div id="content">
        <div class="content">
            <div class="breadcrumbs">
                <a href="umain.php">Accueil</a>
                <img src="../images/marker/marker.gif" alt="" />
                <span>Voitures</span>
            </div>
            <div class="main_wrapper">
                <h1><strong>Voitures</strong> (<?php echo count($cars) ?> résultats)</h1>
                <div class="catalog_sidebar">

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
                                        xmlhttp.open("GET", "ucarscatalog.php?makeid=" + val, true);
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
                                <select id="model" name="model" style="width: 180px; border-radius: 0; padding: 6px; color: #8B9EAE">
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
                        <div class="clear"></div>
                    </form>
                </div>
            </div>
            <div class="main_catalog">
                <div class="top_catalog_box">
                    <div class="switch">
                        <span class="table_view"></span>
                        <a href="ucarscataloggrid.php?crt=<?php echo urlencode($crt); ?>" class="list_view"></a>
                    </div>

                    <script>
                        function modOption1(){
                            document.getElementById("option").options.selectedIndex = 0;
                        }
                    </script>
                    
                    <script>
                        function modOption2(){
                            if (document.getElementById("sort").options.selectedIndex === 0 && 
                                document.getElementById("option").options.selectedIndex != 0)
                                document.getElementById("sort").options.selectedIndex = 1;
                            if (document.getElementById("option").options.selectedIndex === 0 && 
                                document.getElementById("sort").options.selectedIndex != 0)
                                document.getElementById("sort").options.selectedIndex = 0;
                        }
                    </script>                     

                    <form action="ucarscatalog.php?crt=<?php echo urlencode($crt); ?>" method="post">
                        <div class="sorting drop_list">
                            <strong>Trier par: </strong>
                            <div class="selected">
                                <select style="margin: 5px 10px; border-radius: 50px 20px; padding-left: 10px;" id="sort" name="sort" onchange="modOption1();">
                                    <option value="0" <?php if($sel == 0)echo "selected" ?>>Non trié</option>
                                    <option value="1" <?php if($sel == 1)echo "selected" ?>>Prix</option>
                                    <option value="2" <?php if($sel == 2)echo "selected" ?>>Année</option>
                                    <option value="3" <?php if($sel == 3)echo "selected" ?>>Kilométrage</option>
                                    <option value="4" <?php if($sel == 4)echo "selected" ?>>Marque</option>
                                </select>
                            </div>
                            <div class="clear"></div>
                        </div>
                        <div class="sorting drop_list">
                            <strong>Options: </strong>
                            <div class="selected">
                                <select style="margin: 5px 10px; border-radius: 50px 20px; padding-left: 10px;" id="option" name="option" onchange = "modOption2(); this.form.submit();">
                                    <option value="0" <?php if($opt == 0)echo "selected" ?>>Non séléctionné</option>
                                    <option value="1" <?php if($opt == 1)echo "selected" ?>>Ascendant </option>
                                    <option value="2" <?php if($opt == 2)echo "selected" ?>>Descendant</option>
                                </select>
                            </div>
                            <div class="clear"></div>
                        </div>
                    </form>
                                        
                    <div class="clear"></div>
                </div>
        
                <ul class="catalog_table">
                    <?php
                        if (count($cars) > 0) {
                            foreach ($cars as $key => $val){
                                echo "<li>
                                        <a href='#' class='thumb'><img height='119' width='165' src=\"data:image/jpeg;base64,".base64_encode(Car::ReadPic($val['carid']))."\" alt=''/></a>
                                        <div class='catalog_desc'>
                                            <div class='location'>Statut: ".Dict::ReadDicData('diccarstatus', $val['status'])."</div>
                                            <div class='title_box'>
                                                <h4><a href='#'>".Dict::ReadDicData('dicmake', $val['make'])." ".Dict::ReadDicData('dicmodel', $val['model'])."</a></h4>
                                                <div class='price'>".$val['price']." CAD</div>
                                            </div>
                                            <div class='clear'></div>
                                            <div class='grey_area'>
                                                <span>Immatriculation ".$val['year']."</span>
                                                <span>".Dict::ReadDicData('dicengine', $val['engine'])." ".Dict::ReadDicData('dicfuel', $val['fuel'])."</span>
                                                <span>Portes ".$val['doors']."</span>
                                                <span>Sièges ".$val['seats']."</span>
                                                <span>Carrosserie ".Dict::ReadDicData('dicbody', $val['body'])."</span>
                                                <span>".$val['mileage']." Km</span>
                                            </div>
                                            <a href='ucarpage.php?carid=".urlencode($val['carid'])."&crt=".urlencode($crt)."&p=c' class='more markered'>Voir les détails</a>
                                        </div>
                                    </li>";
                            }
                        }
                        else
                            echo "<br /><h1 style='color: #ff3300'>Aucune donnée disponible !</h1>";
                    ?>
                </ul>

                <div class="bottom_catalog_box">
                    <div class="clear"></div>
                </div>
            </div>
            <div class="clear"></div>
        </div>
    </div>
    <!--EOF CONTENT-->
    <?php include "../includes/footer.php" ?>
</body>

</html>
