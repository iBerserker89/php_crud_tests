<?php

// Recupera o aviso da URL.
function get_aviso() {
    if (!empty($_GET['aviso'])) {
        $aviso = rawurldecode($_GET['aviso']); 
        $aviso = str_replace('-', ' ', $aviso);
        $aviso = htmlspecialchars($aviso);
        $alert = (isset($_GET['success']) && $_GET['success'] == 1) ?'alert-success' : 'alert-danger';

        return [
            'aviso' => $aviso,
            'alert' => $alert,
        ];
    }

    return [
        'aviso' => '',
        'alert' => '',
    ];
}
