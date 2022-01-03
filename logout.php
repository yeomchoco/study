<?php
    session_start();
    session_destroy();
    echo "<script>alert('다음에 또 만나요!');</script>"
?>
<meta http-equiv="refresh" content="0;url=greet.php">