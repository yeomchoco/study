<?php
    $join_id = $_POST['decide_id'];
    $join_pw = $_POST['join_pw'];
    $join_name = $_POST['join_name'];
    $join_phone = $_POST['join_phone'];
    $join_email = $_POST['join_email'];
    $join_address = $_POST['join_address'];

    $conn= mysqli_connect('localhost', 'choco', '7173', 'study');
    
    $sql = "
        INSERT INTO member(id, pw, name, phone, email, address, created) VALUES ('{$join_id}', '{$join_pw}', '{$join_name}', '{$join_phone}', '{$join_email}', '{$join_address}',  now());
    ";
    $res = mysqli_query($conn,$sql);

    if($res){
        echo "<script>alert('회원가입이 완료되었습니다.');";
        echo "window.location.replace('login.php');</script>";
        exit;
    }
    else{
       echo "<script>alert('회원가입에 실패했습니다.');";
       echo mysqli_error($conn);
    }
?>
<meta http-equiv="refresh" content="0;url=main.php">