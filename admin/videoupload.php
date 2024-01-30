<?php
function uploadURL()
{
    if (isset($_POST["subtn"])){
        extract($_POST);
    $res = "";
    $lurlPath = "";

    if ($_FILES["lurl"]["error"] == 0) {
       $arr = array("mp4", "wvm", "mvk", "mov");        
        $a = explode("/", $_FILES["lurl"]["type"]);
        if (in_array(end($a), $arr)) {
            $tmp = $_FILES["lurl"]["tmp_name"];
            $final_path = $_SERVER["DOCUMENT_ROOT"] . "/SkillVantage/uploadData/" . $_FILES["lurl"]["name"];
            $lurlPath = "./uploadData/" . $_FILES["lurl"]["name"];
            move_uploaded_file($tmp, $final_path);
            $res = "File Updated Successfully";
            // echo "fvgbhjnm",$final_path;
            // echo "cfvgbhnj",$lurlPath;
            return $lurlPath;
        } else {
            $res = "Invalid File Type";
        }
    } else {
        $res = "Retry";
    }
}
}
