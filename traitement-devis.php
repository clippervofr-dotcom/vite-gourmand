<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    header('Content-Type: application/json');

    $nom = trim($_POST['contact-nom'] ?? '');
    $prenom = trim($_POST['contact-prenom'] ?? '');
    $tel = trim($_POST['contact-tel'] ?? '');
    $date = trim($_POST['contact-date'] ?? '');
    $email = trim($_POST['contact-email'] ?? '');
    $texte = trim($_POST['contact-texte'] ?? '');

    if ($nom !== '' && $prenom !== '' && $tel !== '' && $date !== '' && $email !== '' && $texte !== '' && filter_var($email, FILTER_VALIDATE_EMAIL)) {

        $sujet = "Demande de devis - $nom $prenom";

        $corps = "Nom: $nom\n";
        $corps .= "Prénom: $prenom\n";
        $corps .= "Téléphone: $tel\n";
        $corps .= "Date: $date\n";
        $corps .= "Email: $email\n\n";  
        $corps .= "Message:\n$texte\n";

        $headers = "From: no-reply@vite-et-gourmand.fr\r\nReply-To: $email";

        $destinataire = "contact@vite-et-gourmand.fr";

        mail($destinataire, $sujet, $corps, $headers);

        echo json_encode(['success' => true, 'message' => 'Votre message a bien été envoyé.']);
        exit;
    }
    else {
        echo json_encode(['success' => false, 'message' => 'Une erreur est survenue.']);
        exit;
    }
}
?>
