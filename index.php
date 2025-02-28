<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <title>Chat en PHP</title>
    <style>
        #chat {
            border: 1px solid #ccc;
            height: 550px;
            overflow-y: scroll;
        }
        #message {
            height: 50px;
            width: 80%;
        }
        #send {
            height: 50px;
        }
        #emoji-list {
            display: none;
            border: 1px solid #ccc;
            padding: 10px;
            background: #f9f9f9;
        }
        #emoji-list span {
            cursor: pointer;
            margin: 5px;
            font-size: 1.5em;
        }
    </style>
</head>
<body>
    <h1>Chat en PHP</h1>
    <div id="chat"></div>
    <form id="chatForm">
        <input type="text" id="message" placeholder="Escribe tu mensaje">
        <button type="submit" id="send">Enviar</button>
    </form>
    <audio id="sendSound" src="resources/sounds/msn-messenger.mp3"></audio>

    <script>
        document.getElementById('chatForm').addEventListener('submit', function(event) {
            event.preventDefault();
            let message = document.getElementById('message').value;
            if (message.trim() !== '') {
                fetch('php/send_message.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded'
                    },
                    body: 'message=' + encodeURIComponent(message)
                }).then(response => response.text())
                  .then(data => {
                      document.getElementById('message').value = '';
                      loadMessages();
                      document.getElementById('sendSound').play();
                  });
            }
        });

        function loadMessages() {
            fetch('php/get_messages.php')
                .then(response => response.text())
                .then(data => {
                    document.getElementById('chat').innerHTML = data;
                    document.getElementById('chat').scrollTop = document.getElementById('chat').scrollHeight;
                });
        }

        setInterval(loadMessages, 10000);
    </script>
</body>
</html>