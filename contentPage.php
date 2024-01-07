<?php
include_once("./Header.php");
include_once("./Nav.php");
include_once("./sessionCheck.php");
$link = mysqli_connect(hostname: "localhost", username: "root", password: "", database: "project");
$qry = "select * from course_details where c_id=$_GET[pid]";
$resultset = mysqli_query($link, $qry);
$row = mysqli_fetch_assoc($resultset);
$qry2 = "select * from adm_details where a_id=$row[a_id]";
$resultset2 = mysqli_query($link, $qry2);
$row2 = mysqli_fetch_assoc($resultset2);

?>

<div class="container-fluid p-5">
    <h2><?php echo $row['c_name']; ?></h2>
    <div class="row  mt-3" style="box-shadow: 0 0 15px 0 #b7b7b7; border-radius: 10px;">
        <div class="col-lg-8 p-2">
            <img src="<?php echo $row['img_url']; ?>" width="100%" class="img-fluid rounded mb-4"></img>
            <div class="container mb-5">
                <ul list-style-type="none" class="ul">
                    <li>by <?php echo $row2['a_fname'] . " " . $row2['a_lname']; ?></li>
                    <li><?php echo $row['description']; ?></li>
                    <li><?php echo $row['users'] . " users"; ?></li>
                    <li>Price: <?php echo $row['price'] . " Rs."; ?></li>
                    <li>No. of Lectures: <?php echo $row['price'] . " Rs."; ?></li>
                    <form name="form1" method="post" enctype="multipart/form-data">
                        <li class="mt-5">
                            <?php
                            extract($_POST);
                            if (isset($watch)) {
                                $qry5 = "select * from purchase where c_id=$_GET[pid] and s_id=$_SESSION[id]";
                                $resultset4 = mysqli_query($link, $qry5);
                                $count = mysqli_num_rows($resultset4);
                                if ($count == 0) {
                                    $qry4 = "UPDATE course_details SET users=$row[users]+1";
                                    $resultset5 = mysqli_query($link, $qry4);
                                    $qry5 = "SELECT CURDATE();";
                                    $row5 = mysqli_query($link, $qry5);
                                    $date = mysqli_fetch_assoc($row5);
                                    $date1 = $date['CURDATE()'];
                                    $qry6 = "insert into purchase values($_SESSION[id], $_GET[pid], $date1, 0)";
                                    $resultset5 = mysqli_query($link, $qry6);
                                }
                                $qry7 = "select * from lecture_details where c_id=$_GET[pid]";
                                $resultset4 = mysqli_query($link, $qry7);
                                $row4 = mysqli_fetch_assoc($resultset4);
                            ?>
                                <script type="text/javascript">
                                    window.location = " ./ProductPage.php?cid=<?php echo $row4['l_id']; ?>";
                                </script>
                                <!-- header("location: ./ProductPage.php?cid=$row4[l_id]"); -->
                            <?php
                            }
                            if (isset($wishlist)) {
                                $qry1 = "select * from wishlist where  c_id=$_GET[pid] and s_id=$_SESSION[id]";
                                $resultset4 = mysqli_query($link, $qry1);
                                $count = mysqli_num_rows($resultset4);
                                if ($count == 0) {
                                    $qry8 = "insert into wishlist values($_SESSION[id], $_GET[pid])";
                                    $resultset6 = mysqli_query($link, $qry8);
                                }
                            }
                            if (isset($cart)) {
                                $qry1 = "select * from cart where  c_id=$_GET[pid] and s_id=$_SESSION[id]";
                                $resultset4 = mysqli_query($link, $qry1);
                                $count = mysqli_num_rows($resultset4);
                                if ($count == 0) {
                                    $qry9 = "insert into cart values($_SESSION[id], $_GET[pid])";
                                    $resultset7 = mysqli_query($link, $qry9);
                                }
                            }
                            if ($row['price'] == 0) {
                                echo '<button type="submit" name="wishlist" class="btn btn-light mr-5 p-3 cpb" id="wsh"><i class="fa-solid fa-heart pr-3 fa-2xl cpi"></i><span id="wsh1">WISHLIST</span></button>';
                                echo '<button type="submit" name="watch" class="btn btn-light mr-5 p-3 cpb" id="wsh"><i class="fa-solid pr-3 fa-play fa-2xl cpi"></i>WATCH</button>';
                            } else {
                                echo '<button type="submit" name="wishlist" class="btn btn-light mr-5 p-3 cpb" id="wsh"><i class="fa-solid fa-heart pr-3 fa-2xl cpi"></i><span id="wsh1">WISHLIST</span></button>';
                                echo '<button type="submit" name="cart" class="btn btn-light mr-5 p-3 cpb ml-5" id="atc"><i class="fa-solid fa-cart-shopping fa-2xl pr-3 cpi"></i><span id="atc1">ADD TO CART</span></button>';
                            }
                            ?>
                        </li>
                    </form>
                </ul>
            </div>
        </div>
        <div class="col-lg-4 table-responsive mt-2">
            <table class="table m-0 table-bordered table-striped table-hover table-light">
                <tr>
                    <td class="font-weight-bold" colspan="2">
                        <h5>CONTENT</h5>
                    </td>
                </tr>
                <?php
                $qry3 = "select * from lecture_details where c_id=$_GET[pid]";
                $resultset3 = mysqli_query($link, $qry3);
                while ($row3 = mysqli_fetch_assoc($resultset3)) {
                ?>
                    <tr>
                        <td><?php echo $row3['l_num']; ?></td>
                        <td><a href="./ProductPage.php?cid=<?php echo $row3['l_id']; ?>"><?php echo $row3['l_name']; ?></a></td>
                    </tr>
                <?php
                }
                ?>
            </table>
        </div>
    </div>
