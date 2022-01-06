<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>QnA</title>
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
            margin-top:450px;
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
        <?php
            include 'db.inc';

            $idx = $_GET['idx'];
            
            $sql = "SELECT * FROM qna WHERE idx=$idx";
            $res = mysqli_fetch_array(mysqli_query($conn, $sql));

            if(isset($_POST['pw'])){
                if($_POST['pw']==$res['pw']){
                    echo "<script>window.location.href='qna_remove_ok.php?idx=$idx';</script>";
                } else {
                    echo "<script>alert('비밀번호가 일치하지 않습니다.');</script>";
                }
            }

            if(isset($_POST['phone'])){
                if($_POST['phone']==$res['phone']){
                    echo "<script>window.location.href='qna_remove_ok.php?idx=$idx';</script>";
                } else {
                    echo "<script>alert('연락처가 일치하지 않습니다.');</script>";
                }
            }

            if($res['pw']){ ?>
                <h2 id=tt>문의글 삭제</h2>
                <form method=post action="qna_remove_check.php?idx=<?=$idx?>">
                    <h4>문의글 비밀번호를 입력하세요.</h4>
                    <input type=password placeholder="문의글 비밀번호" name=pw>
                    <input type=submit value=확인>
                </form> <?php
            } else { ?>
                <h2 id=tt>문의글 삭제</h2>
                <form method=post action="qna_remove_check.php?idx=<?=$idx?>">
                    <h4>문의글 연락처를 입력하세요.</h4>
                    <input type=text placeholder="문의글 연락처" name=phone>
                    <input type=submit value=확인>
                </form> <?php
            }
        ?>
    </div>
</body>
</html>