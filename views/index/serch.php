<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url().'styles/index/';?>css/result.css">
</head>
<body >
	<table width="100%" border="0" cellspacing="0" cellpadding="7" style="table-layout: fixed">
	<?php 
        if($address != '0')
        {   
            $arr = explode("#",$address);
            echo "<tr>";
            echo "<th align='right'>订单编号:</th>";
            echo "<th align='left'>".$expressnum."</th>";
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