<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Chat ExamTrack</title>
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" type="text/css" href="<?= base_url('assets/style2.css'); ?>">
    <link rel="stylesheet" type="text/css" href="<?= base_url('assets/form.css'); ?>">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>


</head>
<body>
    <header class="header">
        <a href="#" class="logo">ExamTrack</a>
        <nav class="navbar">
            <a href="<?= base_url('user/dashboard'); ?>" class="active">Inicio</a>
            <a href="<?= base_url('about'); ?>">Acerca de</a>
            <a href="<?= base_url('chat'); ?>">Chat</a>
            <a href="<?= site_url('resultado') ?>">Consultas</a>
            <a href="<?= site_url('request') ?>">Apis</a>
        </nav>
    </header>

    <section class="home">
        <div class="chat-container">
            <div class="chat-header">
                <h2>Chat de Soporte</h2>
            </div>
            <div id="chat-box" class="chat-box"></div>
            <div class="chat-input">
                <input type="text" id="message" placeholder="Escribe tu mensaje...">
                <button id="send-btn">
                    <i class='bx bx-send'></i> Enviar
                </button>
            </div>
        </div>
    </section>

    <script>
        const socket = new WebSocket('ws://localhost:8080');
        const chatBox = document.getElementById('chat-box');
        const sendBtn = document.getElementById('send-btn');
        const messageInput = document.getElementById('message');

        // Función para crear un elemento de mensaje
        function createMessageElement(data, isSent) {
            const messageElement = document.createElement('div');
            messageElement.className = `message ${isSent ? 'sent' : 'received'}`;
            messageElement.textContent = `${data.mensaje}`;
            return messageElement;
        }

        socket.onmessage = function(event) {
            const data = JSON.parse(event.data);
            const messageElement = createMessageElement(data, false);
            chatBox.appendChild(messageElement);
            chatBox.scrollTop = chatBox.scrollHeight;
        };

        function sendMessage() {
            const message = messageInput.value.trim();
            if (message) {
                const remitente_id = 1; // Cambiar según sesión actual
                const destinatario_id = 2; // Cambiar según el destinatario
                const data = { remitente_id, destinatario_id, mensaje: message };
                
                socket.send(JSON.stringify(data));
                
                // Crear y mostrar el mensaje enviado
                const messageElement = createMessageElement(data, true);
                chatBox.appendChild(messageElement);
                chatBox.scrollTop = chatBox.scrollHeight;
                
                messageInput.value = '';
            }
        }

        sendBtn.addEventListener('click', sendMessage);
        messageInput.addEventListener('keypress', function(e) {
            if (e.key === 'Enter') {
                sendMessage();
            }
        });

        // Mantener el scroll abajo cuando llegan nuevos mensajes
        new MutationObserver(() => {
            chatBox.scrollTop = chatBox.scrollHeight;
        }).observe(chatBox, { childList: true });
    </script>
</body>
</html>