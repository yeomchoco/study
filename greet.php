<!DOCTYPE html>
<?php session_start(); ?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Greet</title>
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
            var name = '<?=$_SESSION['name']?>';
            if(!id||!name){
                alert('비회원입니다!');
                return;
            }
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
            width:1200px; height:800px;
            margin-left:-600px;
            margin-top:-460px;
            /* border:10px solid black; */
            padding:1px 1px;
        }
        h1 {
            font-size:45px;
            width:1170px;;
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
        #wrapper {
            width:500px;
            margin:auto;
            text-align:center;
            position:relative;
            top:35%;
        }
        .info {
            font-size:55px;
            line-height:50px;
            position:relative;
        }
        button {
            background-color:black;
            color:white;
            font-size:15px;
            width:90px;
            height:25px;
            margin-bottom:7px;
        }
        .footer {
            float:left;
            width:1168.04px;
            text-align:center;
            color:white;
            background-color:black;
            padding:16px;
            position:relative;
            top:79.4%;
            font-size:23px;
        }
    </style>
</head>
<body>
<div class=box>
    <h1><a href="main.php">my web</a></h1>
    <hr>
    <div class=nav>
        <ul>
            <li><a href="javascript:void(0);" onclick="auth_board();">Board</a></li>
            <li><a href="qna.php">QnA</a></li>
            <li><a href="javascript:void(0);" onclick="auth();">Mypage</a></li>
        </ul>
    </div>
    <div id=wrapper>
    <div class=info>WELCOME</div>
    <?php
        if(!isset($_SESSION['id']) || !isset($_SESSION['name'])) {
            echo "<button onclick=\"window.location.href='login.php'\">로그인</button> <button onclick=\"window.location.href='join.php'\">회원가입</button><br><a href='main.php' style='color:black;font-size:15px;'>ELSE, 비회원으로 계속하기</a>";
        } else {
            $user_id = $_SESSION['id'];
            $user_name = $_SESSION['name'];
            echo "<p>$user_name($user_id)님 환영합니다!</p><button onclick=\"window.location.href='logout.php'\" style='margin:5px;'>로그아웃</button>";
        }
    ?>
    </div>
    <div class=footer>
        <a href='greet.php'>안녕하세요</a>
    </div>
</div>
</body>
</html>