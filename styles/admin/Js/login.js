document.write('<script src="http://localhost/ci_express/styles/admin/Js/jsencrypt-master/bin/jsencrypt.min.js"><\/script>')
document.write('<script src="http://localhost/ci_express/styles/admin/Js/jbase64.js"><\/script>')
function change_code(obj){
	$("#code").attr("src","http://localhost/ci_express/index.php/admin/login/code?r="+Math.random());
	return false;
}
var http_request=false;
    function creatRequest(){
        var timestamp=Date.parse(new Date())/1000;
        timestamp=BASE64.encoder(timestamp);
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
        http_request.open("POST","http://localhost/ci_express/index.php/admin/login/login_in",true);
        http_request.setRequestHeader("Content-Type","application/x-www-form-urlencoded"); 
        var psc=form.code.value;
        var username=form.username.value;
        var password=form.password.value;
        var send_string='#'+username+'#'+password+'#'+psc+'#'+timestamp;
        var encrypt = new JSEncrypt();
        encrypt.setPublicKey($('#pubkey').val());
        var encrypted = encrypt.encrypt(send_string);
        //alert(encrypted);return;
        encrypted=encodeURIComponent(encrypted);
        //alert(encrypted); 
        //return; 
        http_request.send(encrypted);
    }
    function alertContents(){
        if(http_request.readyState==4){
            if(http_request.status==200){
            	if(http_request.responseText){
                    alert(http_request.responseText);
                    change_code();
                }else{
                	window.open('http://localhost/ci_express/index.php/admin/admin','_self');
                }
            }else{
            alert(http_request.status);
            }
        }
    }

