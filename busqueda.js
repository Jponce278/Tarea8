function search() {
  const query = document.getElementById("events").value.toLowerCase();
  const container = document.getElementById("results-container");
  container.innerHTML = "";

  const eventosFiltrados = eventos.filter(evento =>
    evento.nombre.toLowerCase().includes(query) ||
    evento.descripcion.toLowerCase().includes(query)
  );

  if (eventosFiltrados.length === 0) {
    container.innerHTML = "<p>No se encontraron eventos.</p>";
    return;
  }

  eventosFiltrados.forEach(evento => {
    const card = document.createElement("div");
    card.className = "event-box";
    card.innerHTML = `
      <h3>${evento.nombre}</h3>
      <p><strong>Fecha:</strong> ${evento.fecha}</p>
      <p><strong>Lugar:</strong> ${evento.lugar}</p>
      <p>${evento.descripcion}</p>
    `;
    container.appendChild(card);
  });
}


