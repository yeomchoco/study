<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mypage</title>
    <script>
        function auth(){
            addr = document.getElementById('addr').value;
            form = document.getElementById("find_form");
            if(addr==""){
                alert('주소를 입력해주세요!');
                form.elements[0].focus();
                return;
            }
            form.submit();
            document.getElementById('tt').innerText = '검색 중입니다..';
            document.getElementById('addr').disabled = true;
            document.getElementById('find_btn').disabled = true;
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
        body {
            text-align:center
        }
        .wrapper {
            margin-top:70px;
        }
        .btn {
            background-color:black;
            color:white;
            font-size:20px;
            width:140px;
            height:35px;
            margin-bottom:7px;
            margin-top:10px;
        }
        input[type=submit] {
            background-color:black;
            color:white;
        }
        input {
            font-size:18px;
            padding:3px 5px;
        }
        input:disabled {
            background-color:lightgray;
            border:0;
        }
    </style>
</head>
<body onresize="parent.resizeTo(500,300)" onload="parent.resizeTo(500,300)">
    <div class=wrapper>
        <h2 id=tt>비밀번호를 입력하세요.</h2>
        <form method=post action=mypage_check.php>
            <input type=password required name=pw>
            <input type=submit value=확인></p>
        </form>
    </div>
</body>
</html>
<?php
    include 'db.inc';
    session_start();

    $pw = $_POST['pw'];
    $id = $_SESSION['id'];
    $sql = "SELECT * FROM member WHERE id='$id'";
    $res = mysqli_fetch_array(mysqli_query($conn, $sql));

    if(isset($_POST['pw'])){
        if($pw==$res['pw']){
            echo "<script>alert('마이페이지에 접근합니다.'); opener.parent.location.href='mypage.php'; window.close();</script>";
        } else {
            echo "<script>alert('비밀번호가 일치하지 않습니다.');</script>";
            exit;
        }
    }
?>