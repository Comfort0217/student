<?php 
try {
    //接続
    $db = new PDO('mysql:host=localhost;dbname=school', 'root', 'root');
    //更新するレコードの情報
    $id = 1001;
    $name = '山口太郎';
    //クエリ実行
    $stmt = $db->preapre("update student set name = ? where id = ?;");
    $stmt->bindParam(1, $name, PDO::PARAM_STR);
    $stmt->bindParam(2, $id, PDO::PARAM_INT);
    //SQLクエリ実行
    $res = $stmt->execute();
    //切断
    $db = null;
} catch (PDOException $e) {
    echo "データベース接続失敗";
    echo $e->getMessage();
}