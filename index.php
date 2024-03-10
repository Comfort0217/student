<?php
    require_once("common.php");
    require_once("common/html_functions.php");
    $now = isset($_GET['page_id']) ? $_GET['page_id'] : 1;
    $member = $dbm->get_allstudents();
    show_top();
    $disp_data = getDisp_data ($now, $member);
    //  学生一覧の表示
    if ($disp_data != null) {
        show_student_list($disp_data);
    }
    echo "<a href=\"student_input.php\">新しい学生情報の追加</a>";
    show_bottom();
    echo "<br>";

    $max_student = getMax_student ($member);
    pasingDisplay($now, $max_student);
?>