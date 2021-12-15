<?php
    session_start();
    if(!isset($_SESSION['id']) || !isset($_SESSION['name'])) {
        echo "<script>alert('비회원입니다!');";
        echo "window.location.replace('main.php');</script>";
    }

    $title = $_POST['title'];
    $content = $_POST['content'];
    $id = $_SESSION['id'];
    $name = $_SESSION['name'];
    $conn = mysqli_connect('localhost', 'choco', '7173', 'study');

    $sql = "INSERT INTO board(title, content, id, name, file, liked, hit, created) VALUES ('$title', '$content', '$id', '$name', '$filename', 0, 0, now());";

    $res = mysqli_query($conn, $sql);

    if($res) {
        echo "<script>alert('게시글이 작성되었습니다.');";
        echo "window.location.replace('board.php');</script>";
    } else {
        echo mysqli_error($conn);
    }
?>