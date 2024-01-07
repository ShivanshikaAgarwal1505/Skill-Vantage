<?php
include_once("./Header.php");
include_once("./Nav.php");
$result = "";
$link = mysqli_connect(hostname: "localhost", username: "root", password: "", database: "project");
$qry = "SELECT * FROM std_details WHERE s_id=$_SESSION[id]";
$resultset = mysqli_query($link, $qry);
$row = mysqli_fetch_assoc($resultset);
extract($_POST);
if (isset($submit)) {
    $qry2 = "UPDATE std_details SET s_fname='$f_name', s_lname='$l_name', s_email='$email', s_phone='$tel' WHERE s_id=$_SESSION[id]";
    $c = mysqli_query($link, $qry2);
    if ($c) {
        $result = "<div class='container-fluid alert alert-success fade show'><a href='#' class='close' data-dismiss='alert'>&times;</a><h6>Congratulations!!</h6>Update Successful</div>";
    }
}
if (isset($cancle)) {
    session_reset();
    session_destroy();
    header("location: ./HomePage.php");
    // if (!isset($_SESSION['id'])) {
    //     $result = "<div class='container-fluid alert alert-success fade show'><a href='#' class='close' data-dismiss='alert'>&times;</a><h6>WARNING</h6>LogOut Successfull!!</div>";
    // }
}
if (isset($prodelete)) {
    $qry2 = "DELETE FROM purchase WHERE s_id=$_SESSION[id] and c_id=$proid";
    $c = mysqli_query($link, $qry2);
    echo "<meta http-equiv='refresh' content='0'>";
}
if (isset($wishdelete)) {
    $qry2 = "DELETE FROM wishlist WHERE s_id=$_SESSION[id] and c_id=$wishid";
    $c = mysqli_query($link, $qry2);
    echo "<meta http-equiv='refresh' content='0'>";
}
if (isset($cartdelete)) {
    $qry2 = "DELETE FROM cart WHERE s_id=$_SESSION[id] and c_id=$cartid";
    $c = mysqli_query($link, $qry2);
    echo "<meta http-equiv='refresh' content='0'>";
}
?>
<div align="center">
    <img src="./Images/user.jpg" class="img-thumbnail rounded-circle border-0" width="20%" height="20%" />
    <h3>Welcome <?php echo $_SESSION["name"] ?>!</h3>
</div>
<!-- <hr width="100%" class="bg-info"/> -->
<div class="container-fluid mt-0 p-0">
    <div class="row p-5">
        <div id="progress" class="col-sm-3 heading px-4">
            <i class="fa-solid fa-user fa-2xl" style="color: #17c9fc;"></i>
        </div>
        <div id="wishlist" class="col-sm-3 heading px-4">
            <i class="fa-solid fa-heart fa-2xl" style="color: #17c9fc;"></i>
        </div>
        <div id="cart" class="col-sm-3 heading px-4">
            <i class="fa-solid fa-cart-shopping fa-2xl" style="color: #17c9fc;"></i>
        </div>
        <div id="settings" class="col-sm-3 heading px-4">
            <i class="fa-solid fa-sliders fa-2xl" style="color: #17c9fc;"></i>
        </div>
    </div>
