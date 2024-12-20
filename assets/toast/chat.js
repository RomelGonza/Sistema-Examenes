$(document).ready(function() {
    let conn = new WebSocket('ws://localhost:8080');

    conn.onmessage = function(e) {
        let data = JSON.parse(e.data);
        $('#messages').append('<p>' + data.mensaje + '</p>');
    };

    $('#send').click(function() {
        let message = $('#message').val();
        conn.send(JSON.stringify({ mensaje: message }));
        $('#message').val('');
    });
});