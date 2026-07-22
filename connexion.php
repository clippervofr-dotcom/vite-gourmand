<?php
session_start();
require 'includes/db.php'; // connexion PDO à MySQL

$erreur = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $stmt = $pdo->prepare('SELECT * FROM utilisateur WHERE email = ?');
    $stmt->execute([$email]);
    $utilisateur = $stmt->fetch();

    if ($utilisateur && password_verify($password, $utilisateur['password'])) {
        unset($utilisateur['password']);
        $_SESSION['utilisateur'] = $utilisateur;
        header('Location: index.php');
        exit;
    } else {
        $erreur = 'Email ou mot de passe incorrect';
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
            <p class="erreur"><?= htmlspecialchars($erreur) ?></p>
        <?php endif; ?>

        <form class="se-connecter-box" method="POST" action="connexion.php">
            <div class="input-connexion">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" placeholder="Votre Email" required>

                <label for="password">Mot de passe</label>
                <input type="password" id="password" name="password" placeholder="Votre mot de passe" required>
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