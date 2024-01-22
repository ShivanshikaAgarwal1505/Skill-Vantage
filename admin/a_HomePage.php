<?php
include_once("./a_header.php");
include_once("./a_nav.php");

?>

<section class="container-fluid b" id="#top">
    <div class="text-light p-5" height="auto">
        <div class="row">
            <div class="col-lg-7 p-5">
                <div class="bold">WELCOME!!</div>
                <h3>Join Our Teachers Now and Contribute To Learning Of the Next Generation.</h3>
                <button class="btn p-2 mt-4" style="background-color: #17c9fc; color: #ffffff; font-size: larger; font-weight: bold; border-radius:7px;">Start Journey Now</button>
            </div>
            <div class="col-lg-5">
                <figure class="image titlt fig" data-tilt data-tilt-max="4">
                    <img src="../Images/banner-1.png" class="img-fluid mr-0">
                </figure>
            </div>
        </div>
    </div>
</section>

<section class="p-3">
    <h1>
        This Is You!!
    </h1>
    <h4>With SKILL, <?php echo $_SESSION["name"]; ?></h4>
    <div class="container-fluid">
        <div class="card-sliders ">
            <?php
            $link = mysqli_connect(hostname: "localhost", username: "root", password: "", database: "project");
            $id = $_SESSION['id'];
            echo $id;
            $qry = "select * from course_details where a_id=$_SESSION[id]";
            $resultset = mysqli_query($link, $qry);
            $count = mysqli_num_rows($resultset);
            while ($row = mysqli_fetch_assoc($resultset)) {
                $qry2 = "select * from adm_details where a_id=$row[a_id]";
                $resultset2 = mysqli_query($link, $qry2);
                $row2 = mysqli_fetch_assoc($resultset2);
            ?>
                <div class="col-lg-12">
                    <div class="card w-100 m-5 p-2" style="min-width: 30%; box-shadow:  2px 2px 22px 1px #a2a2a2;">
                        <img class="card-img-top" src="<?php echo ".".$row['img_url']; ?>" alt="Card image cap">
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
            }
            ?>
        </div>
        <?php
        if ($count == 0) {
            echo '<h4>Start Teaching</h4>';
            echo '<a href="./a_uploadNew.php" class="btn btn-primary mb-5"><h5>Start Classes</h5></a>';
        }
        ?>
    </div>
    <div class="alert text-light show fade" style="background-color: black; color: #fff;">
        <a href="#" class="btn btn-light close" data-dismiss="alert">&times;</a>
        <h2>Attention</h2>
        <p>Join our teaching staff and join 1000+ others.</p>
        <a class="btn btn-light" href="myTeaching.html">Join Now</a>
    </div>
</section>


<div class="fixed-bottom p-4 m-2" style="background-color: black; width: 4.5%; height: auto;">
    <a href="#top"><i class="fa-solid fa-arrow-up fa-2xl" style="color: #ffffff;"></i></a>
</div>
<?php
include_once("../footer.php");
?>
<?php
include_once("../Foot.php");
?>