<?php
    require_once("common.php");
    require_once("common/html_functions.php");
    $now = isset($_GET['page_id']) ? $_GET['page_id'] : 1;
    $member = $dbm->get_allstudents();
    show_top();

    //　ページング処理
    define('MAX','10'); // 1ページの記事の表示数
    $students_num = count($member); // トータルデータ件数
    $max_student = ceil($students_num / MAX); // トータルページ数※ceilは小数点を切り捨てる関数
    // 配列の何番目から取得すればよいか
    $start_no = ($now - 1) * MAX; 
    // array_sliceは、配列の何番目($start_no)から何番目(MAX)まで切り取る関数
    $disp_data = array_slice($member, $start_no, MAX, true);

    //  学生一覧の表示
    if ($disp_data != null) {
        show_student_list($disp_data);
    }
    echo "<a href=\"student_input.php\">新しい学生情報の追加</a>";
    show_bottom();
    echo "<br>";
    pasingDisplay($now, $max_student);
?>