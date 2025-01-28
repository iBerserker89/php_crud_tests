<?php

// Remove caracteres especiais para URL
function formatar_mensagem($mensagem) {
    $mensagemFormatada = str_replace(
        [' ', '.', ','], '-', $mensagem
    );
    return rawurlencode($mensagemFormatada);
}
