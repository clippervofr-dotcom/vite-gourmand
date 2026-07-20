<?php
session_start();
require 'includes/db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $mdp = $_POST['mdp'];
    $mdp_confirm = $_POST['mdp-confirm'];

    $valide = $mdp === $mdp_confirm;

    if ($valide) {
        $mdp_hache = password_hash($mdp, PASSWORD_DEFAULT);

        $stmt = $pdo->prepare('INSERT INTO utilisateur (role_id, nom, prenom, adresse, code_postal, ville, telephone, email, password) VALUES (1, ?, ?, ?, ?, ?, ?, ?, ?)');

        $stmt->execute([
                $_POST['nom'],
                $_POST['prenom'],
                $_POST['adresse'],
                $_POST['code-postal'],
                $_POST['ville'],
                $_POST['telephone'],
                $_POST['email'],
                $mdp_hache,
                ]);

        $nouvel_id = $pdo->lastInsertId();

        $stmtUser = $pdo->prepare('SELECT * FROM utilisateur WHERE utilisateur_id = ?');
        $stmtUser->execute([$nouvel_id]);
        $utilisateur = $stmtUser->fetch();

        unset($utilisateur['password']);
        $_SESSION['utilisateur'] = $utilisateur;

        header('location: index.php');
        exit;
    } else {
        $erreur = "Les mots de passe ne correspondent pas.";
    }
}

?>

<?php $css_pages = ['forms']; ?>
<?php include 'includes/header.php'; ?>

    <main>
        <form class="form-page" method="post" action="">

            <?php if (isset($erreur)) : ?>
                <p class="erreur">
                    <?= htmlspecialchars($erreur) ?>
                </p>
            <?php endif; ?>

            <img src="assets/images/inscription-banner.png" class="inscription-banner" alt="Banner">
            <p class="form-description">Quelques instants suffisent pour créer votre compte et savourer nos spécialités.</p>

            <div class="form-civilite">
                <div class="infos-mr-mme">
                    <input class="input-mr-mme" type="radio" id="mr" name="genre" value="mr"
                           autocomplete="honorific-prefix">
                    <label for="mr">Mr</label>
                    <input class="input-mr-mme" type="radio" id="mme" name="genre" value="mme"
                           autocomplete="honorific-prefix">
                    <label for="mme">Mme</label>
                </div>
            </div>

            <div class="form-nom">
                <label for="nom">Nom</label>
                <input type="text" id="nom" name="nom" placeholder="Votre Nom" autocomplete="family-name" required>
            </div>

            <div class="form-prenom">
                <label for="prénom">Prénom</label>
                <input type="text" id="prénom" name="prenom" placeholder="Votre Prénom" autocomplete="given-name" required>
            </div>

            <div class="form-email">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" placeholder="Votre Email" autocomplete="email" required>
            </div>

            <div class="form-tel">
                <label for="telephone">Téléphone</label>
                <input type="tel" id="telephone" name="telephone" inputmode="numeric" pattern="[0-9]{10}" maxlength="10"
                       placeholder="Votre n° de téléphone" autocomplete="tel" required>
            </div>

            <div class="form-adresse">
                <label for="adresse">Adresse</label>
                <input type="text" id="adresse" name="adresse" placeholder="Ex: 8 bis rue de la fontaine"
                       autocomplete="address-line1" required>
            </div>

            <div class="form-code-postal">
                <label for="code-postal">Code Postal</label>
                <input type="text" id="code-postal" name="code-postal" inputmode="numeric" pattern="[0-9]{5}" maxlength="5"
                       placeholder="Votre Code Postal" autocomplete="postal-code" required>
            </div>

            <div class="form-ville">
                <label for="ville">Ville</label>
                <input type="text" id="ville" name="ville" placeholder="Votre Ville" autocomplete="address-level2" required>
            </div>

            <div class="form-mdp">
                <label for="mdp">Mot de passe</label>
                <input type="password" id="mdp" name="mdp"
                       pattern="(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{10,}" minlength="10"
                       title="Minimum 10 caractères, avec au moins une majuscule, une minuscule, un chiffre et un caractère spécial"
                       placeholder="Mot de passe" autocomplete="new-password" required>
            </div>

            <div class="form-mdp-confirm">
                <label for="mdp-confirm">Confirmation du mot de passe</label>
                <input type="password" id="mdp-confirm" name="mdp-confirm" placeholder="Confirmer votre mot de passe"
                       autocomplete="new-password" required>
                <p id="erreur-mdp" class="erreur"></p>
            </div>

            <div class="form-submit">
                <button class="form-submit-button" type="submit">S'inscrire !</button><br>
                <p>Un mail de confirmation vous sera envoyé après validation de votre inscription</p>
            </div>

        </form>
    </main>

<?php require 'includes/footer.php'; ?>