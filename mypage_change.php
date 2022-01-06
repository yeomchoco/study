<?php
    session_start();
    include 'db.inc';

    if(!isset($_SESSION['id']) || !isset($_SESSION['name'])){
        echo "<script>alert('비회원입니다!');";
        echo "window.location.href=\"../main.php\";</script>";
    }

    $id = $_SESSION['id'];
    $sql = "SELECT * FROM member WHERE id='$id'";
    $res = mysqli_fetch_array(mysqli_query($conn, $sql));
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Mypage</title>
    <script>
        function find_address(){
            url = "address.php";
            window.open(url,"address",'width=500, height=500, scrollbars=no, resizable=no');
        }
        function auth(){
                var id = '<?=$_SESSION['id']?>';
                url = "mypage_check_pw.php";
                window.open(url,"auth","width=600,height=400");
        }
        function change(){
            document.getElementById('name').disabled = false;
            document.getElementById('phone').disabled = false;
            document.getElementById('email').disabled = false;
            document.getElementById('address').disabled = false;
            document.getElementById('change_form').elements[1].focus();
            document.getElementById('change_btn').value = '확정하기';
            document.getElementById('change_btn').style.background = 'hotpink';
            document.getElementById('change_btn').setAttribute('onclick','decide()');
        }
        function decide(){
            confirm('변경 사항을 확정하시겠습니까?');
            document.getElementById('change_form').submit();
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
            top:8.5%;
        }
        .info {
            font-size:55px;
            line-height:75px;
            margin-bottom:30px;
            background:linear-gradient(to right, lightgray, gray, black);
            color: transparent;
            -webkit-background-clip: text;
        }
        .btn {
            text-align:right;
            position:relative;
            top:16.5%;
        }
        button {
            background-color:black;
            color:white;
            font-size:15px;
            width:80px;
            height:25px;
            margin-bottom:7px;
        }
        input[type=button] {
            background:black;
            color:white;
            font-size:15px;
            width:130px;
            height:33px;
        }
        .footer {
            float:left;
            width:1168.04px;
            text-align:center;
            color:white;
            background-color:black;
            padding:16px;
            position:relative;
            top:16.17%;
            font-size:23px;
        }
        input {
            width:350px;
            padding:10px;
            border:none;
            box-shadow: 0 0 5px 3px hotpink;
            font-size:21px;
        }
        input[type=button] {
            box-shadow:none;
        }
        table {
            border-collapse: collapse;
            width:500px;
            box-shadow: 0 0 5px 3px lightgray;
        }
        th, td {
            border:1px solid lightgray;
            padding:13px;
        }
        th {
            width:100px;
            color:black;
            font-size:23px;
            background-color:white;
        }
        td {
            text-align:left;
            font-size:23px;
        }
        input:disabled {
            box-shadow:0 0 5px 3px lightgray;
            color:darkgray;
        }
    </style>
</head>
<body>
<div class=box>
    <h1><a href=mypage.php>mypage</a></h1>
    <hr>
    <div class=nav>
        <ul>
            <li><a href="mypage_post.php">내가 쓴 글</a></li>
            <li><a href="mypage_like.php">공감한 글</a></li>
            <li><a href="mypage_change.php">내 정보 변경</a></li>
        </ul>
    </div>
    <div id=wrapper>
        <div class=info>CHANGE</div>
            <form id=change_form method=post action=mypage_change_ok.php>
                <table>
                    <tr>
                        <th>ID</th>
                        <td><?=$res['id']?></td>
                    </tr>
                    <tr>
                        <th>PW</th>
                        <td><input style="width:150px;box-shadow:0 0 5px 3px lightgray" type=button value='비밀번호 변경하기' onclick='auth()'></td>
                    </tr>
                    <tr>
                        <th>이름</th>
                        <td><input disabled type=text name=name id=name value='<?=$res['name']?>'></td>
                    </tr>
                    <tr>
                        <th>연락처</th>
                        <td><input disabled type=text name=phone id=phone value='<?=$res['phone']?>'></td>
                    </tr>
                    <tr>
                        <th>Email</th>
                        <td><input disabled type=text name=email id=email value='<?=$res['email']?>'></td>
                    </tr>
                    <tr>
                        <th>주소</th>
                        <td><input disabled type=text name=address id=address value='<?=$res['address']?>' onclick='find_address();'></td>
                    </tr>
                </table>
                <input style="margin:40px;width:125px;color:white;background:black" type=button onclick='change()' id=change_btn value=변경하기>
            </form>
    </div>
    <div class=footer>
    <?php
        $user_id = $_SESSION['id'];
        $user_name = $_SESSION['name'];
        echo "$user_name($user_id)님의 공간입니다";
    ?>
    </div>
    <div class=btn>
        <button onclick="window.location.href='main.php'">메인으로</button>
    </div>
</div>
</body>
</html>
