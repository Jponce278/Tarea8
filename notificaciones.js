function mostrarNotificacion(mensaje) {
  const alerta = document.createElement("div");
  alerta.textContent = mensaje;
  alerta.className = "notificacion";
  alerta.style.cssText = "position:fixed;top:20px;right:20px;padding:10px;background:green;color:white;z-index:1000;border-radius:5px;";
  document.body.appendChild(alerta);

  setTimeout(() => {
    alerta.remove();
  }, 4000);
}

// Simulación de eventos automáticos
setInterval(() => {
  const mensajes = [
    "🎉 ¡Nuevo logro alcanzado: 1000 kits escolares entregados!",
    "📢 Campaña activa: Un Futuro sin Hambre",
    "💖 Meta de recaudación alcanzada en un 80%"
  ];
  const mensajeAleatorio = mensajes[Math.floor(Math.random() * mensajes.length)];
  mostrarNotificacion(mensajeAleatorio);
}, 10000);

document.addEventListener("DOMContentLoaded", () => {
  const notificaciones = [
    "¡Gracias! Hemos alcanzado el 75% de nuestra meta de recaudación para útiles escolares.",
    "Nueva campaña activa: Maratón por la Vida 2025. ¡Inscríbete ya!",
    "¡Éxito total! 300 personas beneficiadas en la jornada de salud comunitaria.",
    "Recibimos una donación anónima de $100.000. ¡Muchas gracias!",
    "Quedan pocos días para la campaña de Invierno. ¡Ayúdanos a ayudar!",
    "¡Nuevo logro alcanzado: 1000 kits escolares entregados!",
    "Campaña activa: Un Futuro sin Hambre",
    "Meta de recaudación alcanzada en un 80%"

  ];

  const container = document.getElementById("notificaciones-container");

  notificaciones.forEach((mensaje) => {
    const item = document.createElement("div");
    item.className = "notificacion";
    item.textContent = mensaje;
    container.appendChild(item);
  });
});
