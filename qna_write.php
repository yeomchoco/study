<!DOCTYPE html>
<?php
    session_start();
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>QnA</title>
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
        function key(){
            title = document.getElementById("title").value;
            content = document.getElementById("content").value;
            name = document.getElementById("name").value;
            phone = document.getElementById("phone").value;
            qnaform = document.getElementById("qnaform");
            if(!title){
                alert('제목을 입력해주세요!');
                qnaform.elements[0].focus();
                return;
            }
            if(!content){
                alert('내용을 입력해주세요!');
                qnaform.elements[1].focus();
                return;
            }
            if(!name){
                alert('이름을 입력해주세요!');
                qnaform.elements[2].focus();
                return;
            }
            if(!phone){
                alert('연락처를 입력해주세요!');
                qnaform.elements[3].focus();
                return;
            }
            if(document.getElementById("pw").value != ""){
                if(window.confirm("비밀글로 설정하시겠습니까?")){
                    qnaform.submit();
                }
            } else {
                if(window.confirm("공개글로 설정하시겠습니까? (공개글 설정 시 연락처 인증을 통해 문의글을 삭제할 수 있습니다.)")){
                    qnaform.submit();
                }
            }
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
            top:9%;
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
            top:15.4%;
            font-size:23px;
            z-index: 1;
        }
        .btn {
            text-align:right;
            position:relative;
            top:35.6%;
            z-index:-2;
        }
        button, input[type=submit], input[type=button] {
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
            margin-bottom:4px;
        }
        input[type=file] {
            position:relative;
            left:-3.5%;
        }
        #name, #phone, #pw {
            border:0;
            box-shadow:0 0 5px 3px lightgray;
            margin-bottom:4px;
            font-size:15px;
            padding:8px;
            width:150px;
            height:10px;
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
            <li><a href="qna.php">QnA</a></li>
            <li><a href="javascript:void(0);" onclick="auth();">Mypage</a></li>
        </ul>
    </div>
    <div class=wrapper>
        <div class=info>QnA</div>
        <form id=qnaform method="post" action="qna_write_ok.php" autocomplete="off">
            <div class=title><input type=text size=25 id="title" name="title" placeholder="제목" required></div>
            <div class=content><textarea cols=35 rows=15 id="content" name="content" placeholder="내용을 입력하세요." required></textarea></div>
            <p class=user><input id="name" type=text name="name" placeholder='* 이름' required><br>
            <input type=text id="phone" placeholder='* 연락처' name="phone" required><br>
            <input type=password name="pw" id="pw" placeholder='비밀번호'></p>
            <p><input type="button" onclick="key();" value="글쓰기"></p>
        </form>
        </div>
    <div class=footer>
        문의글 작성
    </div>
</div>
</body>
</html>