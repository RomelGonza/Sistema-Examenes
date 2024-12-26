<!DOCTYPE html>
<html>
<head>
    <title>Sistema de Chat</title>
    <link rel="stylesheet" href="<?php echo base_url('assets/css/chat.css'); ?>">
</head>
<body>
    <div class="chat-container">
        <?php if($role == 'estudiante'): ?>
            <div class="agent-list">
                <h3>Agentes Disponibles</h3>
                <ul id="agentList"></ul>
            </div>
        <?php endif; ?>
        
        <div class="chat-messages" id="chatMessages"></div>
        
        <div class="chat-input">
            <input type="text" id="messageInput" placeholder="Escribe tu mensaje...">
            <button onclick="sendMessage()">Enviar</button>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="<?php echo base_url('assets/js/chat.js'); ?>"></script>
    <script>
        // Inicializar variables globales
        const CONFIG = {
            baseUrl: '<?php echo base_url(); ?>',
            userId: <?php echo $user_id; ?>,
            role: '<?php echo $role; ?>',
            wsUrl: '<?php echo $this->config->item("websocket_url"); ?>'
        };
    </script>
</body>
</html>
