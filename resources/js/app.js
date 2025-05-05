import './bootstrap';

window.Echo.channel('chat')
    .listen('.message.sent', (e) => {
        console.log('📨 Nuevo mensaje:', e.message);

        // Opcional: mostrar en el DOM
        const chatBox = document.getElementById('chat-box');
        if (chatBox) {
            const msg = document.createElement('div');
            msg.textContent = e.message;
            chatBox.appendChild(msg);
        }
    });
