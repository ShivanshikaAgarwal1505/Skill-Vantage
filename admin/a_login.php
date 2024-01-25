<?php
include_once("./a_header.php");
//include_once("./a_nav.php");
$result = "";
extract($_POST);
if (isset($subtn)) {
  $link = mysqli_connect(hostname: "localhost", username: "root", password: "", database: "project");
  $qry = "SELECT * FROM adm_details WHERE a_email='$name' AND a_pass='$password'";
  $resultset = mysqli_query($link, $qry);
  $count = mysqli_num_rows($resultset);

  if ($count == 0)
    $result = "<div class='container-fluid alert alert-danger fade show'><a href='#' class='close' data-dismiss='alert'>&times;</a><h6>WARNING</h6>Invalid UserId or Password..!!</div>";
  elseif ($count == 1) {
    $r = mysqli_fetch_assoc($resultset);
    $nm = $r["a_fname"];
    $id = $r["a_id"];
    session_start();
    $_SESSION["name"] = $nm;
    $_SESSION["id"] = $id;
    header("location:./a_HomePage.php");
  }
}
if (isset($cancle)) {
  header("location:./a_HomePage.php");
}
?>
<!-- <style>
        input, a, .modal-footer > button{
            border: 3px solid #40514E;
            border-radius: 5px;
            box-shadow: 3px 3px 7px 1px #242626;
        }
    </style>
  </head>
  <body> -->
<section>
  <div class="row">
    <div class="col-lg-4 col-md-1"></div>
    <div class="col-lg-4 col-md-10 main bg-light text-dark table-responsive p-5 m-5" style="border-radius: 10px; box-shadow: 0 0 15px 0 #757474;">
      <form name="form1" method="post">
        <table class="table table-borderless">

          <tr align="center">
            <td colspan="4">
              <h1>ADMIN LOG IN</h1>
            </td>
          </tr>

          <tr align="center">
            <td colspan="2">ADMIN ID:</td>
            <td colspan="2"><input type="text" name="name" class="p-3 border-0 input" placeholder="User Email" style="border-radius: 10px; box-shadow: 0 0 10px 0 #757474;" /><br /></td>
          </tr>
          <tr align="center">
            <td colspan="2">PASSWORD:</td>
            <td colspan="2"><input type="password" name="password" class="p-3 border-0 input" placeholder="Password" style="border-radius: 10px; box-shadow: 0 0 10px 0 #757474;" /><br /></td>
          </tr>
          <tr align="center">
            <td colspan="4">
              <button type="submit" class="btn btn-success m-4 pl-4 pr-4" name="subtn">Log In</button>
              <button type="submit" class="btn btn-secondary m-4 pl-4 pr-4" name="cancle">Cancle</button>
            </td>
          </tr>
          <tr align="center">
            <td colspan="4">
              New User? <a href="a_signup.php">Sign Up</a>
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
    <div class="col-lg-4 col-md-1"></div>
  </div>
</section>



<?php
include_once("../footer.php");
include_once("./a_foot.php");
?>