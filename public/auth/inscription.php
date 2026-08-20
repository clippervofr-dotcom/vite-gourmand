<?php
require_once __DIR__ . '/../../vendor/autoload.php';
require_once __DIR__ . '/../../src/Config/bootstrap.php';
require_once ROOT_PATH . '/src/Config/session.php';
require ROOT_PATH . '/src/Security/csrf.php';

use Controllers\UtilisateurController;
use Entities\Utilisateur;
use Repositories\UtilisateurRepositoryMysql;


$erreurs = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    verifierCsrfPage('inscription.php');

    $utilisateurRepository = new UtilisateurRepositoryMysql($pdo);
    $utilisateurController = new UtilisateurController($utilisateurRepository);

    $mdp = $_POST['mdp'] ?? '';
    $mdp_confirm = $_POST['mdp-confirm'] ?? '';
    $mdpComplexe = preg_match('/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{8,}$/', $mdp) === 1;
    if (!$mdpComplexe) {
        $erreurs[] = 'Le mot de passe doit contenir au moins 8 caractères, une majuscule, une minuscule, un chiffre et un caractère spécial.';
    }
    $mdpValide = $mdp === $mdp_confirm && $mdpComplexe;
    if (!$mdpValide) {
        $erreurs[] = 'Les mots de passe ne correspondent pas.';
    }

    $nom = trim($_POST['nom'] ?? '');
    $nomValide = preg_match('/^\\b(?:\\w|-)+\\b$/', $nom);
    if (!$nomValide) {
        $erreurs[] = 'Le nom invalide.';
    }

    $prenom = trim($_POST['prenom'] ?? '');
    $prenomValide = preg_match('/^\\b(?:\\w|-)+\\b$/', $prenom);
    if (!$prenomValide) {
        $erreurs[] = 'Le prenom invalide.';
    }

    $adresse = trim($_POST['adresse'] ?? '');
    $adresseValide = mb_strlen($adresse) <= 150;
    if (!$adresseValide) {
        $erreurs[] = 'L\'adresse est trop longue.';
    }

    $ville = trim($_POST['ville'] ?? '');
    $villeValide = preg_match('/^\\b(?:\\w|-)+\\b$/', $ville);
    if (!$villeValide) {
        $erreurs[] = 'Le ville invalide.';
    }

    $codePostal = trim($_POST['code-postal'] ?? '');
    $codePostalValide = preg_match('/^[0-9]{5}$/', $codePostal);
    if (!$codePostalValide) {
        $erreurs[] = 'Code postal invalide.';
    }

    $telephone = trim($_POST['telephone'] ?? '');
    $telephoneValide = preg_match('/^[0-9]{10}$/', $telephone);
    if (!$telephoneValide) {
        $erreurs[] = 'Téléphone invalide.';
    }

    $email = trim($_POST['email'] ?? '');
    $emailValide = filter_var($email, FILTER_VALIDATE_EMAIL);
    if (!$emailValide) {
        $erreurs[] = 'Email invalide.';
    }


    if ($nomValide && $prenomValide && $mdpValide && $emailValide && $telephoneValide && $villeValide && $adresseValide && $codePostalValide) {
        $mdp_hache = password_hash($mdp, PASSWORD_DEFAULT);

        $roleId= 1; //role utilisateur

        $newUtilisateur = new Utilisateur(
                null,
                $nom,
                $prenom,
                $email,
                $telephone,
                $adresse,
                $ville,
                $codePostal,
                true,
                $roleId
        );

        $inscriptionUtilisateur = $utilisateurController->ajouterUtilisateur($newUtilisateur);
        if (!$inscriptionUtilisateur['success']) {
            $erreurs[] = 'Erreur d\'enregistrement.';
        } else {
            $ajoutMdp = $utilisateurController->ajouterPassword($newUtilisateur->getId(), $mdp_hache);
            if ($ajoutMdp['success']) {
                session_regenerate_id(true);
                $_SESSION['utilisateur'] = $newUtilisateur->jsonSerialize();
                header('location: index.php');
                exit;
            } else {
                $erreurs[] = 'Erreur d\'ajout du mot de passe.';
            }
        }
    }
}
?>

