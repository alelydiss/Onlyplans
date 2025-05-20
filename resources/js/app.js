import './bootstrap';
import './favorite.js';
import './intereses.js'

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

    document.getElementById('avatar').addEventListener('change', function (e) {
        const form = document.getElementById('avatarForm');
        const fileInput = e.target;
        const formData = new FormData(form);
    
        fetch(form.action, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value,
                'X-Requested-With': 'XMLHttpRequest'
            },
            body: formData
        })
        .then(response => {
            if (response.ok) {
                const reader = new FileReader();
                reader.onload = function (e) {
                    // Actualiza la vista previa
                    document.getElementById('previewAvatar').src = e.target.result;
    
                    // También actualiza el avatar en la barra de navegación
                    const navbarAvatar = document.getElementById('navbarAvatar');
                    if (navbarAvatar) {
                        navbarAvatar.src = e.target.result;
                    }
                };
                reader.readAsDataURL(fileInput.files[0]);
            } else {
                console.error("Error en la respuesta del servidor.");
            }
        })
        .catch(error => {
            console.error('Error al subir el avatar:', error);
        });
    });
    