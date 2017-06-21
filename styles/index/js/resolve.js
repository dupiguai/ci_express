function mycheck()
{
    creatRequest();
}
var http_request=false;
function creatRequest()
{
     http_request=false;
    if(window.XMLHttpRequest)
    {
        http_request=new XMLHttpRequest();
        if(http_request.overrideMimeType)
        {
             http_request.overrideMimeType("text/xml");
        }
    }
    else if(window.ActiveXObject)
    {
        try{
                http_request=new ActiveXObject("Msxml2.XMLHTTP");
            }catch(e){
                          try{
                                 http_request=new ActiveXObject("Microsoft.XMLHTTP");
                              }catch(e){}
                     }
    }
    if(!http_request)
    {
        alert("不能创建XMLHTTP实例");
        return false;
    }
    http_request.onreadystatechange=alertContents;
    http_request.open("POST","solve.php",true);
    http_request.setRequestHeader("Content-Type","application/x-www-form-urlencoded"); 
    var file = document.getElementById("num").value;
    var strFileName=file.replace(/^.+?\\([^\\]+?)(\.[^\.\\]*?)?$/gi,"$1");  //正则表达式获取文件名，不带后缀
    var FileExt=file.replace(/.+\./,"");
    var action = document.getElementById("bt").value;
    var send_string="";
    if(action=="更新")
    {
        var destnation="";
        var obj = document.getElementsByTagName("input");
        for(var i=0; i<obj.length; i ++){
            if(obj[i].checked){
                destnation=obj[i].value;
            }
        }
        send_string="num="+strFileName+"."+FileExt+"&action="+action+"&destnation="+destnation;
    }
    else
    {
        send_string="num="+strFileName+"."+FileExt+"&action="+action;
    }
    //alert(send_string); 
    //return; 
    send_string= encodeURI(send_string) 
    http_request.send(send_string);
}
function alertContents()
{
    if(http_request.readyState==4)
    {
        if(http_request.status==200)
        {
            alert(http_request.responseText);
        }
        else
        {
            alert("你的请求出现错误");
        }
    }
}