<?php $css_pages = ['forms']; ?>
<?php include 'includes/header.php'; ?>

    <main>
        <form class="form-page" method="post" action="">
            <input type="hidden" name="csrf_token" value="<?= htmlspecialchars($_SESSION['csrf_token']) ?>">

            <?php if (count($erreurs) > 0) : ?>
                <ul class="erreur-inscription">
                    <?php foreach ($erreurs as $erreur): ?>
                        <li><?= htmlspecialchars($erreur, ENT_QUOTES, 'UTF-8') ?></li>
                    <?php endforeach; ?>
                </ul>
            <?php endif; ?>

            <img src="../assets/images/inscription-banner.png" class="inscription-banner" alt="Banner">
            <p class="form-description">Quelques instants suffisent pour créer votre compte et savourer nos spécialités.</p>

            <div class="form-nom">
                <label for="nom">Nom</label>
                <input type="text" id="nom" name="nom" placeholder="Votre Nom" autocomplete="family-name" maxlength="50" pattern="^\b(?:\w|-)+\b$" required>
            </div>

            <div class="form-prenom">
                <label for="prenom">Prénom</label>
                <input type="text" id="prenom" name="prenom" placeholder="Votre Prénom" autocomplete="given-name" maxlength="50" pattern="^\b(?:\w|-)+\b$" required>
            </div>

            <div class="form-email">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" placeholder="Votre Email" autocomplete="email" maxlength="100" pattern="^[a-z0-9!#$%&'*+\/=?^_`\{\|\}~\-]+(?:\.[a-z0-9!#$%&'*+\/=?^_`\{\|\}~\-]+)*@(?:[a-z0-9](?:[a-z0-9\-]*[a-z0-9])?\.)+[a-z0-9](?:[a-z0-9\-]*[a-z0-9])?$" required>
            </div>

            <div class="form-tel">
                <label for="telephone">Téléphone</label>
                <input type="tel" id="telephone" name="telephone" inputmode="numeric" pattern="^[0-9]{10}$" maxlength="10"
                       placeholder="Votre n° de téléphone" autocomplete="tel" required>
            </div>

            <div class="form-adresse">
                <label for="adresse">Adresse</label>
                <input type="text" id="adresse" name="adresse" placeholder="Ex: 8 bis rue de la fontaine"
                       autocomplete="address-line1" maxlength="150" required>
            </div>

            <div class="form-code-postal">
                <label for="code-postal">Code Postal</label>
                <input type="text" id="code-postal" name="code-postal" inputmode="numeric" pattern="^[0-9]{5}$" maxlength="5"
                       placeholder="Votre Code Postal" autocomplete="postal-code" required>
            </div>

            <div class="form-ville">
                <label for="ville">Ville</label>
                <input type="text" id="ville" name="ville" placeholder="Votre Ville" autocomplete="address-level2" maxlength="50" pattern="^\b(?:\w|-)+\b$" required>
            </div>

            <div class="form-mdp">
                <label for="mdp">Mot de passe</label>
                <input type="password" id="mdp" name="mdp"
                       pattern="^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{8,}$"
                       minlength="8"
                       title="Minimum 8 caractères, avec au moins une majuscule, une minuscule, un chiffre et un caractère spécial"
                       placeholder="Mot de passe" autocomplete="new-password" required>
            </div>

            <div class="form-mdp-confirm">
                <label for="mdp-confirm">Confirmation du mot de passe</label>
                <input type="password" id="mdp-confirm" name="mdp-confirm" placeholder="Confirmer votre mot de passe"
                       pattern="^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{8,}$"
                       minlength="8"
                       title="Minimum 8 caractères, avec au moins une majuscule, une minuscule, un chiffre et un caractère spécial"
                       autocomplete="new-password" required>
                <p id="erreur-mdp" class="erreur"></p>
            </div>

            <div class="form-submit">
                <button class="animated-button" id="animated-btn-inscription" type="submit">
                    <svg viewBox="0 0 24 24" class="arr-2" xmlns="http://www.w3.org/2000/svg">
                        <path
                                d="M16.1716 10.9999L10.8076 5.63589L12.2218 4.22168L20 11.9999L12.2218 19.778L10.8076 18.3638L16.1716 12.9999H4V10.9999H16.1716Z"
                        ></path>
                    </svg>
                    <span class="text">S'inscrire !</span>
                    <span class="circle"></span>
                    <svg viewBox="0 0 24 24" class="arr-1" xmlns="http://www.w3.org/2000/svg">
                        <path
                                d="M16.1716 10.9999L10.8076 5.63589L12.2218 4.22168L20 11.9999L12.2218 19.778L10.8076 18.3638L16.1716 12.9999H4V10.9999H16.1716Z"
                        ></path>
                    </svg>
                </button><br>
                <p>Un mail de confirmation vous sera envoyé après validation de votre inscription</p>
            </div>

        </form>
    </main>

<?php require ROOT_PATH . '/src/Views/partials/footer.php'; ?>