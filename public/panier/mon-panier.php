<?php
require_once __DIR__ . '/../../vendor/autoload.php';
require_once __DIR__ . '/../../src/Config/root-path.php';
$css_pages = ['menus'];
require ROOT_PATH . '/src/Views/partials/header.php';
?>

<main class="main-mon-panier">
    <div class="panier-container" id="panier-container">
        <h1>Votre Panier</h1>
        <div class="panier-info-box">
            <!-- JS ICI -->
        </div>

    </div>
</main>

<?php require ROOT_PATH . '/src/Views/partials/footer.php'; ?>