<?php
require_once __DIR__ . '/../../vendor/autoload.php';
require_once __DIR__ . '/../../src/Config/root-path.php';
require_once ROOT_PATH . '/src/Config/session.php';
require ROOT_PATH . '/src/Security/csrf.php';

use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\PHPMailer;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    verifierCsrf();

    header('Content-Type: application/json');

    $nom = trim($_POST['contact-nom'] ?? '');
    $prenom = trim($_POST['contact-prenom'] ?? '');
    $tel = trim($_POST['contact-tel'] ?? '');
    $email = trim($_POST['contact-email'] ?? '');
    $texte = trim($_POST['contact-texte'] ?? '');

    if (empty($nom) || empty($prenom) || empty($tel) || empty($email) || empty($texte)) {
        echo json_encode(['success' => false, 'message' => 'Tous les champs sont requis.']);
        exit;
    }

    $nomValide = preg_match('/^\\b(?:\\w|-)+\\b$/', $nom);
    if (!$nomValide) {
        echo json_encode(['success' => false, 'message' => 'Nom invalide.']);
        exit;
    }

    $prenomValide = preg_match('/^\\b(?:\\w|-)+\\b$/', $prenom);
    if (!$prenomValide) {
        echo json_encode(['success' => false, 'message' => 'Prénom invalide.']);
        exit;
    }

    $telephoneValide = preg_match('/^[0-9]{10}$/', $tel);
    if (!$telephoneValide) {
        echo json_encode(['success' => false, 'message' => 'Téléphone invalide.']);
        exit;
    }

    $emailValide = filter_var($email, FILTER_VALIDATE_EMAIL);
    if (!$emailValide) {
        echo json_encode(['success' => false, 'message' => 'Email invalide.']);
        exit;
    }

    $sujet = "Mail de contact - $nom $prenom";

    $corps = "Nom: $nom\n";
    $corps .= "Prénom: $prenom\n";
    $corps .= "Téléphone: $tel\n";
    $corps .= "Date: " . (new DateTime())->format('Y-m-d H:i:s') . "\n";
    $corps .= "Email: $email\n\n";
    $corps .= "Message:\n$texte\n";


    if (file_exists(ROOT_PATH . '/.envtrfhsth')) {
        $env = parse_ini_file(ROOT_PATH . '/.envtrfhsth');
        //verif si la variable MAIL_HOST existe dans le fichier .envtrfhsth
        if (array_key_exists('MAIL_HOST', $env) && array_key_exists('MAIL_USERNAME', $env) && array_key_exists('MAIL_PASSWORD', $env) && array_key_exists('MAIL_PORT', $env)) {
            $mail = new PHPMailer(true);
            try {
                $mail->isSMTP();
                $mail->Host = $env['MAIL_HOST'];
                $mail->SMTPAuth = true;
                $mail->Username = $env['MAIL_USERNAME'];
                $mail->Password = $env['MAIL_PASSWORD'];
                $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
                $mail->Port = $env['MAIL_PORT'];

                $mail->setFrom('no-reply@vite-et-gourmand.fr', 'Vite & Gourmand');
                $mail->addAddress('contact@vite-et-gourmand.fr');
                $mail->addReplyTo($email);

                $mail->Subject = $sujet;
                $mail->Body = $corps;

                $mail->send();
                echo json_encode(['success' => true, 'message' => 'Votre message a bien été envoyé.']);
            } catch (Exception $e) {
                error_log('Erreur PHPMailer : ' . $mail->ErrorInfo);
                echo json_encode(['success' => false, 'message' => 'Une erreur est survenue lors de l\'envoi du message.']);
            }
        } else {
            echo json_encode(['success' => false, 'message' => 'Les variables de configuration SMTP sont incomplètes dans le fichier .envtrfhsth.']);
            exit;
        }
    } else {
        echo json_encode(['success' => false, 'message' => 'Le fichier .envtrfhsth est introuvable.']);
        exit;
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Méthode de requête non valide.']);
    exit;
}


