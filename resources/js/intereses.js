document.addEventListener('DOMContentLoaded', function() {

    const interestBtns = document.querySelectorAll('.interest-btn');

    // ✅ Obtener preferencias del usuario y marcar botones seleccionados
    fetch('/obtener-preferencias')
        .then(response => response.json())
        .then(preferences => {
             console.log('Preferencias recibidas:', preferences); // <-- Aquí
            preferences.forEach(pref => {
    let matched = false;
    interestBtns.forEach(btn => {
        const btnCat = btn.dataset.category.trim().toLowerCase();
        const btnVal = btn.dataset.value.trim().toLowerCase();
        const prefCat = pref.category.trim().toLowerCase();
        const prefVal = pref.value.trim().toLowerCase();

       if (
    btn.dataset.category === pref.category &&
    btn.textContent.trim() === pref.value
)
 {
            matched = true;
            btn.classList.add(
                'bg-indigo-600', 
                'text-white', 
                'border-indigo-600',
                'dark:bg-indigo-700',
                'dark:border-indigo-700',
                'shadow-md'
            );
            console.log(`Botón marcado: category=${btn.dataset.category}, value=${btn.dataset.value}`);
        }
    });
    if (!matched) {
        console.warn(`No se encontró botón para preferencia: category='${pref.category}', value='${pref.value}'`);
    }
});


            // ✅ Una vez marcados, ahora sí aplicar clases y eventos
            interestBtns.forEach(btn => {
                btn.classList.add(
                    'px-6', 
                    'py-3', 
                    'border', 
                    'border-gray-200', 
                    'rounded-xl', 
                    'text-gray-700', 
                    'hover:border-indigo-300', 
                    'transition-all', 
                    'duration-200',
                    'flex',
                    'items-center',
                    'dark:border-gray-700',
                    'dark:text-gray-300',
                    'dark:hover:border-indigo-500'
                );

                btn.addEventListener('click', function() {
                    const isSelected = this.classList.contains('bg-indigo-600') || 
                                    this.classList.contains('dark:bg-indigo-700');

                    if (isSelected) {
                        this.classList.remove(
                            'bg-indigo-600', 
                            'text-white', 
                            'border-indigo-600',
                            'dark:bg-indigo-700',
                            'dark:border-indigo-700',
                            'shadow-md'
                        );
                    } else {
                        this.classList.add(
                            'bg-indigo-600', 
                            'text-white', 
                            'border-indigo-600',
                            'dark:bg-indigo-700',
                            'dark:border-indigo-700',
                            'shadow-md'
                        );
                    }
                });
            });
        })
        .catch(error => {
            console.error('Error al cargar preferencias:', error);
        });

    // ✅ Guardar preferencias seleccionadas
    document.getElementById('save-interests').addEventListener('click', function() {
        const saveBtn = this;
        const originalHTML = saveBtn.innerHTML;

        saveBtn.innerHTML = `
            <svg class="animate-spin -ml-1 mr-3 h-5 w-5 text-white inline-block" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
            </svg>
            Guardando...
        `;

        const selectedInterests = [];
        document.querySelectorAll('.interest-btn.bg-indigo-600, .interest-btn.dark\\:bg-indigo-700').forEach(btn => {
            selectedInterests.push({
                category: btn.dataset.category,
                value: btn.dataset.value,
                text: btn.textContent.trim()
            });
        });

        const finalPreferences = selectedInterests.map(pref => ({
            category: pref.category,
            value: pref.text
        }));

        fetch('/guardar-preferencias', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
            body: JSON.stringify({
                preferences: finalPreferences
            })
        })
        .then(response => response.json())
        .then(data => {
            console.log(data);
            saveBtn.innerHTML = originalHTML;
        })
        .catch(error => {
            console.error('Error al guardar preferencias:', error);
            saveBtn.innerHTML = originalHTML;
            alert('Hubo un error al guardar tus preferencias. Intenta nuevamente.');
        });
    });

});