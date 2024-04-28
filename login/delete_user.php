<?php
// Vérifier si l'ID de l'utilisateur à supprimer est présent dans l'URL
if (isset($_GET['id']) && !empty($_GET['id'])) {
    // Récupérer l'ID de l'utilisateur à supprimer
    $user_id = $_GET['id'];

    // Inclure le fichier de connexion à la base de données
    require_once("../connexion/conx.php");

    // Préparer la requête de suppression de l'utilisateur
    $sql = "DELETE FROM user_form WHERE id = ?";

    // Préparer la déclaration
    $stmt = $conn->prepare($sql);

    // Lier les paramètres
    $stmt->bind_param("i", $user_id);

    // Exécuter la requête de suppression
    if ($stmt->execute()) {
        // Rediriger vers la page d'origine avec un message de succès
        header("Location: ".$_SERVER['HTTP_REFERER']."?success=1");
        exit();
    } else {
        // Rediriger vers la page d'origine avec un message d'erreur
        header("Location: ".$_SERVER['HTTP_REFERER']."?error=1");
        exit();
    }

    // Fermer la déclaration
    $stmt->close();

    // Fermer la connexion à la base de données
    $conn->close();
} else {
    // Rediriger vers la page d'origine si l'ID de l'utilisateur n'est pas fourni
    header("Location: ".$_SERVER['HTTP_REFERER']);
    exit();
}
?>
