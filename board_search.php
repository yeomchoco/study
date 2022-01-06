<?php
    session_start();
    include 'db.inc';

    $cate = $_GET['cate'];
    $search = $_GET['search'];
    $date1 = $_GET['date1'];
    $date2 = $_GET['date2'];

    switch($cate){
        case "title":
            $ct = "제목";
            break;
        case "content":
            $ct = "내용";
            break;
        case "name":
            $ct = "작성자";
            break;
    }

    $last = iconv_substr($search, -1, 1, "utf-8");
    $dec = substr(mb_convert_encoding($last,'HTML-ENTITIES','UTF-8'),2,-1);
    $nums = array("3","6","0");

    if($dec>=44032 && $dec<=55203){
        if(($dec-44032)%28!=0){
            $josa = "으로";
        }else{
            $josa = "로";
        }
    }elseif(in_array($last, $nums)){
        $josa = "으로";
    }else{
        $josa = "로";
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Board</title>
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
            top:35.1%;
            font-size:23px;
            z-index: 1;
        }
        .btn {
            text-align:right;
            position:relative;
            top:35.6%;
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
    <h1><a href=main.php>my web</a></h1>
    <hr>
    <div class=nav>
        <ul>
            <li><a href="javascript:void(0);" onclick="auth_board();">Board</a></li>
            <li><a href="qna.php">QnA</a></li>
            <li><a href="javascript:void(0);" onclick="auth();">Mypage</a></li>
        </ul>
    </div>
    <div class=wrapper>
        <div class=info>BOARD</div>
        <h2><span style="color:hotpink">[<?=$ct?> : <?=$search?>]</span> <?=$josa?> 검색한 결과입니다.</h2>
        <?php
            if($date1 && $date2){ ?>
                <h3 style="color:hotpink"><?=$date1?> ~ <?=$date2?></h3> <?php
            } else { ?>
                <h3 style="color:hotpink">기간을 설정하지 않았습니다.</h3> <?php
            }

            if(isset($_GET['page'])){
                $page = $_GET['page'];
            } else {
                $page = 1;
            }

            if($date1 && $date2){
                $sql = "SELECT * FROM board WHERE $cate LIKE '%$search%' AND created BETWEEN '$date1' AND '$date2'";
            } else {
                $sql = "SELECT * FROM board WHERE $cate LIKE '%$search%'";
            }
            
            $res = mysqli_query($conn, $sql);

            $total_post = mysqli_num_rows($res);
            $per = 5;

            $start = ($page-1)*$per;
        
            if($date1 && $date2){
                $sql2 = "SELECT * FROM board WHERE $cate LIKE '%$search%' AND created BETWEEN '$date1' AND '$date2' ORDER BY idx DESC limit $start, $per";
            } else {
                $sql2 = "SELECT * FROM board WHERE $cate LIKE '%$search%' ORDER BY idx DESC limit $start, $per";
            }

            $res2 = mysqli_query($conn, $sql2);

            if($total_post==0){
                echo "<h3>검색 결과가 없습니다.</h3>";
            } else { ?>
            <table class=middle>
                <thead>
                    <tr align=center>
                        <th width=70>Post ID</th>
                        <th width=200>제목</th>
                        <th width=120>작성자</th>
                        <th width=120>작성일</th>
                        <th width=70>조회수</th>
                        <th width=70>👍🏻</th>
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
                            }else{ ?>
                                <td><a style="color:hotpink;" href="board_view.php?idx=<?=$row['idx']?>"><?php echo $row['title'];?></a></td> <?php
                            } ?>
                            <td><?php echo $row['name'];?></td>
                            <td><?php echo $row['created'];?></td>
                            <td><?php echo $row['hit'];?></td>
                            <td><?php echo $res3?></td>
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
            </div>
            <form method="get" action="board_search.php">
                <div class=search>
                <select name="cate" id="search_opt" onchange="info()">
                        <option value=title>제목</option>
                        <option value=content>내용</option>
                        <option value=name>작성자</option>
                </select>
                <input type=text name=search id="search_box" autocomplete="off" value="<?=$search?>" placeholder="제목을 입력하세요." required>
                <input type=submit value=검색>
                </div>
                <div class=date>
                        <input type=date value="<?=$date1?>" name=date1>
                        ~
                        <input type=date value="<?=$date2?>" name=date2>
                </div>
            </form>
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