<?php
    //  HTML上部を表示する
    function show_top($heading="学生一覧") {
        echo <<<STUDENT_LIST
        <html>
            <head>
                <title>学生リスト</title>
            </head>
        <body>
            <h1>{$heading}</h1>
        STUDENT_LIST;
    }
    //  HTML下部を表示する
    function show_bottom($return_top=false) {
        //  $return_topがtrueなら、トップに戻るリンクを付ける
        if ($return_top == true) {
            echo <<<BACK_TOP
                <br>
                <br>
                <a href="index.php">学生一覧に戻る</a>
            BACK_TOP;
        }
        echo <<<BOTTOM
            </body>
        </html>
        BOTTOM;
    }
    //  入力フォームの表示
    function show_input() {
        $error = get_error();
        show_edit_input_common("", "" ,-1, "", "create", "登録");    
    }
    //  削除フォームの表示
    function show_delete($member) {
        if($member != null) {
            show_student($member);
        }
        $error = "";
        $error = get_error();
        echo <<<DELETE
            <form action="post_data.php" method="post">
                <p>この情報を削除しますか？</p>
                <p>{$error}</p> 
                <input type="hidden" name="id" value="{$member["id"]}"/>
                <input type="hidden" name="data" value="delete"/>
                <br>
                <br>
                <input type="submit" value="削除">
            </form>
        DELETE;        
    }
    //  更新フォームの表示
    function show_update($id, $name, $grade, $old_id) {
        show_edit_input_common($id, $name, $grade, $old_id, "update", "更新");
    }
    //  挿入フォーム・更新フォームの表示
    function show_edit_input_common($id, $name, $grade, $old_id, $data, $button){
        $error = "";
        $error = get_error();
        //  フォームの上部を表示
        echo <<<INPUT_TOP
        <form action="post_data.php" method="post">
            <p>学生番号</p>
            <input type="text" name="id" placeholder="例）1001" value="{$id}">
            <p>名前</p>
            <input type="text" name="name" placeholder="例）山田太郎" value="{$name}">
            <p>学年</p>
            <select name="grade">
        INPUT_TOP;
        //  optionタグの表示（選択されたものにはselectedをつける）
        for($i = 1; $i <= 3; $i++){
            echo "<option value=\"{$i}\"";
            if($i == $grade){
                echo " selected ";
            }
            echo ">";
            echo $i;
            echo "</option>";
        }
        //  フォームの下部を表示
        echo <<<INPUT_BOTTOM
            </select>
            <p>{$error}</p>
            <input type="hidden" name="old_id" value="{$old_id}">
            <input type="hidden" name="data" value="{$data}">
            <br>
            <br>
            <input type="submit" value="{$button}">
        </form>
        INPUT_BOTTOM;        
    }

    //  学生一覧を表示する
    function show_student_list($disp_data){
        //  テーブルのトップを表示
        echo <<<TABLE_TOP
        <table border="1" style="border-collapse:collapse">
            <tr>
                <th>学生番号</th><th width="100px">名前</th><th>学年</th>
            </tr>
        TABLE_TOP;
        foreach($disp_data as $val){
            //  ヒアドキュメントでデータを表示
            echo <<<END
                    <tr align="center">
                        <td>{$val['id']}</td>
                        <td><a href="student_edit.php?id={$val["id"]}">{$val["name"]}</a></td>
                        <td>{$val["grade"]}</td>
                    </tr>
            
            END;
        }
        //  テーブルの下部分の表示
        echo <<<TABLE_BOTTOM
        </table>
        <br>
        TABLE_BOTTOM;
    }
    //  特定の学生情報を表示する
    function show_student($member){
        //  テーブルのトップを表示
        echo <<<STUDENT
        <table border="1" style="border-collapse:collapse">
            <tr>
                <th>学生番号</th><th width="100px">名前</th><th>学年</th>
            </tr>
            <tr align="center">
                <td>{$member["id"]}</td>
                <td>{$member["name"]}</td>
                <td>{$member["grade"]}</td>
            </tr>
        </table>
        <br>
        STUDENT;
    }
    //  編集画面の操作の一覧の表示
    function show_operations($id){
        echo <<<OPERATIONS
        <a href="student_update.php?id={$id}">情報の更新</a>
            <br>
        <a href="student_delete.php?id={$id}">情報の削除</a>
    OPERATIONS;
    }

    //　ページ数表示
    function pasingDisplay($now, $max_student) {
        for($i = 1; $i <= $max_student; $i++){ // 最大ページ数分リンクを作成
            if ($i == $now) { // 現在表示中のページ数の場合はリンクを貼らない
                echo $now. ' '; 
            } else {
                echo "<a href='index.php?page_id={$i}'>{$i}</a>", ' ';
            }
        }
    }

?>
