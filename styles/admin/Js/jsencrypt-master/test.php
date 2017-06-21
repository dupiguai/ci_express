<?php
    session_start();
    date_default_timezone_set("Asia/Hong_Kong");
    $arr=getdate();
    $time=$arr['year']."-".$arr['mon']."-".$arr['mday']." ".$arr['hours'].":".$arr['minutes'].":".$arr['seconds'].":".$arr['weekday'];
    session_destroy();
?>
<!DOCTYPE html>
<html lang="en">
 
<head>
    <meta charset="utf-8">
    <title>登录</title>
    <meta name="description" content="slick Login">
    <meta name="author" content="Webdesigntuts+">
    <script src="http://code.jquery.com/jquery-1.8.3.min.js"></script>
    <script src="./bin/jsencrypt.min.js"></script>
</head>
 
<body>
    <form name="form2" method="post" >
        <label for="username">username</label><input type="text" name="user" id="user" class="placeholder" placeholder="123123">
        <label for="password">password</label><input type="password" name="password" id="passowrd" class="placeholder" placeholder="password">
         <label for="pubkey">Public Key</label><br/>
<textarea id="pubkey" rows="15" cols="65" style="display:none">-----BEGIN PUBLIC KEY-----
MIGfMA0GCSqGSIb3DQEBAQUAA4GNADCBiQKBgQC2dWtjFMHKriJb56w/WNOcICDQ
SH74691pqfwibPDkzdV7xRfNkwiS0UV+Jy2htyguqsLjRXTaECoMhPoXq1RCXZep
nIW9gj+0UcJ2nZ0PKUfVQvd61tSAZRGhs/YX18f4qOQnH/Dhz1Jvh99R6MEBapCa
klMkStrhGvyK46QRgQIDAQAB
-----END PUBLIC KEY-----</textarea><br/>
    </form>
    <input type="submit" name="submit" value="登录" onClick="return mycheck();" id="but">
    <script>
    function mycheck(){
        if(form2.user.value==""){
            alert("ID不能为空");form2.user.focus();return false;
        }
        else if(form2.password.value==""){
            alert("密码不能为空");form2.password.focus();return false;
        }
        else{
            creatRequest();
        }
    }
    var http_request=false;
    function creatRequest(){
        var usr=form2.user.value;
        var psw=form2.password.value;
        var encrypt = new JSEncrypt();
        encrypt.setPublicKey($('#pubkey').val());
        var encryptedusr = encrypt.encrypt(usr);
        var encryptedpsw = encrypt.encrypt(psw);
        http_request=false;
        if(window.XMLHttpRequest){
            http_request=new XMLHttpRequest();
            if(http_request.overrideMimeType){
                http_request.overrideMimeType("text/xml");
            }
        }else if(window.ActiveXObject){
            try{
                http_request=new ActiveXObject("Msxml2.XMLHTTP");
            }catch(e){
                try{
                    http_request=new ActiveXObject("Microsoft.XMLHTTP");
                }catch(e){}
            }
        }
        if(!http_request){
            alert("不能创建XMLHTTP实例");
            return false;
        }
        http_request.onreadystatechange=alertContents;
        http_request.open("POST","solve.php",false);
        http_request.setRequestHeader("Content-Type","application/x-www-form-urlencoded"); 
        var send_string="user="+encryptedusr+"&password="+encryptedpsw;
        alert(send_string); 
        return; 
        send_string= encodeURI(send_string) 
        http_request.send(send_string);
    }
    function alertContents(){
        if(http_request.readyState==4){
            if(http_request.status==200){
                if(http_request.responseText){
                    alert(http_request.responseText);
                }else{
                    window.location.href="http://localhost/express/staff/jump.php";
                }
            }else{
            alert("你的请求出现错误");
            }
        }
    }
    </script>
</body>
 
</html>
