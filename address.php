<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Address</title>
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
        input[type=button] {
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
        <h2 id=tt>도로명 주소 검색</h2>
        <form id='find_form' method="get" action="address_ok.php">
            <input hidden="hidden">
            <input name="address" id="addr" type=text autofocus placeholder="ex) 내손로, 내손로 14">
            <input onclick="auth()" type=button id='find_btn' value="검색">
        </form>
    </div>
</body>
</html>