</div>
<div class="container-fluid p-5">
    <h1>View Similar</h1>
    <div class="container-fluid">
        <div class="card-slider pt-5 ">
            <?php
            $qry = "select * from course_details where cat_id=$row[cat_id]";
            $resultset = mysqli_query($link, $qry);
            $x = 0;
            while ($row3 = mysqli_fetch_assoc($resultset) and $x != 10) {
                $qry2 = "select * from adm_details where a_id=$row[a_id]";
                $resultset2 = mysqli_query($link, $qry2);
                $row2 = mysqli_fetch_assoc($resultset2);
            ?>
                <div class="col-lg-12">
                    <div class="card w-100 m-5 p-2" style="box-shadow:  2px 2px 22px 1px #a2a2a2;">
                        <img class="card-img-top " src="<?php echo $row3['img_url']; ?>" alt="Card image cap">
                        <div class="card-body">
                            <h5 class="card-title"><?php echo $row3['c_name']; ?></h5>
                            <div class="card-text">
                                <ul class="ul">
                                    <li>by <?php echo $row2['a_fname'] . " " . $row2['a_lname']; ?></li>
                                    <li><?php echo $row3['description']; ?></li>
                                    <li><?php echo $row3['users'] . " users"; ?></li>
                                    <li><?php echo $row3['price'] . " Rs."; ?></li>
                                </ul>
                            </div>
                            <a href=" ./contentPage.php?pid=<?php echo $row['c_id'] ?>" class="btn btn-primary">Explore More</a>
                        </div>
                    </div>
                </div>
            <?php
                $x += 1;
            }
            ?>
        </div>
    </div>
</div>
<hr>
<div class="container-fluid p-5">
    <h1>By Same Author</h1>
    <div class="container-fluid">
        <div class="card-slider pt-5 ">
            <?php
            $qry = "select * from course_details where a_id=$row[a_id]";
            $resultset = mysqli_query($link, $qry);
            $x = 0;
            while ($row3 = mysqli_fetch_assoc($resultset) and $x != 10) {
                $qry2 = "select * from adm_details where a_id=$row[a_id]";
                $resultset2 = mysqli_query($link, $qry2);
                $row2 = mysqli_fetch_assoc($resultset2);
            ?>
                <div class="col-lg-12">
                    <div class="card w-100 m-5 p-2" style="box-shadow:  2px 2px 22px 1px #a2a2a2;">
                        <img class="card-img-top " src="<?php echo $row3['img_url']; ?>" alt="Card image cap">
                        <div class="card-body">
                            <h5 class="card-title"><?php echo $row3['c_name']; ?></h5>
                            <div class="card-text">
                                <ul class="ul">
                                    <li>by <?php echo $row2['a_fname'] . " " . $row2['a_lname']; ?></li>
                                    <li><?php echo $row3['description']; ?></li>
                                    <li><?php echo $row3['users'] . " users"; ?></li>
                                    <li><?php echo $row3['price'] . " Rs."; ?></li>
                                </ul>
                            </div>
                            <a href=" ./contentPage.php?pid=<?php echo $row3['c_id'] ?>" class="btn btn-primary">Explore More</a>
                        </div>
                    </div>
                </div>
            <?php
                $x += 1;
            }
            ?>
        </div>
    </div>
</div>
<hr>
<div class="container-fluid  p-5">
    <h1>Popular courses</h1>
    <div class="container-fluid">
        <div class="card-slider pt-5 ">
            <?php
            $qry = "select * from course_details ORDER BY users desc";
            $resultset = mysqli_query($link, $qry);
            $x = 0;
            while ($row = mysqli_fetch_assoc($resultset) and $x != 6) {
                $qry2 = "select * from adm_details where a_id=$row[a_id]";
                $resultset2 = mysqli_query($link, $qry2);
                $row2 = mysqli_fetch_assoc($resultset2);
            ?>
                <div class="col-lg-12">
                    <div class="card w-100 m-5 p-2" style="box-shadow:  2px 2px 22px 1px #a2a2a2;">
                        <img class="card-img-top " src="<?php echo $row['img_url']; ?>" alt="Card image cap">
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
                            <a href=" ./contentPage.php?pid=<?php echo $row['c_id'] ?>" class="btn btn-primary">Explore More</a>
                        </div>
                    </div>
                </div>
            <?php
                $x += 1;
            }
            ?>
        </div>
    </div>
</div>

<?php
mysqli_close($link);
include_once("./footer.php");
?>
<?php
include_once("./Foot.php");
?>