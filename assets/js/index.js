// Prevenir espaços em branco nos campos de CPF e CRECI.
document.getElementById('inputCpf').addEventListener('input', function () {
    this.value = this.value.replace(/\s/g, '');
});

document.getElementById('inputCreci').addEventListener('input', function () {
    this.value = this.value.replace(/\s/g, '');
});

document.querySelector('.form').addEventListener('submit', function (e) {
    let isValid = true;
    let errors = [];

    // Validação do CPF.
    const cpf = document.getElementById('inputCpf');
    const cpfValue = cpf.value.trim(); 
    if (cpfValue.length !== 11) {
        isValid = false;
        errors.push('O CPF deve conter exatamente 11 caracteres.');
        cpf.classList.add('is-invalid');
    } else {
        cpf.classList.remove('is-invalid');
    }

    // Validação do Creci.
    const creci = document.getElementById('inputCreci');
    const creciValue = creci.value.trim(); 
    if (creciValue.length < 2) {
        isValid = false;
        errors.push('O Creci deve conter pelo menos 2 caracteres.');
        creci.classList.add('is-invalid');
    } else {
        creci.classList.remove('is-invalid');
    }

    // Validação do Nome.
    const name = document.getElementById('inputName');
    const nameValue = name.value.trim();
    if (nameValue.length < 2) {
        isValid = false;
        errors.push('O Nome deve conter pelo menos 2 caracteres.');
        name.classList.add('is-invalid');
    } else {
        name.classList.remove('is-invalid');
    }

    // Impede a submissão do formuĺário se a validação falhar.
    if (!isValid) {
        e.preventDefault();

        // Mostra o modal com a mensagem de erro.
        const modalErrors = document.getElementById('modalErrors');
        modalErrors.innerHTML = errors.map(err => `<p>${err}</p>`).join('');
        const errorModal = new bootstrap.Modal(document.getElementById('errorModal'));
        errorModal.show();
    }
});
