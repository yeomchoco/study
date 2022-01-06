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
            margin-top:95px;
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
            margin-top:15px;
        }
        input {
            font-size:18px;
            padding:3px 5px;
        }
        input:disabled {
            background-color:lightgray;
            border:0;
        }
        .pw {
            margin-bottom: 5px;
        }
    </style>
</head>
<body onresize="parent.resizeTo(500,500)" onload="parent.resizeTo(500,500)">
    <div class=wrapper>
        <form method=post action='mypage_change_pw.php'>
            <h2 id=tt>현재 비밀번호를 입력하세요.</h2>
            <div class=pw><input type=password name=pw0 placeholder="현재 비밀번호" required></div>
            <h2 id=tt>새로운 비밀번호를 입력하세요.</h2>
            <div class=pw><input type=password name=pw1 placeholder="새로운 비밀번호" required></div>
            <div class=pw><input type=password name=pw2 placeholder="새로운 비밀번호 확인" required></div>
            <input type=submit value=변경>
        </form>
    </div>
</body>
</html>