<?php 
    $_SESSION["CURPAGE"] = "";
    $_SESSION["LANG"] = "en";

    include "../classes/car.php"; 
    include "../classes/dictionary.php";
    include "../classes/sorting.php";

    //Model
    if(isset($_REQUEST['makeid'])){
        $rez = "<option value='0'>Any</option>";
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
    <title>Catalog</title>
    <?php include "../includes/scripts.php"; ?>

</head>

<body class="catalog catalog-grid">
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
                <a href="umain.php">Home</a>
                <img src="../images/marker/marker.gif" alt="" />
                <span>Cars</span>
            </div>
            <div class="main_wrapper">
                <h1><strong>Cars</strong> (<?php echo count($cars) ?> results)</h1>
                <div class="catalog_sidebar">

                    <form method="post" action="ucarscataloggrid.php">
                        <div class="search_auto">
                            <h3><strong>Search</strong> auto</h3>
                            <div class="clear"></div>
                            
                            <script>
                                function getModel(val) {
                                    var xmlhttp = new XMLHttpRequest();
                                    xmlhttp.onreadystatechange = function r() {
                                        if (this.readyState == 4 && this.status == 200) {
                                            document.getElementById("model").innerHTML = this.responseText;
                                        }
                                    };
                                    xmlhttp.open("GET", "ucarscataloggrid.php?makeid=" + val, true);
                                    xmlhttp.send();
                                }
                            </script>
                            
                            <label><strong>Manufacturer:</strong></label>
                            <div class="select_box_1">
                                <select class="select_1" name="make" id="make" onchange="getModel(this.value);">
                                       <option value="0">Any</option>
                                       <?php $dic = Dict::GetData('dicmake');
                                            foreach ($dic as $val)
                                                echo "<option value='".$val['id']."'>".$val['name']."</option>";
                                        ?>
                                </select>
                            </div>
                            <label><strong>Model:</strong></label>
                            <div class="select_box_1">
                                <select id="model" name="model" style="width: 180px; border-radius: 0; padding: 6px; color: #8B9EAE">
                                    <option value='0'>Any</option>
                                </select>
                            </div>
                            <label><strong>Body type:</strong></label>
                            <div class="select_box_1">
                                <select class="select_3" id="body" name="body">
                                   <option value="0">Any</option>
                                   <?php $dic = Dict::GetData('dicbody');
                                        foreach ($dic as $val)
                                            echo "<option value='".$val['id']."'>".$val['name']."</option>";
                                    ?>
                            </select>
                            </div>
                            <label><strong>Year:</strong></label>
                            <div class="select_box_2">
                                <select class="select_4" id="yearfrom" name="yearfrom">
                                    <option value="0">From</option>
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
                                    <option value="0">To</option>
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
                            <label><strong>Price:</strong></label>
                            <div class="select_box_2">
                              <select class="select_4" id="pricefrom" name="pricefrom">
                                <option value="0">From</option>
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
                                <option value="0">To</option>
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
                            <label><strong>Mileage:</strong></label>
                            <div class="select_box_2">
                                <select class="select_4" id="mileagefrom" name="mileagefrom">
                                    <option value="-1">From</option>
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
                                    <option value="-1">To</option>
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
                                <label class="check_label">Only new cars</label>
                            </div>
                            <input type="submit" value="Search" class="btn_search" />
                            <div class="clear"></div>
                        </div>
                        <div class="clear"></div>
                    </form>

                </div>
            </div>
            <div class="main_catalog">
                <div class="top_catalog_box">
                    <div class="switch">
                        <a href="ucarscatalog.php?crt=<?php echo urlencode($crt); ?>" class="table_view"></a>
                        <span class="list_view"></span>
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

                    <form action="ucarscataloggrid.php?crt=<?php echo urlencode($crt); ?>" method="post">
                        <div class="sorting drop_list">
                            <strong>Sort by: </strong>
                            <div class="selected">
                                <select style="margin: 5px 10px; border-radius: 50px 20px; padding-left: 10px;" id="sort" name="sort" onchange="modOption1();">
                                    <option value="0" <?php if($sel == 0)echo "selected" ?>>Not sorted</option>
                                    <option value="1" <?php if($sel == 1)echo "selected" ?>>Price</option>
                                    <option value="2" <?php if($sel == 2)echo "selected" ?>>Year</option>
                                    <option value="3" <?php if($sel == 3)echo "selected" ?>>Mileage</option>
                                    <option value="4" <?php if($sel == 4)echo "selected" ?>>Make</option>
                                </select>
                            </div>
                            <div class="clear"></div>
                        </div>
                        <div class="sorting drop_list">
                            <strong>Options: </strong>
                            <div class="selected">
                                <select style="margin: 5px 10px; border-radius: 50px 20px; padding-left: 10px;" id="option" name="option" onchange = "modOption2(); this.form.submit();">
                                    <option value="0" <?php if($opt == 0)echo "selected" ?>>Not selected</option>
                                    <option value="1" <?php if($opt == 1)echo "selected" ?>>Ascending </option>
                                    <option value="2" <?php if($opt == 2)echo "selected" ?>>Descending</option>
                                </select>
                            </div>
                            <div class="clear"></div>
                        </div>
                    </form>  

                    <div class="clear"></div>
                </div>
                    <?php
                        $k = 1;
                        if (count($cars) > 0){
                            echo "<ul class='catalog_list'>";
                            foreach ($cars as $key => $val){
                                echo "<li ";
                                    if ($k == 2) echo "class='second'>";
                                    elseif ($k == 3) { echo "class='last'>"; $k = 0; }
                                    else echo ">";
                                echo "<a href='ucarpage.php?carid=".urlencode($val['carid'])."&crt=".urlencode($crt)."&p=g'><img height='164' width='213' src=\"data:image/jpeg;base64,".base64_encode(Car::ReadPic($val['carid']))."\" alt=''/>     <div class='description'>Registration ".$val['year']."<br/>".Dict::ReadDicData('dicengine', $val['engine'])." ".Dict::ReadDicData('dicfuel', $val['fuel'])."<br/>Body ".Dict::ReadDicData('dicbody', $val['body']);
                                        if ($val['mileage'] != 0) echo "<br/>".$val['mileage']." Km";
                                        if ($val['oldprice'] != 0) echo "<br/><font color='red'>Old price ".$val['oldprice']."</font>";
                                echo "</div><div class='title'>".Dict::ReadDicData('dicmake', $val['make'])." ".Dict::ReadDicData('dicmodel', $val['model'])."<span class='price'>".$val['price']." CAD</span></div></a></li>";
                                $k++; 
                            }
                            echo "</ul>";
                        }
                        else
                            echo "<br /><h1 style='color: #ff3300'>No data found !</h1>";
                    ?>
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