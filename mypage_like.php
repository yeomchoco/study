<?php
    session_start(); 
    if(!isset($_SESSION['id'])||!isset($_SESSION['name'])){
        echo "<script>alert('비회원입니다!');history.back();</script>";
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Mypage</title>
    <script>
        function auth_board(){
            var id = '<?=$_SESSION['id']?>';
            var name = '<?=$_SESSION['name']?>';
            if(!id||!name){
                alert('비회원입니다!');
                return;
            }
            window.location.href='board.php';
        }
        function auth(){
            var id = '<?=$_SESSION['id']?>';
            url = "mypage_check.php?id="+id;
            window.open(url,"auth","width=600,height=400");
        }
        function info() {
            var opt = document.getElementById("search_opt");
            var opt_val = opt.options[opt.selectedIndex].value;
            var info = ""
            if (opt_val=='title'){
                info = "제목을 입력하세요.";
            } else if (opt_val=='content'){
                info = "내용을 입력하세요.";
            } else if (opt_val=='name'){
                info = "작성자를 입력하세요.";
            }
            document.getElementById("search_box").placeholder = info;
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
        a {
            text-decoration:none;
            color:white;
        }
        body {
            width:80%;
        }
        .box {
            position:absolute;
            top:50%; left:50%;
            width:1200px; height:650px;
            margin-left:-600px;
            margin-top:-460px;
            /* border:10px solid black; */
            padding:1px 1px;
            z-index:-1;
        }
        h1 {
            font-size:45px;
            width:1170px;
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
            z-index:1;
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
        .wrapper {
            width:1200px;
            margin:auto;
            text-align:center;
            position:relative;
            top:16%;
            z-index:-1;
        }
        .info {
            font-size:55px;
            line-height:50px;
            margin-bottom:50px;
            position:relative;
        }
        .footer {
            float:left;
            width:1168.04px;
            text-align:center;
            color:white;
            background-color:black;
            padding:16px;
            position:relative;
            top:36%;
            font-size:23px;
            z-index: 1;
        }
        .btn {
            text-align:right;
            position:relative;
            top:36.5%;
            z-index:-2;
        }
        button {
            background-color:black;
            color:white;
            font-size:15px;
            width:80px;
            height:25px;
            margin-bottom:7px;
        }
        td a {
            color:black
        }
        table {
            border-collapse:collapse;
            margin:auto;
            font-size:20px;
        }
        td, th {
            border-bottom:1px solid black;
            padding:10px;
            height:25px;
        }
        th {
            background-color:black;
            color:white;
        }
        .page a {
            color:black;
            font-size:20px;
        }
        .page {
            margin-top:25px;
            margin-bottom:25px;
        }
        .search {
            margin-bottom:7px;
        }
    </style>
</head>
<body>
<div class=box>
    <h1><a href=mypage.php>mypage</a></h1>
    <hr>
    <div class=nav>
        <ul>
            <li><a href="mypage_post.php">내가 쓴 글</a></li>
            <li><a href="mypage_like.php">공감한 글</a></li>
            <li><a href="mypage_change.php">내 정보 변경</a></li>
        </ul>
    </div>
    <div class=wrapper>
        <div class=info>MYLIKE</div>
        <?php
            include 'db.inc';
            
            $id = $_SESSION['id'];

            if(isset($_GET['page'])){
                $page = $_GET['page'];
            } else {
                $page = 1;
            }

            $sql0 = "SELECT * FROM like_manager WHERE liker_id='$id'";
            $res0 = mysqli_query($conn, $sql0);
            $like = array();
            while($row0 = mysqli_fetch_array($res0)){
                array_push($like, $row0['post_idx']);
            }
            $like = join(',',$like);

            $sql = "SELECT * FROM board WHERE idx IN ($like);";
            $res = mysqli_query($conn, $sql);

            $total_post = mysqli_num_rows($res);
            $per = 5;

            $start = ($page-1)*$per + 1;
            $start -= 1;

            $sql2 = "SELECT * FROM board WHERE idx IN ($like) ORDER BY idx DESC limit $start, $per";
            $res2 = mysqli_query($conn, $sql2);

            if($total_post==0){
                echo "<h3>공감한 글이 없습니다.</h3>";
            } else { ?>
                <table>
                    <thead>
                        <tr align=center>
                            <th width=70>Post ID</th>
                            <th width=300>제목</th>
                            <th width=120>작성자</th>
                            <th width=120>작성일</th>
                            <th width=70>조회수</th>
                            <th width=70>💕</th>
                            <th width=70>취소</th>
                        </tr>
                    </thead> <?php
            while($row = mysqli_fetch_array($res2)){
                #좋아요 개수
                $post_idx = $row['idx'];
                $sql3 = "SELECT * FROM like_manager WHERE post_idx=$post_idx";
                $res3 = mysqli_num_rows(mysqli_query($conn, $sql3));
        ?>
            <tbody>
                <tr align=center>
                    <td><?php echo $row['idx'];?></td> <?php
                    if($row['file']){ ?>
                        <td><a style="color:hotpink;" href="board_view.php?idx=<?=$row['idx']?>"><?php echo $row['title'];?> 📎</a></td> <?php
                    } else { ?>
                        <td><a style="color:hotpink;" href="board_view.php?idx=<?=$row['idx']?>"><?php echo $row['title'];?></a></td> <?php
                    } ?>
                    <td><?php echo $row['name'];?></td>
                    <td><?php echo $row['created'];?></td>
                    <td><?php echo $row['hit'];?></td>
                    <td><?php echo $res3?></td>
                    <td><button onclick="location.href='board_unlike_ok.php?idx=<?=$post_idx?>'" style="width:28px;background:hotpink;">X</button></td>
                </tr>
            </tbody>
        <?php } ?>
        </table>
    <?php } ?>
        <div class=page>
        <?php
            $total_page = ceil($total_post / $per);
            $page_num = 1;
            
            if($page > 1){
                echo "<a href=\"mypage_like.php?page=1\">◀ </a>";
            }
            while($page_num <= $total_page){
                if($page==$page_num){
                    echo "<a style=\"color:hotpink;\" href=\"mypage_like.php?page=$page_num\">$page_num </a>";
                } else {
                    echo "<a href=\"mypage_like.php?page=$page_num\">$page_num </a>"; }
                $page_num++;
            }
            if($page < $total_page){
                echo "<a href=\"mypage_like.php?page=$total_page\">▶</a>";
            }
        ?>
        </div>
    </div>
    <div class=footer>
        게시판
    </div>
    <div class=btn>
        <button onclick="window.location.href='board_write.php'">글쓰기</button>
    </div>
</div>
</body>
</html>



