window.toggleFavorito = function(eventoId) {
    const token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
    const button = document.getElementById('favorito-btn-' + eventoId);

    fetch(`/evento/${eventoId}/favorito`, {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json',
        'X-CSRF-TOKEN': token
      }
    })
    .then(response => response.json())
    .then(data => {
      if (data.favorito) {
        button.classList.remove('text-gray-400');
        button.classList.add('text-purple-600');
      } else {
        button.classList.remove('text-purple-600');
        button.classList.add('text-gray-400');
      }
    })
    .catch(error => {
      console.error('Error al marcar favorito:', error);
    });
  }
