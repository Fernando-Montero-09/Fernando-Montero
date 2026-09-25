const URL_LISTAR = '/backend/listar.php';
const URL_AGREGAR = '/backend/agregar.php';
const URL_UPLOADS = '/backend/uploads/';

const contenedorLista = document.getElementById('lista-canciones');
const formulario = document.getElementById('form-cancion');
const mensaje = document.getElementById('mensaje');

// Imagen por defecto cuando la canción no tiene portada
const IMAGEN_DEFECTO = 'https://placehold.co/300x160/2a2a4a/eaeaea?text=Sin+portada';

async function cargarCanciones() {
    try {
        const respuesta = await fetch(URL_LISTAR);
        const canciones = await respuesta.json();

        if (!Array.isArray(canciones) || canciones.length === 0) {
            contenedorLista.innerHTML = '<p>Aún no hay canciones. ¡Agrega la primera!</p>';
            return;
        }

        contenedorLista.innerHTML = canciones.map(c => `
            <div class="tarjeta-cancion">
                <img src="${c.imagen ? URL_UPLOADS + c.imagen : IMAGEN_DEFECTO}" alt="${c.titulo}">
                <div class="info">
                    <h3>${c.titulo}</h3>
                    <p>🎤 ${c.artista}</p>
                    <p>🎼 ${c.genero || '—'} ${c.anio ? '· ' + c.anio : ''}</p>
                </div>
            </div>
        `).join('');
    } catch (error) {
        contenedorLista.innerHTML = '<p>Error al cargar las canciones.</p>';
        console.error(error);
    }
}

formulario.addEventListener('submit', async (evento) => {
    evento.preventDefault();
    mensaje.textContent = 'Guardando...';

    const datos = new FormData(formulario);

    try {
        const respuesta = await fetch(URL_AGREGAR, {
            method: 'POST',
            body: datos
        });
        const resultado = await respuesta.json();

        mensaje.textContent = resultado.mensaje;
        mensaje.style.color = resultado.success ? '#7cffab' : '#ff7c7c';

        if (resultado.success) {
            formulario.reset();
            cargarCanciones();
        }
    } catch (error) {
        mensaje.textContent = 'Error al conectar con el servidor.';
        mensaje.style.color = '#ff7c7c';
        console.error(error);
    }
});

cargarCanciones();
