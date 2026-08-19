<?php
session_start();

use Controllers\UtilisateurController;
use includes\Autoloader;
use Repositories\UtilisateurRepositoryMysql;

require __DIR__ . '/includes/Autoloader.php';
require __DIR__ . '/Bootstraps/bootstrap-db.php';
require __DIR__ . '/includes/csrf.php';
Autoloader::register();

$erreur = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    verifierCsrfPage();

    $email = $_POST['email'] ?? null;
    $password = $_POST['password'] ?? null;

    $utilisateurRepository = new UtilisateurRepositoryMysql($pdo);
    $utilisateurController = new UtilisateurController($utilisateurRepository);

    $utilisateur = $utilisateurController->findUtilisateurByEmail($email);
    if (!$utilisateur) {
        $erreur = 'Email ou mot de passe incorrect';
    } else {
        $verification = $utilisateurController->verifPassword($utilisateur->getId(), $password);
        if ($verification) {
            $_SESSION['utilisateur'] = $utilisateur->jsonSerialize();
            header('Location: index.php');
            exit;
        } else {
            $erreur = 'Email ou mot de passe incorrect';
        }
    }
}

$css_pages = ['forms'];
include 'includes/header.php';
?>

    <main>
        <div class="connexion-banner">
            <img src="assets/images/banniere-v&g.png" alt="Banniere connexion" class="connexion-banner-img">
        </div>


        <?php if ($erreur): ?>
            <p class="erreur"><?= htmlspecialchars($erreur, ENT_QUOTES, 'UTF-8') ?></p>
        <?php endif; ?>

        <form class="se-connecter-box" method="POST" action="connexion.php">
            <input type="hidden" name="csrf_token" value="<?= htmlspecialchars($_SESSION['csrf_token']) ?>">
            <div class="input-connexion">
                <label for="email">Email</label>
                <input type="email" id="email" pattern="^[a-z0-9!#$%&'*+\/=?^_`\{\|\}~\-]+(?:\.[a-z0-9!#$%&'*+\/=?^_`\{\|\}~\-]+)*@(?:[a-z0-9](?:[a-z0-9\-]*[a-z0-9])?\.)+[a-z0-9](?:[a-z0-9\-]*[a-z0-9])?$" maxlength="100" name="email" placeholder="Votre Email" required>

                <label for="password">Mot de passe</label>
                <input type="password" pattern="^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{8,}$" id="password" name="password" placeholder="Votre mot de passe" required>
            </div>

            <button class="animated-button" id="animated-btn-connexion" type="submit">
                <svg viewBox="0 0 24 24" class="arr-2" xmlns="http://www.w3.org/2000/svg">
                    <path
                            d="M16.1716 10.9999L10.8076 5.63589L12.2218 4.22168L20 11.9999L12.2218 19.778L10.8076 18.3638L16.1716 12.9999H4V10.9999H16.1716Z"
                    ></path>
                </svg>
                <span class="text">Se connecter !</span>
                <span class="circle"></span>
                <svg viewBox="0 0 24 24" class="arr-1" xmlns="http://www.w3.org/2000/svg">
                    <path
                            d="M16.1716 10.9999L10.8076 5.63589L12.2218 4.22168L20 11.9999L12.2218 19.778L10.8076 18.3638L16.1716 12.9999H4V10.9999H16.1716Z"
                    ></path>
                </svg>
            </button>

            <div class="pas-de-compte">
                <p>Pas de compte ?</p>
                <a href="inscription.php">Inscription ici !</a>
            </div>
        </form>
    </main>

<?php include 'includes/footer.php'; ?>