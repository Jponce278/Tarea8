
function validarDonacionForm() {
  const email = document.getElementById('email').value;
  const monto = parseFloat(document.getElementById('monto').value);
  const anonimo = document.getElementById('anonimo').checked;
  const nombre = document.getElementById('nombre').value;

  if (!email || monto <= 0) {
    alert("Por favor, ingresa un email válido y un monto mayor a 0.");
    return false;
  }

  let mensaje = anonimo ? "Gracias por tu donación anónima de $" + monto
                        : "Gracias " + nombre + " por tu donación de $" + monto;
  alert(mensaje);
  return false;
}

function validarFormulario() {
  const monto = parseFloat(document.getElementById("donacion").value);
  const email = document.getElementById("email").value;

  if (isNaN(monto) || monto <= 0) {
    document.getElementById("mensaje-validacion").textContent = "Ingresa un monto válido.";
    return false;
  }

  if (!email) {
    document.getElementById("mensaje-validacion").textContent = "Ingresa un correo electrónico.";
    return false;
  }

  // Redirige a pagina de donación simulada
  window.location.href = "https://www.paypal.com/donate";
  return false; // evita el envio real del formulario
}