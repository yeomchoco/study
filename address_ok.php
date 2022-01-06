<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Address</title>
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
            margin-top:30px;
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
        input[type=button] {
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
        table {
            position:relative;
            left:3%;
            text-align:left;
        }
    </style>
</head>
<body onresize="parent.resizeTo(500,500)" onload="parent.resizeTo(500,500)">
    <div class=wrapper>
        <h2 id=tt>검색 결과</h2>
        <?php
            include 'db.inc';
            
            $address= $_GET['address'];
            $arr= explode(" ",$address);

            if($arr[1]){
                $sql = "SELECT * FROM ZIPCODE WHERE DORO='$arr[0]' AND BUILD_NO1='$arr[1]'";
            } else {
                $sql = "SELECT * FROM ZIPCODE WHERE DORO='$arr[0]' ORDER BY BUILD_NO1 ASC";
            }
            
            $res = mysqli_query($conn, $sql);
            $num = 1;
        ?>
            <table>
        <?php
            if(mysqli_num_rows($res)==0){ ?>
                <tbody>
                    <td><span style='color:red'><?=$address?></span> 에 대한 검색 결과가 없습니다.</td>
                </tbody> <?php
            }
            while($row = mysqli_fetch_array($res)){
                $full = $row['SIDO']." ".$row['SIGUNGU']." ".$row['DORO']." ".$row['BUILD_NO1']." ".$row['BUILD_NM']; ?>
                <tbody>
                    <td><?=$num?></td>
                    <td><a href="address_detail.php?full=<?=$full?>"><?=$full?></a></td>
                </tbody> <?php
                $num++;
            }
        ?>
            </table>
    </div>
</body>
</html>