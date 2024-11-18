<?php
    $dirpath="./files";
    include_once "function.php";
    $imgName=$_GET['file'];

    if(isset($_FILES['img'])){
        if($_FILES['img']['error']==0){
            move_uploaded_file($_FILES['img']['tmp_name'], $dirpath."/".$imgName);
        } else {
            echo "上傳失敗，請檢察檔案格式或是大小是否符合規定。";
        }
    }
    header("location:manage.php");
?>