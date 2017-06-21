document.write('<script src="http://localhost/ci_express/styles/admin/Js/jsencrypt-master/bin/jsencrypt.min.js"><\/script>')
var http_request=false;
    function change(){
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
        http_request.open("POST","http://localhost/ci_express/index.php/admin/choose/change",true);
        http_request.setRequestHeader("Content-Type","application/x-www-form-urlencoded"); 
        var opsc=form.opsw.value;
        var npsc=form.npsw.value;
        var cnpsc=form.cnpsw.value;
        var send_string='#'+opsc+'#'+npsc+'#'+cnpsc;
        var encrypt = new JSEncrypt();
        var text = document.getElementById('pubkey').value;
        encrypt.setPublicKey(text);
        var encrypted = encrypt.encrypt(send_string);
        encrypted=encodeURIComponent(encrypted);
        //alert(encrypted);
        //return; 
        http_request.send(encrypted);
    }
    function alertContents(){
        if(http_request.readyState==4){
            if(http_request.status==200){
                    alert(http_request.responseText);
            }else{
            alert(http_request.status);
            }
        }
    }

