<?php
    session_start();
    if(!isset($_SESSION['id']) || !isset($_SESSION['name'])) {
        echo "<script>alert('비회원입니다!');";
        echo "window.location.replace('main.php');</script>";
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Write</title>
</head>
<body>
    <h2>글쓰기</h2>
    <form method="post" action="write_ok.php" autocomplete="off">
        <p><input type=text size=25 name=title placeholder="제목" required></p>
        <hr width=250px align="left">
        <p><textarea cols=35 rows=15 name=content placeholder="내용을 입력하세요."></textarea></p>
        <p><input type="submit" value="글쓰기"></p>
    </form>
</body>
</html>