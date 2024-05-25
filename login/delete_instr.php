<?php
// Vérifier si l'ID de l'utilisateur à supprimer est présent dans l'URL
if (isset($_GET['id']) && !empty($_GET['id'])) {
    // Récupérer l'ID de l'utilisateur à supprimer
    $user_id = $_GET['id'];

    // Inclure le fichier de connexion à la base de données
    require_once("../connexion/conx.php");

    // Débuter une transaction
    $conn->begin_transaction();

    try {
        // Préparer la requête de suppression des enregistrements dépendants
        $sql1 = "DELETE FROM enrolled_courses WHERE user_id = ?";
        $stmt1 = $conn->prepare($sql1);
        $stmt1->bind_param("i", $user_id);
        $stmt1->execute();
        $stmt1->close();

        // Préparer la requête de suppression de l'utilisateur
        $sql2 = "DELETE FROM user_form WHERE id = ?";
        $stmt2 = $conn->prepare($sql2);
        $stmt2->bind_param("i", $user_id);
        $stmt2->execute();
        $stmt2->close();

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
