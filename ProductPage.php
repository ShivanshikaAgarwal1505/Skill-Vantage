<?php
include_once("./Header.php");
include_once("./Nav.php");
include_once("./sessionCheck.php");
$link = mysqli_connect(hostname: "localhost", username: "root", password: "", database: "project");
$qry = "select * from lecture_details where l_id=$_GET[cid]";
$resultset = mysqli_query($link, $qry);
$row = mysqli_fetch_assoc($resultset);
$qry1 = "select * from course_details where c_id=$row[c_id]";
$resultset1 = mysqli_query($link, $qry1);
$row1 = mysqli_fetch_assoc($resultset1);
$qry2 = "select * from adm_details where a_id=$row1[a_id]";
$resultset2 = mysqli_query($link, $qry2);
$row2 = mysqli_fetch_assoc($resultset2);
?>

<div class="container-fluid p-5">
    <h2><?php echo $row['l_name']; ?></h2>
    <div class="row mt-3" style="box-shadow: 0 0 15px 0 #b7b7b7; border-radius: 10px;">
        <div class="col-xl-8 col-lg-8 col-md-8 p-2">
            <video width="100%" class="rounded img-fluid mx-3 mt-3" controls>
                <source src="<?php echo $row['l_url']; ?>" type="video/mp4">
                Your browser does not support HTML video.
            </video>
            <div class="container mb-5">
                <div class="container-fluid">
                    <div class="row">
                        <div id="overview" class="col-sm-6 heading">
                            <h1 class="mb-0"><strong>Overview</strong></h1>
                        </div>
                        <div id="notes" class="col-sm-6 heading">
                            <h1 class="mb-0"><strong>Notes</strong></h1>
                        </div>
                    </div>
                </div>

                <div id="ov" class="container-fluid tab-content pt-3">
                    <ul list-style-type="none" class="ul">
                        <li>
                            <h4><a href="./contentPage.php?pid=<?php echo $row1['c_id']; ?>" style="text-decoration: none;"><?php echo $row1['c_name']; ?></a></h4>
                        </li>
                        <li>by <?php echo $row2['a_fname'] . " " . $row2['a_lname']; ?></li>
                        <li><?php echo $row1['description']; ?></li>
                        <li><?php echo $row1['users'] . " users"; ?></li>
                        <li>No. of Lectures: <?php echo $row1['price'] . " Rs."; ?></li>
                        <li class="mt-5">
                            <input type="hidden" value="SkillVantage//ProductPage.php?cid=10020" id="link">
                            <button class="btn btn-light mr-5 p-2 cpb" onclick="share()"><i class="fa-solid pr-3 fa-share fa-xl cpi"></i>Copy Link</button>
                            <a href="<?php echo $row['l_url']; ?>" download="<?php echo $row['l_name'] . " " . $row1['c_name']; ?>" class="btn btn-light mr-5 p-2 cpb ml-5"><i class="fa-solid pr-3 fa-download fa-xl cpi"></i>DOWNLOAD</a>
                        </li>
                    </ul>
                </div>
                <div id="nt" class="container-fluid tab-content mt-3">
                    <ul class="ul">
                        <li>
                            <h4>NOTES</h4>
                        </li>
                        <li>
                            <a href="<?php echo $row1['notes_url']; ?>" download="<?php echo $row1['c_name'] . ' notes'; ?>" class="btn btn-light p-2 cpb"><i class="fa-solid pr-3 fa-download fa-xl cpi"></i>DOWNLOAD</a>
                        </li>
                        <li class="mt-3">
                            <div class="border-dark">
                                <?php
                                // $file=$row1['notes_url'];
                                // $myfile = fopen($file, "r");
                                // $handel=fread($myfile, filesize($file));
                                // echo $handel;                            
                                // fclose($myfile);
                                ?>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="col-xl-4 col-lg-4 col-md-4 mb-3 table-responsive mt-2">
            <table class="table m-0 table-bordered table-striped table-hover table-light">
                <tr>
                    <td class="font-weight-bold" colspan="2">
                        <h5>CONTENT</h5>
                    </td>
                </tr>
                <?php
                $qry3 = "select * from lecture_details where c_id=$row[c_id]";
                $resultset3 = mysqli_query($link, $qry3);
                while ($row3 = mysqli_fetch_assoc($resultset3)) {
                ?>
                    <tr>
                        <td><?php echo $row3['l_num']; ?></td>
                        <td><a href="./ProductPage.php?cid=<?php echo $row3['l_id']; ?>" style="text-decoration:none; color:black"><?php echo $row3['l_name']; ?></a></td>
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
            $qry = "select * from course_details where cat_id=$row1[cat_id]";
            $resultset = mysqli_query($link, $qry);
            $x = 0;
            while ($row = mysqli_fetch_assoc($resultset) and $x != 10) {
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
<hr>
<div class="container-fluid p-5">
    <h1>By Same Author</h1>
    <div class="container-fluid">
        <div class="card-slider pt-5 ">
            <?php
            $qry = "select * from course_details where a_id=$row1[a_id]";
            $resultset = mysqli_query($link, $qry);
            $x = 0;
            while ($row = mysqli_fetch_assoc($resultset) and $x != 10) {
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

<script>
    let ovEl = document.getElementById("overview");
    ovEl.addEventListener("click", function() {
        openTab("ov")
    }, false);
    let ntEl = document.getElementById("notes");
    ntEl.addEventListener("click", function() {
        openTab("nt")
    }, false);

    function share() {
        var copyText = document.getElementById("link");
        copyText.select();
        navigator.clipboard.writeText(copyText.value);
        alert("Copied the text: " + copyText.value);
    }
</script>
<?php
include_once("./footer.php");
?>
<?php
include_once("./Foot.php");
?>