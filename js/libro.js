window.onload = () => {
  const logo = document.querySelector('.logo');
  // Aplica el zoom al cargar
  logo.classList.add('zoom');
};

function abrirLibro() {
  const libro = document.querySelector('.contenedor-libro');
  const loginPage = document.getElementById('paginaLogin');

  // Aplica el efecto de pasar página
  libro.classList.add('girar-pagina');

  // Después de la animación, ocultamos el libro y mostramos el login
  setTimeout(() => {
    libro.style.display = 'none';
    loginPage.classList.add('visible');
  }, 1200);
}

