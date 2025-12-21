function mostrarSenha() {
    var inputPass = document.getElementById("password");
    var btnShowPass = document.getElementById("btn-senha");

    if (inputPass.type === "password") {
        inputPass.type = "text";
        btnShowPass.classList.replace("bi-eye-fill", "bi-eye-slash-fill");
    } else {
        inputPass.type = "password";
        btnShowPass.classList.replace("bi-eye-slash-fill", "bi-eye-fill");
    }
}

