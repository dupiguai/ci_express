<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html;charset=utf-8">
    <link rel="stylesheet" href="http://localhost/ci_express/styles/admin/Css/style.css" />
</head>
<body>
    <form>
    	<table width="100%">
    		<tr>
    			<th colspan="10">未处理订单信息</th>
    		</tr>
            <?php foreach($num as $v):?>
    		<tr>
			<td width="50%" align="right">订单号:</td>
			<td width="50%" align="left">
                <?php echo $v;?>
            </td> 
		    </tr>	
            <?php endforeach?>
    	</table>
    </form>
</body>
</html>