<!DOCTYPE html>
<html>
<head>
    <title>Customer Support Chat</title>
    <style>
        .chat-container {
            max-width: 800px;
            margin: 20px auto;
            padding: 20px;
            border: 1px solid #ddd;
        }
        .chat-messages {
            height: 400px;
            overflow-y: auto;
            border: 1px solid #eee;
            padding: 10px;
            margin-bottom: 20px;
        }
        .message {
            margin: 10px 0;
            padding: 10px;
            border-radius: 5px;
        }
        .message.sent {
            background-color: #e3f2fd;
            margin-left: 20%;
        }
        .message.received {
            background-color: #f5f5f5;
            margin-right: 20%;
        }
        .chat-input {
            display: flex;
            gap: 10px;
        }
        .chat-input input {
            flex: 1;
            padding: 10px;
        }
        .agent-list {
            width: 200px;
            float: left;
            border-right: 1px solid #ddd;
            padding-right: 20px;
        }
    </style>
</head>
<body>
    <div class="chat-container">
        <?php if($role == 'estudiante'): ?>
            <div class="agent-list">
                <h3>Available Agents</h3>
                <ul id="agentList"></ul>
            </div>
        <?php endif; ?>
        
        <div class="chat-messages" id="chatMessages"></div>
        
        <div class="chat-input">
            <input type="text" id="messageInput" placeholder="Type your message...">
            <button onclick="sendMessage()">Send</button>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        let selectedUserId = null;
        let ws;
        
        $(document).ready(function() {
            initializeWebSocket();
            <?php if($role == 'estudiante'): ?>
                loadAgents();
            <?php endif; ?>
        });

        function initializeWebSocket() {
            ws = new WebSocket('ws://your-domain:8080');
            
            ws.onopen = function() {
                console.log('Connected to WebSocket server');
            };
            
            ws.onmessage = function(e) {
                const data = JSON.parse(e.data);
                if(data.type === 'message') {
                    appendMessage(data.message, data.sender_id === <?php echo $user_id; ?> ? 'sent' : 'received');
                }
            };
        }
        
        function loadAgents() {
            $.get('<?php echo base_url("chat/get_agents"); ?>', function(agents) {
                const agentList = $('#agentList');
                agentList.empty();
                
                agents.forEach(function(agent) {
                    agentList.append(`
                        <li onclick="selectAgent(${agent.idUsuarios})">
                            ${agent.nombres} ${agent.apellidos}
                        </li>
                    `);
                });
            });
        }
        
        function selectAgent(agentId) {
            selectedUserId = agentId;
            loadConversation();
        }
        
        function loadConversation() {
            $.get('<?php echo base_url("chat/get_messages"); ?>', {
                other_user_id: selectedUserId
            }, function(messages) {
                $('#chatMessages').empty();
                messages.forEach(function(message) {
                    appendMessage(message.mensaje, 
                        message.remitente_id === <?php echo $user_id; ?> ? 'sent' : 'received');
                });
            });
        }
        
        function sendMessage() {
            const message = $('#messageInput').val();
            if(!message) return;
            
            $.post('<?php echo base_url("chat/send"); ?>', {
                receiver_id: selectedUserId,
                message: message
            }, function(response) {
                if(response.status === 'success') {
                    $('#messageInput').val('');
                    ws.send(JSON.stringify({
                        type: 'message',
                        sender_id: <?php echo $user_id; ?>,
                        receiver_id: selectedUserId,
                        message: message
                    }));
                }
            });
        }
        
        function appendMessage(message, type) {
            $('#chatMessages').append(`
                <div class="message ${type}">
                    ${message}
                </div>
            `);
            
            const chatMessages = document.getElementById('chatMessages');
            chatMessages.scrollTop = chatMessages.scrollHeight;
        }
    </script>
</body>
</html>