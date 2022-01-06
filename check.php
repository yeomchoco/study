<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ID 중복 검사</title>
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
            margin-top:65px;
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
    </style>
</head>
<body onresize="parent.resizeTo(500,300)" onload="parent.resizeTo(500,300)">
    <div class=wrapper>
    <?php
        $conn= mysqli_connect('localhost', 'choco', '7173', 'study');
        $uid= $_GET["userid"];
        $sql= "SELECT * FROM member where id='$uid'";
        $result = mysqli_fetch_array(mysqli_query($conn, $sql));

        if(!$result){
            echo "<h2><span style='color:blue;'>$uid</span> 는 사용 가능한 ID입니다.</h2>";
        ?><p><input class=btn type=button value="이 ID 사용" onclick="opener.parent.decide(); window.close();"></p>
            
        <?php
        } else {
            echo "<h2><span style='color:red;'>$uid</span> 는 중복된 ID입니다.</h2>";
            ?><p><input class=btn type=button value="다른 ID 사용" onclick="opener.parent.change(); window.close()"></p>
        <?php
        }
    ?>
    </div>
</body>
</html>
