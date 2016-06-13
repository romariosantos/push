<!DOCTYPE html>
<html>
<head>

  <title>Push Notification ADMIN</title>

  <link rel="manifest" href="manifest.json">

</head>

<body>

  <h1>Sent PUSH</h1>
  <p>This page must be accessed using HTTPS or via localhost.</p>
  <button id="sent">Enviar pUSH</button>

  <input type="text" name="title" id="title" placeholder="Titulo" value="Titulo">
  <input type="text" name="msg" id="msg" placeholder="Mensagem" value="msg">
  <input type="text" name="link" id="link" value="http://romariosantos.com.br" placeholder="Link on click" >

  <script src="js/jquery-1.9.1.min.js"></script>
  <script src="sent.js?nocache=<?=rand(0,9999)?>"></script>

  <script type="text/javascript">

  	var sent = document.querySelector('#sent');

  	var title = document.querySelector('#title');
    var msg   = document.querySelector('#msg');
  	var link  = document.querySelector('#link');

  	sent.addEventListener('click', function(){
      send_message_to_sw(title.value, msg.value, link.value);
  		sendPushToClient();
  	});

  </script>

</body>
</html>