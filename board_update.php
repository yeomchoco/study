<?php
    include 'db.inc';
    session_start();
    $idx = $_GET['idx'];
    $sql = "SELECT * FROM board where idx=$idx";
    $res = mysqli_fetch_array(mysqli_query($conn, $sql));
    if($_SESSION['id']!=$res['id']) {
        echo "<script>alert('권한이 없습니다!');";
        echo "history.back();</script>";
        exit;
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Board</title>
    <script>
        function auth_board(){
            var id = '<?=$_SESSION['id']?>';
            var name = '<?=$_SESSION['name']?>';
            if(!id||!name){
                alert('비회원입니다!');
                return;
            }
            window.location.href='board.php';
        }
        function auth(){
            var id = '<?=$_SESSION['id']?>';
            url = "mypage_check.php?id="+id;
            window.open(url,"auth","width=600,height=400");
        }
    </script>
    <style>
        @font-face {
            font-family: 'DungGeunMo';
            src: url('https://cdn.jsdelivr.net/gh/projectnoonnu/noonfonts_six@1.2/DungGeunMo.woff') format('woff');
            font-weight: normal;
            font-style: normal;
        }
        * {
            font-family: 'DungGeunMo';
        }
        a {
            text-decoration:none;
            color:white;
        }
        body {
            width:80%;
        }
        .box {
            position:absolute;
            top:50%; left:50%;
            width:1200px; height:650px;
            margin-left:-600px;
            margin-top:-460px;
            /* border:10px solid black; */
            padding:1px 1px;
            z-index:-1;
        }
        h1 {
            font-size:45px;
            width:1170px;
            margin:0 0;
            margin-right:0px;
            margin-top:1px;
            background-color:black;
            color:white;
            text-align:center;
            padding:15px;
        }
        .nav {
            float:left;
            width:1184.01px;
            text-align:center;
            color:white;
            background-color:black;
            padding:8px;
            z-index:1;
        }
        ul {
            list-style:none;
            padding:0 0;
            margin:0 0;
        }
        li {
            display:inline-block;
            padding-left:20px;
            padding-right:20px;
            font-size:20px;
        }
        hr {
            background-color:white;
            border:0;
            margin:0;
            height:2px;
        }
        .wrapper {
            width:1200px;
            margin:auto;
            text-align:center;
            position:relative;
            top:13%;
            z-index:-1;
        }
        .info {
            font-size:55px;
            line-height:50px;
            margin-bottom:50px;
            position:relative;
        }
        .footer {
            float:left;
            width:1168.04px;
            text-align:center;
            color:white;
            background-color:black;
            padding:16px;
            position:relative;
            top:26.3%;
            font-size:23px;
            z-index: 1;
        }
        .btn {
            text-align:right;
            position:relative;
            top:35.6%;
            z-index:-2;
        }
        button, input[type=submit] {
            background-color:black;
            color:white;
            font-size:15px;
            width:80px;
            height:25px;
            margin-bottom:7px;
        }
        td a {
            color:black
        }
        table {
            border-collapse:collapse;
            margin:auto;
            font-size:20px;
        }
        td, th {
            border-bottom:1px solid black;
            padding:10px;
            height:25px;
        }
        th {
            background-color:black;
            color:white;
        }
        .page a {
            color:black;
            font-size:20px;
        }
        .page {
            margin-top:25px;
            margin-bottom:25px;
        }
        .search {
            margin-bottom:7px;
        }
        input[type=text] {
            border:0;
            box-shadow:0 0 5px 3px lightgray;
            margin-bottom:4px;
            width:300px;
            height:20px;
            font-size:18px;
            padding:8px;
        }
        textarea {
            border:0;
            box-shadow:0 0 5px 3px lightgray;
            width:300px;
            height:300px;
            font-size:18px;
            padding:8px;
            resize:none;
        }
        input[type=file] {
            position:relative;
            left:-3.5%;
        }
    </style>
</head>
<body>
<div class=box>
    <h1><a href=main.php>my web</a></h1>
    <hr>
    <div class=nav>
        <ul>
            <li><a href="javascript:void(0);" onclick="auth_board();">Board</a></li>
            <li><a href="qna.php">Board</a></li>
            <li><a href="javascript:void(0);" onclick="auth();">Mypage</a></li>
        </ul>
    </div>
    <div class=wrapper>
        <div class=info>Update</div>
        <form method="post" action="board_update_ok.php?idx=<?=$idx?>" enctype="multipart/form-data" autocomplete="off">
            <div class=title><input type=text size=25 name=title value='<?=$res['title']?>' placeholder="제목" sqluired></div>
            <div class=content><textarea cols=35 rows=15 name=content placeholder="내용을 입력하세요."><?=$res['content']?></textarea></div>
            <p><input class=file id="input-file" type=file name=file></p>
            <p><input type="submit" value="글쓰기"></p>
        </form>
    </div>
    <div class=footer>
        게시글 작성
    </div>
</div>
</body>
</html>