<?php
if (!isset($_SESSION['id'])) {
?>
    <script type="text/javascript">
        window.location = "./login.php";
    </script>
<?php
    // header("location: login.php");
}
?>