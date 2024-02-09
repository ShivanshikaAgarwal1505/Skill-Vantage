<?php
include_once("./a_header.php");
include_once("./a_nav.php");
$link = mysqli_connect(hostname: "localhost", username: "root", password: "", database: "project");
$id = $_SESSION['id'];
extract($_POST);
if (isset($delete)) {
    $qry3 = "DELETE FROM course_details WHERE c_id=$delid";
    $qry4 = "DELETE FROM lecture_details WHERE c_id=$delid";
    $qry5 = "DELETE FROM purchase WHERE c_id=$delid";
    $qry6 = "DELETE FROM wishlist WHERE c_id=$delid";
    $qry7 = "DELETE FROM cart WHERE c_id=$delid";
    $resultset4 = mysqli_query($link, $qry4);
    $resultset4 = mysqli_query($link, $qry5);
    $resultset5 = mysqli_query($link, $qry6);
    $resultset6 = mysqli_query($link, $qry7);
    $resultset3 = mysqli_query($link, $qry3);

    echo "<meta http-equiv='refresh' content='0'>";
}

?>
<section>
    <div class="container-fluid p-5 m-5">
        <h1>Your course</h1>
        <div class="card-deck p-3">
            <?php
            $qry = "select * from course_details where a_id=$id";
            $resultset = mysqli_query($link, $qry);
            while ($row = mysqli_fetch_assoc($resultset)) {

                $qry2 = "select * from adm_details where a_id=$row[a_id]";
                $resultset2 = mysqli_query($link, $qry2);
                $row2 = mysqli_fetch_assoc($resultset2);
            ?>
                <div class="card p-2 mb-4" style="min-width: 30%; box-shadow:  2px 2px 22px 1px #a2a2a2;">
                    <img class="card-img-top" src="<?php echo "." . $row['img_url']; ?>" alt="Card image cap">
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
                        <form method="post">
                            <a href="./a_contentPage.php?pid=<?php echo $row['c_id'] ?>" class="btn btn-primary px-5" style="box-shadow:  2px 2px 12px 1px #a2a2a2;"><i class="fa-solid fa-pen-to-square mr-4" style="color: #ebebeb;"></i>Edit</a>
                            <input type="hidden" value="<?php echo $row['c_id'] ?>" name="delid">
                             <button type="submit" name="delete" class="btn btn-danger float-right px-4 py-2" style="box-shadow:  2px 2px 12px 1px #a2a2a2;"><i class="fa-solid fa-trash" style="color: #ebebeb;"></i></button>
                        </form>
                    </div>
                </div>
            <?php
            }
            ?>
        </div>
    </div>
</section>

<?php
mysqli_close($link);
include_once("../footer.php");
include_once("../Foot.php");
?>