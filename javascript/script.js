document.addEventListener("DOMContentLoaded", function () {

    // ==========================================
    // 1. CÁLCULO AUTOMÁTICO DE LA EDAD
    // ==========================================
    const fechaNacimientoInput = document.getElementById("fecha_nacimiento");
    const edadInput = document.getElementById("edad");

    if (fechaNacimientoInput && edadInput) {
        fechaNacimientoInput.addEventListener("change", function () {
            const fechaNac = new Date(this.value);
            const hoy = new Date();

            if (!isNaN(fechaNac.getTime())) {
                let edad = hoy.getFullYear() - fechaNac.getFullYear();
                const mes = hoy.getMonth() - fechaNac.getMonth();

                // Ajuste si aún no ha cumplido años este año
                if (mes < 0 || (mes === 0 && hoy.getDate() < fechaNac.getDate())) {
                    edad--;
                }

                if (edad >= 0) {
                    edadInput.value = edad;
                } else {
                    alert("Por favor selecciona una fecha de nacimiento válida.");
                    edadInput.value = "";
                }
            }
        });
    }

    // ==========================================
    // 2. VALIDACIÓN DEL FORMULARIO DE REGISTRO
    // ==========================================
    const registroForm = document.querySelector("#registro-form form");

    if (registroForm) {
        registroForm.addEventListener("submit", function (e) {
            const password = document.getElementById("password").value;
            const numDoc = document.getElementById("num_doc").value;
            const rol = document.getElementById("rol").value;

            // Validación de la contraseña (Mínimo 6 caracteres)
            if (password.length < 6) {
                e.preventDefault();
                alert("La contraseña debe tener al menos 6 caracteres.");
                return;
            }

            // Validación de número de documento (Solo números)
            if (isNaN(numDoc) || numDoc.trim() === "") {
                e.preventDefault();
                alert("El número de documento debe contener solo dígitos numéricos.");
                return;
            }

            // Validación de selección de rol
            if (!rol) {
                e.preventDefault();
                alert("Por favor selecciona un rol (Empleado o Empresa).");
                return;
            }

            // Si todo pasa, mostramos mensaje de bienvenida
            alert("¡Registro exitoso en Zantis! Redirigiendo a tu panel...");
        });
    }

    // ==========================================
    // 3. VALIDACIÓN DEL INICIO DE SESIÓN
    // ==========================================
    const loginForm = document.querySelector("#login-form form");

    if (loginForm) {
        loginForm.addEventListener("submit", function (e) {
            const loginDoc = document.getElementById("login_doc").value.trim();
            const loginPass = document.getElementById("login_password").value.trim();

            if (loginDoc === "" || loginPass === "") {
                e.preventDefault();
                alert("Por favor ingresa tu número de documento y contraseña.");
                return;
            }

            if (isNaN(loginDoc)) {
                e.preventDefault();
                alert("El número de documento debe contener solo números.");
                return;
            }
        });
    }

});