<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    header('Content-Type: application/json');

    $nom = trim($_POST['contact-nom'] ?? '');
    $prenom = trim($_POST['contact-prenom'] ?? '');
    $tel = trim($_POST['contact-tel'] ?? '');
    $date = trim($_POST['contact-date'] ?? '');
    $email = trim($_POST['contact-email'] ?? '');
    $texte = trim($_POST['contact-texte'] ?? '');

    if (empty($nom) || empty($prenom) || empty($tel) || empty($email) || empty($texte) || empty($date)) {
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


    $sujet = "Demande de devis - $nom $prenom";

    $corps = "Nom: $nom\n";
    $corps .= "Prénom: $prenom\n";
    $corps .= "Téléphone: $tel\n";
    $corps .= "Date: $date\n";
    $corps .= "Email: $email\n\n";
    $corps .= "Message:\n$texte\n";

    $headers = "From: no-reply@vite-et-gourmand.fr\r\nReply-To: $email";

    $destinataire = "contact@vite-et-gourmand.fr";

    if (mail($destinataire, $sujet, $corps, $headers)) {
        echo json_encode(['success' => true, 'message' => 'Votre message a bien été envoyé.']);
        exit;
    } else {
        echo json_encode(['success' => false, 'message' => 'Une erreur est survenue lors de l\'envoi du message.']);
        exit;
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Méthode de requête non valide.']);
    exit;
}


