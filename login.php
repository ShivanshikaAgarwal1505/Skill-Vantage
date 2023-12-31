<!doctype html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">

  <!-- Icons -->
  <script src="https://kit.fontawesome.com/32d672e406.js" crossorigin="anonymous"></script>

  <!-- Font  use Google fonts-->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Dancing+Script:wght@500&family=Taprom&display=swap" rel="stylesheet">

  <!-- Custom CSS -->
  <link href="./project.css" rel="stylesheet" />
  <Title>SKILL VANTAGE-login</Title>
  
</head>

<body>
  <?php
  $result = "";
  extract($_POST);
  if (isset($subtn)) {
    $link = mysqli_connect(hostname: "localhost", username: "root", password: "", database: "project");
    $qry = "SELECT * FROM std_details WHERE s_email='$name' AND s_pass='$password'";
    $resultset = mysqli_query($link, $qry);
    $count = mysqli_num_rows($resultset);

    if ($count == 0)
      $result = "<div class='container-fluid alert alert-danger fade show'><a href='#' class='close' data-dismiss='alert'>&times;</a><h6>WARNING</h6>Invalid UserId or Password..!!</div>";
    elseif ($count == 1) {
      $r = mysqli_fetch_assoc($resultset);
      $nm = $r["s_fname"];
      $id = $r["s_id"];
      session_start();
      $_SESSION["name"] = $nm;
      $_SESSION["id"] = $id;
      header("location:./HomePage.php");
    }
  }
  if (isset($cancle)) {
    header("location:./HomePage.php");
  }
  ?>
  <section class="b">
    <div class="row">
      <div class="col-lg-4 col-md-1"></div>
      <div class="col-lg-4 col-md-10 main bg-light text-dark table-responsive p-5 m-5" style="border-radius: 10px; box-shadow: 0 0 15px 0 #757474;">
        <form name="form1" method="post">
          <table class="table table-borderless">

            <tr align="center">
              <td colspan="4">
                <h1>LOG IN</h1>
              </td>
            </tr>

            <tr align="center">
              <td colspan="2">EMAIL ID:</td>
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
                New User? <a href="Signup.php">Sign Up</a>
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
  include_once("./footer.php");
  ?>
  <?php
  include_once("./Foot.php");
  ?>