<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>QnA Check</title>
</head>
<body>
    <h3>문의글 조회</h3>
    <?php
        include 'db.inc';

        $idx = $_GET['idx'];
        
        $sql = "SELECT * FROM qna WHERE idx=$idx";
        $res = mysqli_fetch_array(mysqli_query($conn, $sql));

        if(isset($_POST['pw'])){
            if($_POST['pw']==$res['pw']){
                echo "<script>window.location.href='qna_view.php?idx=$idx';</script>";
            } else {
                echo "<script>alert('비밀번호가 일치하지 않습니다.');</script>";
            }
        }

        if($res['pw']){ ?>
            <form method=post action="qna_check.php?idx=<?=$idx?>">
                문의글 비밀번호를 입력하세요.<br>
                <input type=password name=pw>
                <input type=submit value=확인>
            </form> <?php
        } else {
            echo "<script>window.location.href='qna_view.php?idx=$idx';</script>";
        }
    ?>
</body>
</html>