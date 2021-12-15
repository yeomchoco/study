<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Board</title>
</head>
<body>
    <div class=top><h2>게시판</h2></div>
    <button class=no onclick="window.location.href='board_write.php'">글쓰기</button>
    <table class=middle>
        <thead>
            <tr align=center>
                <th width=70>Post ID</th>
                <th width=300>제목</th>
                <th width=120>작성자</th>
                <th width=120>작성일</th>
                <th width=70>조회수</th>
                <th width=70>좋아요</th>
            </tr>
       </thead>
       <?php
            $conn = mysqli_connect('localhost', 'choco', '7173', 'study');
            
            if(isset($_GET['page'])){
                $page = $_GET['page'];
            } else {
                $page = 1;
            }

            $sql = "SELECT * FROM board";
            $res = mysqli_query($conn, $sql);

            $total_post = mysqli_num_rows($res);
            $per = 5;

            $start = ($page-1)*$per + 1;
            $start -= 1;

            $sql_page = "SELECT * FROM board ORDER BY idx DESC limit $start, $per";
            $res_page = mysqli_query($conn, $sql_page);

            while($row = mysqli_fetch_array($res_page)){
        ?>
            <tbody>
                <tr align=center>
                    <td><?php echo $row['idx'];?></td>
                    <td><a href="board_view.php?idx=<?=$row['idx']?>"><?php echo $row['title'];?></a></td>
                    <td><?php echo $row['name'];?></td>
                    <td><?php echo $row['created'];?></td>
                    <td><?php echo $row['hit'];?></td>
                    <td><?php echo $row['liked'];?></td>
                </tr>
            </tbody>
        <?php } ?>
        </table>
        <?php
            $total_page = ceil($total_post / $per);
            $page_num = 1;
            
            if($page > 1){
                echo "<a href=\"board.php?page=1\">◀ </a>";
            }
            while($page_num <= $total_page){
                if($page==$page_num){
                    echo "<a style=\"color:hotpink;\" href=\"board.php?page=$page_num\">$page_num </a>";
                } else {
                    echo "<a href=\"board.php?page=$page_num\">$page_num </a>"; }
                $page_num++;
            }
            if($page < $total_page){
                echo "<a href=\"board.php?page=$total_page\">▶</a>";
            }
        ?>
</body>
</html>