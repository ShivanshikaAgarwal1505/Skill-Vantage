<?php
function uploadNotes()
{
    if (isset($_POST["subtn"])){
        extract($_POST);
    $res = "";
    $notesPath = "";

    if ($_FILES["notes"]["error"] == 0) {
       //$arr = array("mp4", "wvm", "mvk", "mov");
        $arr = array("docx", "pdf", "txt");
        $a = explode("/", $_FILES["notes"]["type"]);
        if (in_array(end($a), $arr)) {
            $tmp = $_FILES["notes"]["tmp_name"];
            $final_path = $_SERVER["DOCUMENT_ROOT"] . "/SkillVantage/uploadData/" . $_FILES["notes"]["name"];
            $notesPath = "./uploadData/" . $_FILES["notes"]["name"];
            move_uploaded_file($tmp, $final_path);
            $res = "File Updated Successfully";
            // echo "fvgbhjnm",$final_path;
            // echo "cfvgbhnj",$notesPath;
            return $notesPath;
        } else {
            $res = "Invalid File Type";
        }
    } else {
        $res = "Retry";
    }
}
}?>