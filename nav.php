<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Nav</title>
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
            width:80%;
        }
        .box {
            position:absolute;
            left:50%;
            width:1200px; height:650px;
            margin-left:-600px;
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
    </style>
</head>
<body>
<div class=box>
    <h1>my web</h1>
    <hr>
    <div class=nav>
        <ul>
            <li>Board</li>
            <li>QnA</li>
            <li>Mypage</li>
        </ul>
    </div>
</div>
</body>
</html>