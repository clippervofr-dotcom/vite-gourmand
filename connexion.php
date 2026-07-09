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

include 'includes/header.php';
?>

    <main>
        <div class="se-connecter-title">
            <h1>Connexion</h1>
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

            <button class="btn-se-connecter" type="submit">Se connecter</button>

            <div class="pas-de-compte">
                <p>Pas de compte ?</p>
                <a href="inscription.php">Inscription ici !</a>
            </div>
        </form>
    </main>

<?php include 'includes/footer.php'; ?>