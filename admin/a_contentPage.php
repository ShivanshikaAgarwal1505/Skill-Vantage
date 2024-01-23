<?php
include_once("./a_header.php");
include_once("./a_nav.php");
$link = mysqli_connect(hostname: "localhost", username: "root", password: "", database: "project");
$qry = "select * from course_details where c_id=$_GET[pid]";
$resultset = mysqli_query($link, $qry);
$row = mysqli_fetch_assoc($resultset);
$qry2 = "select * from adm_details where a_id=$row[a_id]";
$resultset2 = mysqli_query($link, $qry2);
$row2 = mysqli_fetch_assoc($resultset2);
?>

<div class="container-fluid p-5">
    <form method="post">
        <h2><input style="border: none; width: 500px;" type="text" name="title" value="<?php echo $row['c_name']; ?>" /></h2>
        <div class="row" style="box-shadow: 0 0 15px 0 #b7b7b7; border-radius: 10px;">
            <div class="col-lg-8 p-2">
                <img src="<?php echo ".".$row['img_url']; ?>" width="100%" class="img-fluid rounded mb-4"></img>
                <div class="container mb-5">
                    <ul list-style-type="none" class="ul">
                        <li>by <?php echo $row2['a_fname'] . " " . $row2['a_lname']; ?></li>
                        <li><input style="border: none; width: 400px;" type="text" name="desc" value="<?php echo $row['description']; ?>" /></li>
                        <li><?php echo $row['users'] . " users"; ?></li>
                        <li>Price: Rs.<input style="border: none; width: 400px;" type="number" name="price" value="<?php echo $row['price']; ?>" /></li>
                        <li>No. of Lectures: <?php echo $row['l_num']; ?></li>
                    </ul>

                </div>
                <button type="submit" name="update" class="btn btn-success px-5  mr-5 mt-1 float-right">UPDATE</button>
            </div>
            <div class="col-lg-4 mb-3 table-responsive mt-2">
                <table class="table m-0 table-bordered table-striped table-hover table-light">
                    <tr>
                        <td class="font-weight-bold" colspan="2">
                            <h5>CONTENT</h5>
                        </td>
                        <td>
                            <a href="./a_lecture.php?cid=<?php echo $_GET['pid']; ?>" class="btn btn-dark float-right  px-4 py-2" style="box-shadow:  2px 2px 12px 1px #a2a2a2;"><i class="fa-solid fa-plus" style="color: #e6e6e6;"></i></a>
                        </td>
                    </tr>
                    <?php
                    $qry3 = "select * from lecture_details where c_id=$_GET[pid]";
                    $resultset3 = mysqli_query($link, $qry3);
                    while ($row3 = mysqli_fetch_assoc($resultset3)) {
                        extract($_POST);
                        if (isset($delete)) {
                            $qry4 = "DELETE FROM lecture_details WHERE l_id=$lid";
                            $resultset4 = mysqli_query($link, $qry4);
                            $qry6 = "UPDATE course_details SET l_num=$row[l_num]-1  WHERE c_id=$_GET[pid]";
                            $c = mysqli_query($link, $qry6);
                            echo "<meta http-equiv='refresh' content='0'>";
                        }
                    ?>
                        <tr>
                            <td><?php echo $row3['l_num']; ?></td>
                            <form method="post">
                                <td><input type="hidden" name="lid" value="<?php echo $row3['l_id']; ?>"/> <a href="../ProductPage.php?cid=<?php echo $row3['l_id']; ?>"><?php echo $row3['l_name']; ?></a></td>
                                <td>
                                    <button type="submit" name="delete" class="btn btn-danger float-right px-4 py-2" style="box-shadow:  2px 2px 12px 1px #a2a2a2;"><i class="fa-solid fa-trash" style="color: #ebebeb;"></i></button>
                                </td>
                            </form>
                        </tr>
                    <?php

                    }
                    ?>
                </table>
            </div>
        </div>
    </form>
</div>

<?php
extract($_POST);
if (isset($update)) {
    $qry5 = "UPDATE course_details SET c_name='$title', description='$desc', price=$price WHERE c_id=$_GET[pid]";
    $c = mysqli_query($link, $qry5);
    if ($c) {
        echo "<meta http-equiv='refresh' content='0'>";
    }
}
include_once("../footer.php");
include_once("./a_foot.php");
?>