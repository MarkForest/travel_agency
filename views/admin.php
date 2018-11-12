<?php
    connect();
    if(isset($_POST['addCountry'])){
        $countryName = trim(htmlspecialchars($_POST['coutryName']));
        if(empty($countryName))return false;
        $insert = "insert into countries(countryName)values('$countryName')";
        mysql_query($insert);
    }
    if(isset($_POST['delCountry'])){
        foreach ($_POST as $k => $v){
            if(substr($k, 0, 2)=="cb"){
                $idc = substr($k, 2);
                $delete = "delete from countries WHERE id = $idc";
                mysql_query($delete);
            }
        }
    }
    $selectCountries = 'select * from countries';
    $selectCities = 'select ci.id, ci.cityName, co.countryName from countries co, cities ci
                      where ci.countryId = co.id';

    $resourseCountries = mysql_query($selectCountries);
    $resourseCities = mysql_query($selectCities);


?>
<div class="row">
    <div class="col-sm-6">
        <!-- todo section A: for Country-->
        <form action="index.php?page=4" method="post" id="formCountry">
            <table class="table table-striped">
                <?php while ($row = mysql_fetch_array($resourseCountries, MYSQL_ASSOC)):?>
                    <tr>
                        <td><?=$row["id"]?></td>
                        <td><?=$row["countryName"]?></td>
                        <td><input type="checkbox" name="cb<?=$row["id"]?>"></td>
                    </tr>
                <?php endwhile;?>
            </table>
            <div class="form-inline">
                <input type="text" name="coutryName" placeholder="Country">
                <input type="submit" class="btn btn-success btn-sm" name="addCountry" value="Add">
                <input type="submit" class="btn btn-warning btn-sm" name="delCountry" value="Delete">
            </div>
        </form>
    </div>
    <div class="col-sm-6">
        <!-- todo section B: for Cities-->
        <form action="index.php?page=4" method="post" id="formCities">
            <table class="table table-striped">
                <?php while ($row2 = mysql_fetch_array($resourseCities, MYSQL_ASSOC)):?>
                    <tr>
                        <td><?=$row2["id"]?></td>
                        <td><?=$row2["cityName"]?></td>
                        <td><?=$row2["countryName"]?></td>
                        <td><input type="checkbox" name="ci<?=$row2['id']?>"></td>
                    </tr>
                <?php endwhile;?>
            </table>
           <div class="form-inline">
               <input type="text" name="cityName" placeholder="City" class="form-control">
               <select name="countryNameSelect" class="form-control">
                   <?php $resourseCountriesCity = mysql_query($selectCountries);?>
                   <?php while ($row = mysql_fetch_array($resourseCountriesCity, MYSQL_ASSOC)):?>
                       <option value="<?=$row['id']?>"><?=$row['countryName']?></option>
                   <?php endwhile;?>
               </select>
               <input type="submit" name="addCity" class="btn btn-sm btn-success form-control" value="Add">
               <input type="submit" name="delCity" class="btn btn-sm btn-warning form-control" value="Delete">
           </div>
        </form>
    </div>
</div>
<div class="row">
    <div class="col-sm-6">
        <!-- todo section C: for Hotels-->
    </div>
    <div class="col-sm-6">
        <!-- todo section D: for Images-->
    </div>
</div>