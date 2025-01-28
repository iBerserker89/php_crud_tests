<?php

// Validações básicas
function valida_dados($nome, $cpf, $creci) {
    if (strlen($cpf) !== 11 || strlen($creci) < 2 || strlen($nome) < 2) {
        return "Dados inválidos. Verifique os campos e tente novamente.";
    }
    return '';
}
