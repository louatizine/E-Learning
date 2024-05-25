<?php
// Vérifier si l'ID de l'utilisateur à supprimer est présent dans l'URL
if (isset($_GET['id']) && !empty($_GET['id'])) {
    // Récupérer l'ID de l'utilisateur à supprimer
    $crm_id = $_GET['id'];

    // Inclure le fichier de connexion à la base de données
    require_once("../connexion/conx.php");

    // Débuter une transaction
    $conn->begin_transaction();

    try {
        // Préparer la requête de suppression de l'utilisateur
        $sql = "DELETE FROM contacte WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $crm_id);
        $stmt->execute();
        $stmt->close();

        // Commit the transaction
        $conn->commit();

        // Rediriger vers la page d'origine avec un message de succès
        header("Location: ".$_SERVER['HTTP_REFERER']."?success=1");
        exit();
    } catch (Exception $e) {
        // Rollback the transaction if something failed
        $conn->rollback();

        // Rediriger vers la page d'origine avec un message d'erreur
        header("Location: ".$_SERVER['HTTP_REFERER']."?error=1");
        exit();
    }

    // Fermer la connexion à la base de données
    $conn->close();
} else {
    // Rediriger vers la page d'origine si l'ID de l'utilisateur n'est pas fourni
    header("Location: ".$_SERVER['HTTP_REFERER']);
    exit();
}
?>
