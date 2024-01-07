<?php
include_once("./Header.php");
include_once("./Nav.php");
$link = mysqli_connect(hostname: "localhost", username: "root", password: "", database: "project");
$qry = "select * from  course_details";
$resultset = mysqli_query($link, $qry);
$cat = array();
$subcat = array();
$price = array();
$length = array();
if ($_GET['id'] == 0) {
    $qry = "select * from  course_details";
    $resultset = mysqli_query($link, $qry);
} else {
    $qry = "select * from  course_details where cat_id=$_GET[id] or sub_cat_id=$_GET[id]";
    $resultset = mysqli_query($link, $qry);
}
extract($_POST);
if (isset($catfilter)) {
    if (empty($cat)) {
        $qry = "select * from  course_details";
        $resultset = mysqli_query($link, $qry);
    } else {
        $de = "";
        foreach ($cat as $d) {
            $de .= "'$d'" . ",";
        }
        $de = trim($de, ",");
        $qry = "select * from course_details where cat_id  in ($de)";
        $resultset = mysqli_query($link, $qry);
    }
}
if (isset($scatfilter)) {
    if (empty($subcat)) {
        $qry = "select * from  course_details";
        $resultset = mysqli_query($link, $qry);
    } else {
        $de = "";
        foreach ($subcat as $d) {
            $de .= "'$d'" . ",";
        }
        $de = trim($de, ",");
        $qry = "select * from course_details where sub_cat_id  in ($de)";
        $resultset = mysqli_query($link, $qry);
    }
}
if (isset($pfilter)) {
    if (empty($price)) {
        $qry = "select * from  course_details";
        $resultset = mysqli_query($link, $qry);
    } else {
        $de = "";
        foreach ($price as $d) {
            $de .= "$d" . ",";
        }
        $de = trim($de, ",");
        $qry = "select * from course_details where price<= ($de)";
        $resultset = mysqli_query($link, $qry);
    }
}
if (isset($lfilter)) {
    if (empty($length)) {
        $qry = "select * from  course_details";
        $resultset = mysqli_query($link, $qry);
    } else {
        $de = "";
        foreach ($length as $d) {
            $de .= "$d" . ",";
        }
        $de = trim($de, ",");
        $qry = "select * from course_details where l_num<= ($de)";
        $resultset = mysqli_query($link, $qry);
    }
}
?>
<section>
    <div class="container-fluid px-1 py-5">
        <h2></h2>
        <div class="container-fluid row">
            <button class="btn btn-dark p-3" type="button" data-toggle="collapse" data-target="#filtercollapse">
                <i class="fa-solid fa-filter fa-xl mr-3" style="color: #d6d6d6;"></i><span class="">FILTERS</span>
            </button>
            <div class="collapse width ml-4" id="filtercollapse">
                <form method="post">
                    <ul class="list-group list-group-horizontal">
                        <div class="mt-4">
                            <li class="list-group-item border-0 px-5">
                                <h6>Category</h6>

                                <ul class="ul">
                                    <?php
                                    $qry3 = "select * from category";
                                    $resultset3 = mysqli_query($link, $qry3);
                                    while ($row3 = mysqli_fetch_assoc($resultset3)) {
                                    ?>
                                        <li><input type="checkbox" value="<?php echo $row3['cat_id']; ?>" name="cat[]"><span class="ml-2"><?php echo $row3['cat_name']; ?></span></li>
                                    <?php
                                    }
                                    ?>
                                    <li><button type="submit" name="catfilter" class="btn btn-dark mt-4"><i class="fa-solid fa-filter fa-sm mr-3" style="color: #d6d6d6;"></i>Apply Filter</button></li>
                                </ul>
                            </li>
                        </div>
                        <div class="mt-4">
                            <li class="list-group-item border-0 px-5">
                                <h6>Subjects</h6>

                                <ul class="ul">
                                    <?php
                                    $qry3 = "select * from sub_category";
                                    $resultset3 = mysqli_query($link, $qry3);
                                    while ($row3 = mysqli_fetch_assoc($resultset3)) {
                                    ?>
                                        <li><input type="checkbox" value="<?php echo $row3['sub_cat_id']; ?>" name="subcat[]"><span class="ml-2"><?php echo $row3['sub_cat_name']; ?></span></li>
                                    <?php
                                    }
                                    ?>
                                    <li><button type="submit" name="scatfilter" class="btn btn-dark mt-4"><i class="fa-solid fa-filter fa-sm mr-3" style="color: #d6d6d6;"></i>Apply Filter</button></li>
                                </ul>
                            </li>
                        </div>
                        <div class="mt-4">
                            <li class="list-group-item border-0 px-5">
                                <h6>Price</h6>

                                <ul class="ul">
                                    <li><input type="checkbox" value="0" name="price[]"><span class="ml-2">Free</span></li>
                                    <li><input type="checkbox" value="500" name="price[]"><span class="ml-2">Upto Rs.500</span></li>
                                    <li><input type="checkbox" value="1000" name="price[]"><span class="ml-2">Upto Rs.1000</span></li>
                                    <li><input type="checkbox" value="1500" name="price[]"><span class="ml-2">Upto Rs.1500</span></li>
                                    <li><button type="submit" name="pfilter" class="btn btn-dark mt-4"><i class="fa-solid fa-filter fa-sm mr-3" style="color: #d6d6d6;"></i>Apply Filter</button></li>
                                </ul>
                            </li>
                        </div>
                        <div class="mt-4">
                            <li class="list-group-item border-0 px-5">
                                <h6>Length</h6>

                                <ul class="ul">
                                    <li><input type="checkbox" value="5" name="length[]"><span class="ml-2">Short</span></li>
                                    <li><input type="checkbox" value="20" name="length[]"><span class="ml-2">Long</span></li>
                                    <li><input type="checkbox" value="1000" name="length[]"><span class="ml-2">Full</span></li>
                                    <li><button type="submit" name="lfilter" class="btn btn-dark mt-4"><i class="fa-solid fa-filter fa-sm mr-3" style="color: #d6d6d6;"></i>Apply Filter</button></li>
                                </ul>
                            </li>
                        </div>
                    </ul>
                </form>
            </div>

            <div class="card-deck p-3">
                <?php
                $count = mysqli_num_rows($resultset);
                if ($count == 0) {
                    echo "<br><h2>No Result Found</h2>";
                } else {
                    while ($row = mysqli_fetch_assoc($resultset)) {
                        $qry2 = "select * from adm_details where a_id=$row[a_id]";
                        $resultset2 = mysqli_query($link, $qry2);
                        $row2 = mysqli_fetch_assoc($resultset2);
                ?>
                        <div class="card p-2 mb-4" style="min-width: 30%; box-shadow:  2px 2px 22px 1px #a2a2a2;">
                            <img class="card-img-top" src="<?php echo $row['img_url']; ?>" alt="Card image cap">
                            <div class="card-body">
                                <h5 class="card-title"><?php echo $row['c_name']; ?></h5>
                                <div class="card-text">
                                    <ul class="ul">
                                        <li>by <?php echo $row2['a_fname'] . " " . $row2['a_lname']; ?></li>
                                        <li><?php echo $row['description']; ?></li>
                                        <li><?php echo $row['users'] . " users"; ?></li>
                                        <li><?php echo $row['price'] . " Rs."; ?></li>
                                    </ul>
                                </div>
                                <a href="./contentPage.php?pid=<?php echo $row['c_id'] ?>" class="btn btn-primary">Explore More</a>
                            </div>
                        </div>
                <?php
                    }
                }
                ?>
            </div>
        </div>
    </div>
</section>

<?php
mysqli_close($link);
include_once("./footer.php");
include_once("./Foot.php");
?>