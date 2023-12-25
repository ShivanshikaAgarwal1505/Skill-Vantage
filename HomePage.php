<?php
include_once("./Header.php");
include_once("./Nav.php");
$link = mysqli_connect(hostname: "localhost", username: "root", password: "", database: "project");
?>

<section class="container-fluid b" id="#top">
    <div class="text-light p-5" height="auto">
        <div class="row">
            <div class="col-lg-7 p-5">
                <div class="bold">WELCOME!!</div>
                <h3>Join Our Classrooms Now and Advance Your Learning.</h3>
                <button class="btn p-2 mt-4" style="background-color: #17c9fc; color: #ffffff; font-size: larger; font-weight: bold; border-radius:7px;">Start Journey Now</button>
            </div>
            <div class="col-lg-5">
                <figure class="image titlt fig" data-tilt data-tilt-max="4">
                    <img src="./Images/banner-1.png" class="img-fluid mr-0">
                </figure>
            </div>
        </div>
    </div>
</section>


<section class="p-3">
    <h1>
        Let's Start Learning
    </h1>
    <h4>Browse our various courses</h4>
    <div class="container-fluid mb-5">
        <div class="card-slider pt-5 ">
            <?php
            $qry = "select *  from sub_category";
            $resultset = mysqli_query($link, $qry);
            while ($row = mysqli_fetch_assoc($resultset)) {
            ?>
                <div class="col-sm-12">
                    <div class="card w-100 p-3 m-5" style="box-shadow:  2px 2px 22px 1px #a2a2a2;">
                        <h4 class="card-title mb-5"><?php echo $row['sub_cat_name']; ?></h4>
                        <div class="wrapper ">
                            <a href="./display.php?id=<?php echo $row['sub_cat_id'];?>" class="an"><span class="span">SHOW ALL</span></a>
                        </div>
                    </div>
                </div>
            <?php
            }
            ?>
        </div>
    </div>
    <div class="alert text-light show fade" style="background-color: black; color: #fff;">
        <a href="#" class="btn btn-light close" data-dismiss="alert">&times;</a>
        <h2>Attention</h2>
        <p>Join our teaching staff and join 1000+ others.</p>
        <a class="btn btn-light" href="myTeaching.html">Join Now</a>
    </div>
</section>

<section>
    <div class="container-fluid b pt-5 pb-5 pr-3 pl-3">
        <h2 class="ml-5 mb-5 text-light">Popular courses</h2>
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
</section>

<section>
    <div class="container-fluid p-5">
        <h2>What's new</h2>
        <div class="container-fluid">
            <div class="card-slider pt-5 ">
                <?php
                $qry = "select * from course_details ORDER BY up_date desc";
                $resultset = mysqli_query($link, $qry);
                $x = 0;
                while ($row = mysqli_fetch_assoc($resultset) and $x != 6) {
                    $qry2 = "select * from adm_details where a_id=$row[a_id]";
                    $resultset2 = mysqli_query($link, $qry2);
                    $row2 = mysqli_fetch_assoc($resultset2);
                ?>
                    <div class="col-lg-12">
                        <div class="card w-100 m-5 p-2" style="min-width: 30%; box-shadow:  2px 2px 22px 1px #a2a2a2;">
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
                                <a href="./contentPage.php?pid=<?php echo $row['c_id'] ?>" class="btn btn-primary">Explore More</a>
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
</section>

<section>
    <div class="container-fluid p-5 b">
        <h2>Areas Of Interest</h2>
        <div class="card-deck p-3">
            <?php
            $qry = "select * from category";
            $resultset = mysqli_query($link, $qry);
            while ($row = mysqli_fetch_assoc($resultset)) {
            ?>
                <div class="card p-4 mb-4" style="min-width: 30%; box-shadow:  2px 2px 22px 1px #a2a2a2;">
                    <div class="card-body">
                        <a href="./display.php?id=<?php echo $row['cat_id']; ?>">
                            <h5 class="card-title"><?php echo $row['cat_name']; ?></h5>
                        </a>
                    </div>
                </div>
            <?php
            }
            ?>
        </div>
    </div>
</section>
<div class="fixed-bottom p-4 m-2" style="background-color: black; width: 4.5%; height: auto;">
    <a href="#top"><i class="fa-solid fa-arrow-up fa-2xl" style="color: #ffffff;"></i></a>
</div>
<?php
mysqli_close($link);
include_once("./footer.php");
include_once("./Foot.php");
?>