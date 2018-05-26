<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="pt-br" lang="pt-br" dir="ltr">
<head>
<!-- viewport fix for mobile devices -->
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<meta charset="utf-8"/>
<link rel="stylesheet" href="captiveportal-bootstrap.min.css" crossorigin="anonymous">
<title>Acesso a rede - Fatec Jales</title>
</head>
<body>
<div style="display: inline; text-align: center; margin: 0 auto;">
<!-- Click-thru to our website - make sure the hostname is added to Allowed Hostnames in CP -->
	<div>
		<a href="#" onfocus="blur()" >
			<img src="captiveportal-logo.jpg" alt="Logo" style="border: none;" />
		</a>
	</div>
	<!-- This displays Invalid/Expired Voucher Message configured via vouchers tab -->
	<h3 id="statusbox" style="color: red; font-weight:bold;"></h3>
	<div id="loginbox" class="">
		<form method="post" action="http://192.168.103.253:8002/index.php?zone=laboratorios" style="width: 100%;">
			<input name="auth_user" id="auth_user" type="text" class="form-control" style="display:inline;max-width:380px;" autofocus placeholder="Usuário - login" size="50">
			<h5 id="statususer" style="color: gray; font-weight:bold;"></h5>
			<input name="auth_pass" id="auth_pass" type="password" class="form-control" style="display:inline;max-width:300px;" autocomplete="off" placeholder="Senha" size="50">
			<span style="padding-left: 25px;" class="hidden-xs"></span>
			<a id="btnVerPwd" title="Ver/Ocultar Senha" class="btn btn-default" style="width:50px;" type="button" value=""><img src="captiveportal-eye_show.png"></img></a>
			<br><br>
			<input name="redirurl" type="hidden" value="http://www.fatecjales.edu.br">
			<input name="zone" type="hidden" value="laboratorios">
			<input name="accept" class="btn btn-primary" style="width:380px;" type="submit" value="Entrar">
			<br><br>
			<a href="http://sigere.fatecjales.edu.br/" style="width:380px;" class="btn btn-success">Gerenciar conta - Pedir acesso - Alterar senha</a>
		</form>
	</div>
	<br />
	<!-- Just in case of PEBKAC issues -->
	<div id="explanation-en">
	Acesso a internet monitorado, seja responsável...
	</div>
</div>
</body>
</html>
<script src="captiveportal-jquery.min.js"></script>
<script>
 //$("#auth_user").on('change keyup paste',function(){
$("#auth_user").on('blur',function(){
	$(this).val($(this).val().toLowerCase());
	getStatusUser();
})
$("#auth_user").on('focus',function(){
	getStatusUser();
	$("#statususer").html('');
})
	 
function getStatusUser(){
    
    var jqxhr = $.ajax({
          method: "POST",
          url: "http://sigere.fatecjales.edu.br/controller/UsuariosGetStatus.php",
          dataType: "text",
          async: false,
          data: { usuario: $('#auth_user').val()},
          success: function(retorno) {
			$('#statususer').html(retorno);
          }
    })
      .fail(function(xhr, textStatus, error) {
        console.log(xhr.responseText);
        console.log(textStatus);
        console.log(error);
      });
    // Perform other work here ...
   jqxhr.always(function() {
  });
}

$('#btnVerPwd').click(function(){
    if ($('#auth_pass').get(0).type == 'password'){
        $('#btnVerPwd').html('<img src="captiveportal-eye_hide.png"></img>');
        $('#auth_pass').get(0).type = 'text';
    }
    else{
        $('#btnVerPwd').html('<img src="captiveportal-eye_show.png"></img>');
        $('#auth_pass').get(0).type = 'password';
    }
});
	 
 </script>