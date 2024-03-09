<?php 

function check_input ($id,$name,$grade,&$error) {
    $error ="";
    //空欄がないかどうかのチェック
    if ($id == "" or $name =="") {
        $error = "入力されていない値があります";
        return false;
    }
    // idが正しく入力されているかチェック
    if (preg_match("/^[1-3][0-9]{3}$/", $id) != true) {
        $error = "idには1~3ではじまる4桁の整数を入力してください。";
        return false;
    }
    return true;
}

?>