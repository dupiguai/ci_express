<?php
    header('Content-type: text/html; charset=utf-8');
    @$ordernumber=$_POST["user"];
    $ordernumber=htmlspecialchars($ordernumber);
    include_once('../common/connect.php');
    $sql = "SELECT express_num,express_address from express_info where express_num = ?";
    $mysqli_stmt = $conn->prepare($sql);
     
    $express_num = $ordernumber;
    $mysqli_stmt->bind_param('i',$express_num);
    $mysqli_stmt->bind_result($express_num,$express_address);
    $mysqli_stmt->execute();
    $row=array();
    while($mysqli_stmt->fetch())
    {
        $row['express_num']=$express_num;
        $row['express_address']=$express_address;
    }
    //    echo $express_num.'--'.$express_address;
    //}
    //$rows=$conn->query($sql);
    //@$row=$rows->fetch_assoc();
    @$num=$row['express_num'];//$row["express_num"];
    @$str=$row['express_address'];//$row["express_address"];
    $arr = explode("#",$str);
    $mysqli_stmt->close();
    $conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="../css/result.css">
</head>
<body >
	<table width="100%" border="0" cellspacing="0" cellpadding="7" style="table-layout: fixed">
	<?php 
        if (count($arr)>1) {
            echo "<tr>";
            echo "<th align='right'>订单编号:</th>";
            echo "<th align='left'>".$num."</th>";
            echo "</tr>";
        // 输出每行数据
            for($index=1;$index<count($arr);$index+=2)
            {
                echo "<tr><td class='time'>".$arr[$index]."</td>";
                echo "<td class='content'>".$arr[$index+1]."</td></tr>";
            } 
            ?>				
	</table>
	<?php 
} else {
    echo "没有该快递信息，请核对后再查询！";
}
?>
</body>
</html>