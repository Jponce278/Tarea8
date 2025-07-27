document.addEventListener("DOMContentLoaded", () => {
  const proyectos = [
    {
      titulo: "Huerta Comunitaria",
      descripcion: "Promueve el autoconsumo y la alimentación saludable en barrios vulnerables."
    },
    {
      titulo: "Educación Digital",
      descripcion: "Entrega de notebooks y capacitación tecnológica a estudiantes de escasos recursos."
    },
    {
      titulo: "Salud en tu Barrio",
      descripcion: "Operativos médicos gratuitos en zonas rurales con difícil acceso."
    },
    {
      titulo: "Mujeres Emprenden",
      descripcion: "Capacitación en oficios y microemprendimiento para mujeres jefas de hogar."
    },
    {
      titulo: "Arte para Todos",
      descripcion: "Talleres de arte y cultura para niños en riesgo social."
    }
  ];

  const carousel = document.getElementById("carousel");
  const btnPrev = document.getElementById("btn-prev");
  const btnNext = document.getElementById("btn-next");

  proyectos.forEach(proyecto => {
    const card = document.createElement("div");
    card.className = "project-card";
    card.innerHTML = `
      <h3>${proyecto.titulo}</h3>
      <p>${proyecto.descripcion}</p>
    `;
    carousel.appendChild(card);
  });

  let scrollAmount = 0;
  const cardWidth = carousel.querySelector(".project-card").offsetWidth + 16;

  const updateButtons = () => {
    btnPrev.classList.toggle("disabled", scrollAmount <= 0);
    btnNext.classList.toggle("disabled", scrollAmount >= carousel.scrollWidth - carousel.clientWidth - 1);
  };

  btnNext.addEventListener("click", () => {
    if (scrollAmount < carousel.scrollWidth - carousel.clientWidth) {
      scrollAmount += cardWidth;
      carousel.scrollTo({ left: scrollAmount, behavior: "smooth" });
      setTimeout(updateButtons, 300);
    }
  });

  btnPrev.addEventListener("click", () => {
    if (scrollAmount > 0) {
      scrollAmount -= cardWidth;
      carousel.scrollTo({ left: scrollAmount, behavior: "smooth" });
      setTimeout(updateButtons, 300);
    }
  });

  updateButtons(); 
});
