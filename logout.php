<?php
    session_start();
    session_destroy();
    echo "<script>alert('로그아웃되었습니다!');</script>"
?>
<meta http-equiv="refresh" content="0;url=login.php">