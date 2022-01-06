<?php
    include 'db.inc';
    session_start();
    #비회원 접근 금지
    if(!isset($_SESSION['id']) || !isset($_SESSION['name'])) {
        echo "<script>alert('비회원입니다!');";
        echo "window.location.replace('login.php');</script>";
    }

    $id = $_SESSION['id'];
    $idx = $_GET['idx'];
    $sql = "SELECT * FROM board where idx=$idx";
    $res = mysqli_fetch_array(mysqli_query($conn, $sql));
    $hit = $res['hit'];

    #타인 조회 시 조회수 증가
    if($_SESSION['id'] != $res['id']){
        $sql2 = "UPDATE board SET hit=hit+1 WHERE idx=$idx";
        $res2 = mysqli_query($conn, $sql2);
        $hit += 1;
    }

    #좋아요 확인
    $sql3 = "SELECT * FROM like_manager WHERE post_idx=$idx and liker_id='$id'";
    $res3 = mysqli_fetch_array(mysqli_query($conn, $sql3));

    #좋아요 개수
    $sql4 = "SELECT * FROM like_manager WHERE post_idx=$idx";
    $res4 = mysqli_num_rows(mysqli_query($conn, $sql4));
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
                if(window.confirm("공개글로 설정하시겠습니까?")){
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
            height:670px;
            width:600px;
            margin:auto;
            text-align:center;
            position:relative;
            top:8.2%;
            z-index:-1;
        }
        .info {
            font-size:55px;
            line-height:50px;
            margin-bottom:30px;
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
            top:15.8%;
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
        .title, .whowhen {
            text-align:left;
        }
        .title {
            font-size:35px;
            margin-bottom:10px;
        }
        .whowhen {
        }
        .content {
            height:384px;
            font-size:23px;
            text-align:left;
            overflow:auto;
        }
        .gubun {
            background:black;
            width:600px;
            margin:auto;
            margin-top:10px;
            margin-bottom:10px;
        }
        .rm {
            text-align:right;
        }
        .down {
            text-align:left;
            margin-top:10px;
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
        <div class=info>BOARD</div>
        <div class=title><?=$res['title']?></div>
        <div class=whowhen><?=$res['name']?> | <?=$res['created']?> | 조회수 <?=$hit?> | 👍🏻 <?=$res4?></div>
        <hr class=gubun>
        <div class=content> <?php
            if($res['file']){ ?>
                <img style="box-shadow:0 0 5px 3px lightgray;margin-bottom:10px;" width=100% src="../file/upload/<?=$res['file']?>"> <?php
            } ?>
            <?=$res['content']?>
        </div>
        <div class=down><a style="color:hotpink" href="../file/upload/<?=$res['file'];?>"download><?=$res['file'];?></a></div>
        <hr class=gubun>
        <div class=rm><?php
            if($_SESSION['id']==$res['id']){ ?>
                <button onclick="window.location.href='board_update.php?idx=<?=$res['idx']?>'">수정</button>
                <button onclick="window.location.href='board_remove_ok.php?idx=<?=$res['idx']?>'">삭제</button> <?php
            } else {
                if($res3){ ?>
                    <button onclick="window.location.href='board_unlike_ok.php?idx=<?=$res['idx']?>'" style="background:darkgray;border:0">👍🏻 취소</button> <?php
                } else { ?>
                    <button onclick="window.location.href='board_like_ok.php?idx=<?=$res['idx']?>'" style="background:hotpink;border:0;">👍🏻 공감</button> <?php
                } 
            } ?>
        </div>
    </div>
    <div class=footer>
        게시글 조회
    </div>
</div>
</body>
</html>