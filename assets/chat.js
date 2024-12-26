let selectedUserId = null;
let ws;

$(document).ready(function() {
    initializeWebSocket();
    if(CONFIG.role === 'estudiante') {
        loadAgents();
    } else {
        loadPendingChats();
    }
});

function initializeWebSocket() {
    ws = new WebSocket(`ws://${CONFIG.wsUrl}:8080`);
    
    ws.onopen = function() {
        console.log('Conectado al servidor WebSocket');
        // Registrar usuario en el WebSocket
        ws.send(JSON.stringify({
            type: 'register',
            userId: CONFIG.userId,
            role: CONFIG.role
        }));
    };
    
    ws.onmessage = function(e) {
        const data = JSON.parse(e.data);
        if(data.type === 'message') {
            appendMessage(data.message, data.sender_id === CONFIG.userId ? 'sent' : 'received');
        }
    };

    ws.onclose = function() {
        console.log('Desconectado del WebSocket. Intentando reconectar...');
        setTimeout(initializeWebSocket, 5000);
    };
}

function loadAgents() {
    $.get(`${CONFIG.baseUrl}chat/get_agents`, function(agents) {
        const agentList = $('#agentList');
        agentList.empty();
        
        agents.forEach(function(agent) {
            agentList.append(`
                <li onclick="selectAgent(${agent.idUsuarios})" data-id="${agent.idUsuarios}">
                    ${agent.nombres} ${agent.apellidos}
                </li>
            `);
        });
    });
}

function loadPendingChats() {
    $.get(`${CONFIG.baseUrl}chat/get_pending_chats`, function(chats) {
        const chatList = $('#chatMessages');
        chatList.empty();
        
        chats.forEach(function(chat) {
            chatList.append(`
                <div class="pending-chat" onclick="selectChat(${chat.sender_id})">
                    Mensaje de: ${chat.sender_name}
                </div>
            `);
        });
    });
}

function selectAgent(agentId) {
    $('.agent-list li').removeClass('selected');
    $(`.agent-list li[data-id="${agentId}"]`).addClass('selected');
    selectedUserId = agentId;
    loadConversation();
}

function loadConversation() {
    $.get(`${CONFIG.baseUrl}chat/get_messages`, {
        other_user_id: selectedUserId
    }, function(messages) {
        $('#chatMessages').empty();
        messages.forEach(function(message) {
            appendMessage(message.mensaje, 
                message.remitente_id === CONFIG.userId ? 'sent' : 'received');
        });
    });
}

function sendMessage() {
    const message = $('#messageInput').val().trim();
    if(!message || !selectedUserId) return;
    
    $.post(`${CONFIG.baseUrl}chat/send`, {
        receiver_id: selectedUserId,
        message: message
    }, function(response) {
        if(response.status === 'success') {
            $('#messageInput').val('');
            ws.send(JSON.stringify({
                type: 'message',
                sender_id: CONFIG.userId,
                receiver_id: selectedUserId,
                message: message
            }));
        }
    });
}

function appendMessage(message, type) {
    const timestamp = new Date().toLocaleTimeString();
    $('#chatMessages').append(`
        <div class="message ${type}">
            <div class="message-content">${message}</div>
            <div class="message-timestamp">${timestamp}</div>
        </div>
    `);
    
    const chatMessages = document.getElementById('chatMessages');
    chatMessages.scrollTop = chatMessages.scrollHeight;
}
