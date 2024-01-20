<?php
include_once("./Header.php");
include_once("./Nav.php");
$link = mysqli_connect(hostname: "localhost", username: "root", password: "", database: "project");
?>
<div class="container-fluid m-5">
    <h1 class="m-5 pt-5">CART</h1>
    <div class="row">
        <div class=" col-lg-8">
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
                    <div class="col-lg-12">
                        <div class="card w-100 m-5 p-2" style="min-width: 30%; max-width:30%;  box-shadow:  2px 2px 22px 1px #a2a2a2;">
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
                                <a href="./contentPage.php?pid=<?php echo $row3['c_id'] ?>" class="btn btn-primary">Explore More</a>
                                <input name="cartid" type="hidden" value="<?php echo $row3['c_id']; ?>" />
                                <button type="submit" name="cartdelete" class="btn btn-danger float-right px-4 py-2" style="box-shadow:  2px 2px 12px 1px #a2a2a2;"><i class="fa-solid fa-trash" style="color: #ebebeb;"></i></button>
                            </div>
                        </div>
                    </div>
                <?php
                }
                ?>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Sr. No.</th>
                            <th>Product ID</th>
                            <th>Price</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $qry1 = "select c_id from cart where s_id=$_SESSION[id]";
                        $resultset1 = mysqli_query($link, $qry1);
                        $count = mysqli_num_rows($resultset1);
                        if ($count == 0) {
                            echo '<h2>No courses Found</h2>';
                        } else {
                            $c = 1;
                            $sum = 0;
                            while ($row1 = mysqli_fetch_assoc($resultset1)) {
                                $qry3 = "select * from course_details where c_id=$row1[c_id]";
                                $resultset3 = mysqli_query($link, $qry3);
                                $row3 = mysqli_fetch_assoc($resultset3);
                                $sum += $row3['price'];
                        ?>
                                <tr>
                                    <td><?php echo $c; ?></td>
                                    <td><?php echo $row3['c_id']; ?></td>
                                    <td><?php echo $row3['price']; ?></td>
                                </tr>
                        <?php
                                $c += 1;
                            }
                        }
                        ?>
                        <tr class="bg-dark text-light">
                            <td colspan="2">Amount:</td>
                            <td><?php echo $sum; ?></td>
                        </tr>
                        <form method="post">
                            <tr>
                                <td colspan="3">
                                    <div class="form-group form-check">
                                        <input type="checkbox" class="form-check-input" id="con">
                                        <label class="form-check-label" for="con">Confirm the purchase.</label>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                            <td colspan="3">
                                <button type="submit" name="sbtn" class="btn btn-success p-3" style="width: 100%;"><i class="fa-solid fa-money-bill fa-lg mr-3" style="color: #e0e0e1;"></i>PROCEED PAYMENT</button>
                            </td>
                            </tr>
                        </form>
                    </tbody>
                </table>
            </div>
            </div>
        </div>
    </div>
</div>

<?php
mysqli_close($link);
include_once("./footer.php");
include_once("./Foot.php");
?>