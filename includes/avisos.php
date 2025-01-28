<?php if (!empty($aviso)): ?>
        <div class="alert <?php if (!empty($alert)) { print $alert; } ?> text-center" role="alert">
            <?php print $aviso; ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php endif; ?>
    