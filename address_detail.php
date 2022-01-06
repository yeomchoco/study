<?php $full = $_GET['full']; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Address</title>
    <script>
        function my_addr(){
            var full = '<?=$full?>';
            var my_addr = full+" "+document.getElementById("detail").value;
            opener.document.getElementById("address").value = my_addr;
            window.close();
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
            margin-top:59px;
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
        <h2 id=tt>상세 주소</h2>
        <h4><?=$full?></h4>
        <form id='find_form' method="get" action="address_ok.php">
            <input hidden="hidden">
            <input id="detail" type=text required placeholder="상세 주소를 입력해주세요.">
            <input type=button value="확인" onclick="my_addr()">
        </form>
    </div>
</body>
</html>