</div>
<form method="post">
    <div id="pro" class="container-fluid tab-content">
        <h2>YOUR COURSES</h2>
        <div class="card-deck p-3">
            <?php
            $qry1 = "select c_id from purchase where s_id=$_SESSION[id]";
            $resultset1 = mysqli_query($link, $qry1);
            $count = mysqli_num_rows($resultset1);
            if ($count == 0) {
                echo '<h2>No courses Found</h2>';
                echo '';
            }
            while ($row1 = mysqli_fetch_assoc($resultset1)) {
                $qry3 = "select * from course_details where c_id=$row1[c_id]";
                $resultset3 = mysqli_query($link, $qry3);
                $row3 = mysqli_fetch_assoc($resultset3);
                $qry4 = "select * from adm_details where a_id=$row3[a_id]";
                $resultset2 = mysqli_query($link, $qry4);
                $row2 = mysqli_fetch_assoc($resultset2);
            ?>
                <div class="card mb-5 p-2" style="min-width: 30%;  box-shadow:  2px 2px 22px 1px #a2a2a2;">
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
                        <form method="post">
                            <a href="./contentPage.php?pid=<?php echo $row3['c_id'] ?>" class="btn btn-primary">Explore More</a>
                            <input name="proid" type="hidden" value="<?php echo $row3['c_id']; ?>" />
                            <button type="submit" name="prodelete" class="btn btn-danger float-right px-4 py-2" style="box-shadow:  2px 2px 12px 1px #a2a2a2;"><i class="fa-solid fa-trash" style="color: #ebebeb;"></i></button>
                        </form>
                    </div>
                </div>

            <?php
            }
            ?>
        </div>
    </div>
    <div id="wish" class="container-fluid tab-content">
        <h2>YOUR WISHLIST</h2>
        <div class="card-deck p-3">
            <?php
            $qry1 = "select c_id from wishlist where s_id=$_SESSION[id]";
            $resultset1 = mysqli_query($link, $qry1);
            $count = mysqli_num_rows($resultset1);
            if ($count == 0) {
                echo '<h2>No courses Found</h2>';
                echo '';
            }
            while ($row1 = mysqli_fetch_assoc($resultset1)) {
                $qry3 = "select * from course_details where c_id=$row1[c_id]";
                $resultset3 = mysqli_query($link, $qry3);
                $row3 = mysqli_fetch_assoc($resultset3);
                $qry4 = "select * from adm_details where a_id=$row3[a_id]";
                $resultset2 = mysqli_query($link, $qry4);
                $row2 = mysqli_fetch_assoc($resultset2);
            ?>
                <div class="card mb-5 p-2" style="min-width: 30%;  box-shadow:  2px 2px 22px 1px #a2a2a2;">
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
                        <form method="post">
                            <a href="./contentPage.php?pid=<?php echo $row3['c_id'] ?>" class="btn btn-primary">Explore More</a>
                            <input name="wishid" type="hidden" value="<?php echo $row3['c_id']; ?>" />
                            <button type="submit" name="wishdelete" class="btn btn-danger float-right px-4 py-2" style="box-shadow:  2px 2px 12px 1px #a2a2a2;"><i class="fa-solid fa-trash" style="color: #ebebeb;"></i></button>
                        </form>
                    </div>
                </div>

            <?php
            }
            ?>
        </div>
    </div>
    <div id="ca" class="container-fluid tab-content">
        <h2>YOUR CART</h2>
        <div class="card-deck p-3">
            <?php
            $qry1 = "select c_id from cart where s_id=$_SESSION[id]";
            $resultset1 = mysqli_query($link, $qry1);
            $count = mysqli_num_rows($resultset1);
            if ($count == 0) {
                echo '<h2>No courses Found</h2>';
                echo '';
            }
            while ($row1 = mysqli_fetch_assoc($resultset1)) {
                $qry3 = "select * from course_details where c_id=$row1[c_id]";
                $resultset3 = mysqli_query($link, $qry3);
                $row3 = mysqli_fetch_assoc($resultset3);
                $qry4 = "select * from adm_details where a_id=$row3[a_id]";
                $resultset2 = mysqli_query($link, $qry4);
                $row2 = mysqli_fetch_assoc($resultset2);
            ?>
                <div class="card mb-5 p-2" style="min-width: 30%;  box-shadow:  2px 2px 22px 1px #a2a2a2;">
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
                        <form method="post">
                            <a href="./contentPage.php?pid=<?php echo $row3['c_id'] ?>" class="btn btn-primary">Explore More</a>
                            <input name="cartid" type="hidden" value="<?php echo $row3['c_id']; ?>" />
                            <button type="submit" name="cartdelete" class="btn btn-danger float-right px-4 py-2" style="box-shadow:  2px 2px 12px 1px #a2a2a2;"><i class="fa-solid fa-trash" style="color: #ebebeb;"></i></button>
                        </form>
                    </div>
                </div>

            <?php
            }
            ?>
        </div>
        <div class="container-fluid">
            <a href="billing.php" class="btn btn-success ">PROCEDE TO BUY</a>
        </div>
    </div>
</form>
<div id="set" class="tab-content row">
    <div class="col-4 "></div>
    <div class="col-4 table-responsive">
        <form method="post">
            <table class="table table-borderless">
                <tr align="center">
                    <td colspan="4">
                        <h1>EDIT PROFILE</h1>
                    </td>
                </tr>
                <tr>
                    <td colspan="2">First Name</td>
                    <td colspan="2" align="center"> <input type="text" class="p-3 border-0 input" name="f_name" id="fname" value="<?php echo $row['s_fname']; ?>" style="border-radius: 10px; box-shadow: 0 0 10px 0 #757474;" required></td>
                </tr>
                <tr>
                    <td colspan="2">Last Name</td>
                    <td colspan="2" align="center"><input type="text" class="p-3 border-0 input" name="l_name" id="lname" value="<?php echo $row['s_lname']; ?>" style="border-radius: 10px; box-shadow: 0 0 10px 0 #757474;" required></td>
                </tr>
                <tr>
                    <td colspan="2">Email address</td>
                    <td colspan="2" align="center"> <input type="email" class="p-3 border-0 input" name="email" id="email" value="<?php echo $row['s_email']; ?>" style="border-radius: 10px; box-shadow: 0 0 10px 0 #757474;" required></td>
                </tr>
                <tr>
                    <td colspan="2">Contact</td>
                    <td colspan="2" align="center"><input type="tel" class="p-3 border-0 input" name="tel" id="phone" value="<?php echo $row['s_phone']; ?>" style="border-radius: 10px; box-shadow: 0 0 10px 0 #757474;" required></td>
                </tr>
                <tr align="center">
                    <td colspan="4">
                        <button type="submit" class="btn btn-success m-4 pl-4 pr-4" name="submit">Submit</button>
                        <button type="submit" name="cancle" class="btn btn-secondary m-4 pl-4 pr-4">Log Out</button>
                    </td>
                </tr>
                <tr align="center">
                    <td colspan="4">
                        <h3 class="text-light" name="result">
                            <?php
                            echo $result;
                            ?>
                        </h3>
                    </td>
                </tr>
            </table>
        </form>
    </div>
    <div class="col-4">
    </div>
</div>
<?php
mysqli_close($link);
include_once("./footer.php");
include_once("./Foot.php");
?>

<script>

</script>