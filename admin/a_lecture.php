<?php
include_once("./a_header.php");
include_once("./a_nav.php");
$link = mysqli_connect(hostname: "localhost", username: "root", password: "", database: "project");
$qry = "select * from course_details where c_id=$_GET[cid]";
$resultset = mysqli_query($link, $qry);
$row = mysqli_fetch_assoc($resultset);
$qry2 = "select * from adm_details where a_id=$row[a_id]";
$resultset2 = mysqli_query($link, $qry2);
$row2 = mysqli_fetch_assoc($resultset2);
?>
<section>
    <div class="container-fluid p-5 m-5">
        <h1><?php echo $row['c_name']; ?></h1>
        <img class="img-fluid float-right mr-5" alt="thumbnail img" src="<?php echo ".".$row['img_url']; ?>" width="200px" />
        <ul class="ul">
            <li>by <?php echo $row2['a_fname'] . " " . $row2['a_lname']; ?></li>
            <li><?php echo $row['description']; ?></li>
            <li><?php echo $row['l_num'] . " Lectures"; ?></li>
            <li><?php echo $row['users'] . " users"; ?></li>
            <li><?php echo $row['price'] . " Rs."; ?></li>
        </ul>
        <hr>
        <form name="form1" method="post" enctype="multipart/form-data">
            <div class="row">
                <div class="col-xl-1 col-lg-1 col-md-1">
                </div>
                <div class="col-xl-9 col-lg-9  col-md-9">
                    <h2>Add Lecture</h2>
                    <div class="table-responsive">
                        <table class="table table-stripped">
                            <thead>
                                <tr>
                                    <td>Lecture No.</td>
                                    <td>Lecture Title</td>
                                    <td>Upload Flie</td>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td><input type="number" name="lno" class="p-3 border-0" value="<?php echo ($row['l_num'] + 1); ?>" required /></td>
                                    <td><input type="text" name="ltitle" class="p-3 border-0" placeholder="Lecture Title" required /></td>
                                    <td><input type="file" name="lurl" class="p-3 border-0" placeholder="Video File" required /></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="col-xl-2 col-lg-2 col-md-2">
                    <button type="submit" name="subtn" class="btn btn-info ml-5"><i class="fa-solid fa-plus fa-lg mr-3" style="color:#fff"></i>New</button>
                </div>
            </div>
        </form>
    </div>
</section>
<?php

extract($_POST);
if (isset($subtn) ) {
    include_once("./videoupload.php");
    $vid = uploadURL();
    $qry5 = "SELECT CURDATE();";
    $row3 = mysqli_query($link, $qry5);
    $date = mysqli_fetch_assoc($row3);
    $date1 = $date['CURDATE()'];
    $qry3 = "INSERT INTO lecture_details(l_num, l_name, l_url, up_date, c_id)  values($lno, '$ltitle', '$vid', $date1, $_GET[cid])";
    $lnum = $row['l_num'] + 1;
    $qry4 = "UPDATE course_details SET l_num=$lnum WHERE c_id=$_GET[cid]";
    $c1 = mysqli_query($link, $qry3);
    $c2 = mysqli_query($link, $qry4);
    mysqli_close($link);
    echo "<meta http-equiv='refresh' content='0'>";
}
include_once("../footer.php");
?>
<?php
include_once("../Foot.php");
?>