<?php
include_once("./a_header.php");
include_once("./a_nav.php");
$link = mysqli_connect(hostname: "localhost", username: "root", password: "", database: "project");
$id = $_SESSION['id'];
$result = "";
extract($_POST);
if (isset($addcat)) {
  $qry = "insert into category(cat_name) values('$newcat')";
  $row = mysqli_query($link, $qry);
}
if (isset($addscat)) {
  if (isset($_SESSION['cat'])) {
    $qry = "insert into sub_category(sub_cat_name, cat_id) values('$newscat', $_SESSION[cat])";
  }else{
  $de = "";
  foreach ($cat as $d) {
    $de .= "'$d'" . ",";
  }
  $de = trim($de, ",");
  $qry = "insert into sub_category(sub_cat_name, cat_id) values('$newscat', $de)";
} 
  $row = mysqli_query($link, $qry);
}
?>
<section>
  <div class="row">
    <div class="col-lg-3 col-md-2 col-sm-1"></div>
    <div class="col-lg-6 col-md-8 col-sm-10 main bg-light text-dark table-responsive p-5 m-5" style="border-radius: 10px; box-shadow: 0 0 15px 0 #757474;">
      <form name="form1" method="post" enctype="multipart/form-data">
        <table class="table table-borderless">
          <tr>
            <td colspan="4">
              <h1>UPLOAD NEW</h1>
            </td>
          </tr>
          <tr>
            <td colspan="2">SUBJECT:</td>
            <td colspan="2">
              <ul class="ul">
                <?php
                $qry = "select * from category";
                $row = mysqli_query($link, $qry);
                while ($row2 = mysqli_fetch_assoc($row)) {
                ?>
                  <li><input type="checkbox" name="cat[]" value="<?php echo $row2['cat_id']; ?>" id=" chk1a" class="chk mr-3" /><label for="chk1a"><?php echo $row2['cat_name']; ?></label></li>
                <?php
                }
                ?>
                <li><input type="text" name="newcat" placeholder="New Category" class="mt-3 p-2 rounded-lg" /> <button type="submit" name="addcat" class="btn btn-dark m-3">ADD NEW CATEGORY</button></li>
                <li><button type="submit" name="cate" class="btn btn-dark">Confirm</button></li>
              </ul>
            </td>
          </tr>
          <tr>
            <td colspan="2">SUBJECT:</td>
            <td colspan="2">
              <ul class="ul">
                <?php 
                extract($_POST);
                if (isset($cate)) {
                  $de = "";
                  if(empty($cat)){
                    if(isset($_SESSION['cat'])){
                      $qry = "select * from sub_category where cat_id in ($_SESSION[cat])";
                    }
                    else{
                      $qry = "select * from sub_category";
                    }
                  }else{
                  foreach ($cat as $d) {
                    $de .= "'$d'" . ",";
                  }
                  $de = trim($de, ",");
                  $_SESSION["cat"] = $de;
                  $qry = "select * from sub_category where cat_id in ($de)";
                }
                  $row = mysqli_query($link, $qry);
                  while ($row2 = mysqli_fetch_assoc($row)) {
                ?>
                    <li><input type="checkbox" name="scat[]" value="<?php echo $row2['sub_cat_id']; ?>" id="chk1a" class="chk mr-3" /><label for="chk1a"><?php echo $row2['sub_cat_name']; ?></label></li>
                <?php
                  }
                }
                ?>
                <li><input type="text" name="newscat" placeholder="New Subject" class="mt-3 p-2 rounded-lg" /> <button type="submit" name="addscat" class="btn btn-dark m-3">ADD NEW SUBJECT</button></li>
              </ul>
            </td>
          </tr>
          <tr>
            <td colspan="2">COURSE TITLE:</td>
            <td colspan="2" align="center"><input type="text" name="title" class="p-3 border-0 input" placeholder="Course Title" /></td>
          </tr>
          <tr>
            <td colspan="2">THUMBNAIL IMAGE:</td>
            <td colspan="2" align="center"><input type="file" name="img" class="p-3 border-0 input" placeholder="Browse" /></td>
          </tr>

          <tr>
            <td colspan="2">PRICE:</td>
            <td colspan="2" align="center"><input type="number" name="price" class="p-3 border-0 input" placeholder="000" /></td>
          </tr>
          <tr>
            <td colspan="2">DESCRIPTION:</td>
            <td colspan="2" align="center"><input type="text" name="desc" class="p-3 border-0 input" placeholder="Add description" /></td>
          </tr>
          <tr>
            <td colspan="2">NOTES:</td>
            <td colspan="2" align="center"><input type="file" name="notes" class="p-3 border-0 input" placeholder="Browse" /></td>
          </tr>
          <tr>
            <td colspan="4" align="center">
              <button type="submit" class="btn btn-success m-4 pl-4 pr-4" name="subtn">Create</button>
              <button type="submit" class="btn btn-secondary m-4 pl-4 pr-4" name="cancle">Cancle</button>
            </td>
          </tr>
          <!-- <tr>
            <?php
            echo $result;
            ?>
          </tr> -->

        </table>
      </form>
    </div>
    <div class="col-lg-3 col-md-2 col-sm-1"></div>
  </div>
</section>
<?php
extract($_POST);
if (isset($subtn)) {
  $de = "";
  foreach ($cat as $d) {
    $de .= "'$d'" . ",";
  }
  $de = trim($de, ",");
  $sde = "";
  foreach ($scat as $d) {
    $sde .= "'$d'" . ",";
  }
  $sde = trim($sde, ",");
  include_once("./imgvarification.php");
  $imgPath = uploadImage();
  include_once("./filevarfication.php");
  $notesPath = uploadNotes();
  $qry5 = "SELECT CURRENT_DATE();";
  $row3 = mysqli_query($link, $qry5);
  $date = mysqli_fetch_assoc($row3);
  $date1 = $date['CURRENT_DATE()'];
  $qry = "INSERT INTO course_details(c_name, a_id, price, description, notes_url, cat_id, sub_cat_id, img_url, users, up_date) values('$title', '$id', '$price', '$desc', '$notesPath', $de, $sde, '$imgPath', 0, $date1)";
  $c = mysqli_query($link, $qry);

  if ($c) {
    $qry2 = "select c_id from course_details where c_name='$title' and a_id=$id";
    $resultset = mysqli_query($link, $qry2);
    $row = mysqli_fetch_assoc($resultset);
?>
    <script type="text/javascript">
      window.location = "./a_lecture.php?cid=<?php echo $row['c_id']; ?>";
    </script>
    <!-- header("location: ./a_lecture.php"); -->
<?php
  }
  mysqli_close($link);
}

include_once("../footer.php");
include_once("../Foot.php");
?>