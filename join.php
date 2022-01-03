<!DOCTYPE html>
<?php session_start(); ?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Join</title>
    <script>
        function check_id(){
            var userid = document.getElementById("id").value;
            if(userid)
            {
                url = "check.php?userid="+userid;
                window.open(url,"check","width=400,height=200");
            } else {
                alert("아이디를 입력하세요.");
            }
        }
        function decide(){
            document.getElementById("decide").innerHTML = "<span style='color:blue;'>사용 가능한 ID입니다! </span>"
            document.getElementById("decide_id").value = document.getElementById("id").value
            document.getElementById("id").disabled = true
            document.getElementById("join_button").disabled = false
            document.getElementById("check_button").value = "다른 ID로 변경"
            document.getElementById("check_button").setAttribute("onclick", "change()")
        }
        function change(){
            document.getElementById("decide").innerHTML = "<span style='color:red;'>ID 중복 여부를 확인해주세요! </span>"
            document.getElementById("id").disabled = false
            document.getElementById("id").value = ""
            document.getElementById("join_button").disabled = true
            document.getElementById("check_button").value = "ID 중복 검사"
            document.getElementById("check_button").setAttribute("onclick", "check_id()")
            join_form = document.getElementById("join_form")
            join_form.elements[0].focus();
        }
        function find_address(){
            url = "address.php";
            window.open(url,"address",'width=500, height=400, scrollbars=no, resizable=no');
        }
        function check_pw(){
            var pw = document.getElementById("pw").value
            var pw2 = document.getElementById("pw2").value
            var name = document.getElementById("name").value
            join_form = document.getElementById("join_form")
            if(!pw){
                window.alert("비밀번호를 입력해주세요!")
                join_form.elements[3].focus();
            }else{
                if(pw==pw2){
                    if(name){
                        join_form.submit();
                    }else{
                        window.alert("이름을 입력해주세요!")
                        join_form.elements[5].focus();
                    }
                }else{
                    window.alert("비밀번호가 일치하지 않습니다!")
                    document.getElementById("pw2").value = ""
                    join_form.elements[4].focus();
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
            top:8%;
        }
        .info {
            font-size:55px;
            line-height:75px;
        }
        button, input[type=submit] {
            background-color:black;
            color:white;
            font-size:15px;
            width:80px;
            height:25px;
            margin-bottom:7px;
            margin-top:10px;
        }
        input[type=button] {
            background-color:black;
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
            top:17.1%;
            font-size:23px;
        }
        input {
            width:370px;
            padding:10px;
            border:none;
            box-shadow: 0 0 5px 3px lightgray;
            font-size:21px;
        }
        input[type=button] {
            box-shadow:none;
        }
        table {
            border-collapse: collapse;
            width:498px;
        }
        th, td {
            border:1px solid black;
            padding:8px;
        }
        th {
            color:white;
            font-size:20px;
            background-color:black;
        }
        td {
            text-align:center;
            font-size:18px;
        }
    </style>
</head>
<body>
<div class=box>
    <h1><a href=main.php>my web</a></h1>
    <hr>
    <div class=nav>
        <ul>
            <li><a href="board.php">Board</a></li>
            <li><a href="qna.php">QnA</a></li>
            <li><a href="javascript:void(0);" onclick="auth();">Mypage</a></li>
        </ul>
    </div>
    <div id=wrapper>
        <div class=info>JOIN</div>
            <?php if(!isset($_SESSION['id']) || !isset($_SESSION['name'])) { ?>
            <form id="join_form" method="post" action="join_ok.php" autocomplete="off">
            <table>
                <tr>
                    <th>ID</th>
                    <td><input type="text" name="join_id" id="id" autofocus></td>
                </tr>
                <tr>
                    <th>❕</th>
                    <td><span id="decide" style='color:red;'>ID 중복 여부를 확인해주세요! </span><input type="button" id="check_button" value="ID 중복 검사" onclick="check_id();"></td>
                </tr>
                <input type="hidden" name="decide_id" id="decide_id">
                <tr>
                    <th>PW</th>
                    <td><input type="password" name="join_pw" id="pw"></td>
                </tr>
                <tr>
                    <th>PW 확인</th>
                    <td><input type="password" name="join_pw2" id="pw2"></td>
                </tr>
                <tr>
                    <th>이름</th>
                    <td><input type="text" name="join_name" id="name"></td>
                </tr>
                <tr>
                    <th>연락처</th>
                    <td><input type="text" name="join_phone"></td>
                </tr>
                <tr>
                    <th>Email</th>
                    <td><input type="email" name="join_email"></td>
                </tr>
                <tr>
                    <th>주소</th>
                    <td><input type="text" name="join_address" id="address" onclick="find_address();" placeholder="Find your address.."></td>
                </tr>
            </table>
            <p><input type="button" value="가입하기" id="join_button" onclick="check_pw();" disabled=true></p>
            </form>
            <?php } else {
                    $user_id = $_SESSION['id'];
                    $user_name = $_SESSION['name'];
                    echo "<p>$user_name($user_id)님은 이미 로그인되어 있습니다.</p>";
                    echo "<p><button onclick=\"window.location.href='main.php'\">메인으로</button> <button onclick=\"window.location.href='logout.php'\">로그아웃</button></p>";
            } ?>
    </div>
    <div class=footer>
    <?php
        if(!isset($_SESSION['id']) || !isset($_SESSION['name'])) {
            echo "<a href='login.php'>이미 회원이신가요?</a>";
        } else {
            $user_id = $_SESSION['id'];
            $user_name = $_SESSION['name'];
            echo "$user_name($user_id)님 안녕하세요";
        }
    ?>
    </div>
</div>
</body>
</html>
