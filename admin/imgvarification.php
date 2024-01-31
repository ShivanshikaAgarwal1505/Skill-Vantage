<?php
function uploadImage(){
    $res= "";
    $imgPath="";
    
    if($_FILES["img"]["error"]==0){
        $arr= array("jpeg", "jpg", "png", "gif");
        $a=explode("/",$_FILES["img"]["type"]);
        if(in_array(end($a), $arr)){
            $tmp= $_FILES["img"]["tmp_name"];
            $finalpath = $_SERVER["DOCUMENT_ROOT"]. "/SkillVantage/uploadData/".$_FILES["img"]["name"];
            $imgPath="./uploadData/".$_FILES["img"]["name"];
            move_uploaded_file($tmp, $finalpath);
            $res="File Updated Successfully";
            return $imgPath;
        }
        else{
            $res="Invalid File Type"; 
        }
    }
    else{
        $res="Retry";
    }
}
