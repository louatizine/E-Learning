<?php
require_once("../connexion/conx.php");

// Vérifier la connexion
if ($conn->connect_error) {
    die("Connexion échouée : " . $conn->connect_error);
}

// Requête pour récupérer tous les utilisateurs ayant le rôle "user"
$sql = "SELECT * FROM contacte";
$result = $conn->query($sql);

// Vérifier s'il y a des résultats
if ($result->num_rows > 0) {
    // Compter le nombre d'utilisateurs
    $total_msg = $result->num_rows;
} else {
    $total_msg = 0;
}

$sql = "SELECT * FROM user_form WHERE user_type = 'user'";
$result1 = $conn->query($sql);
// Vérifier s'il y a des résultats

if ($result1->num_rows > 0) {
    // Compter le nombre d'utilisateurs
    $total_user = $result1->num_rows;
} else {
    $total_user = 0;
}
// Requête pour récupérer tous les utilisateurs ayant le rôle "user"
$sql = "SELECT * FROM user_form WHERE user_type = 'instructor'";
$result2 = $conn->query($sql);

// Vérifier s'il y a des résultats
if ($result->num_rows > 0) {
    // Compter le nombre d'utilisateurs
    $total_inst = $result2->num_rows;
} else {
    $total_inst = 0;
}

// Fermer la connexion à la base de données
$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>CRM dash</title>
<meta content="width=device-width, initial-scale=1.0" name="viewport">
<meta content="" name="keywords">
<meta content="" name="description">
<link href="img/icon.png" rel="icon">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Heebo:wght@400;500;600&family=Nunito:wght@600;700;800&display=swap" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">
<link href="../lib/animate/animate.min.css" rel="stylesheet">
<link href="../lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
<link href="../css/bootstrap.min.css" rel="stylesheet">
<link href="../css/style.css" rel="stylesheet">
<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet">
<style>
    body{
    background:#f3f3f3;
    margin-top:20px;
    color: #616f80;
}
.card {
    border: none;
    margin-bottom: 24px;
    -webkit-box-shadow: 0 0 13px 0 rgba(236,236,241,.44);
    box-shadow: 0 0 13px 0 rgba(236,236,241,.44);
}

.avatar-xs {
    height: 2.3rem;
    width: 2.3rem;
}
</style>
</head>
<body>
<?php include '../repite/header_admin.php'; ?>
<div></div>
<div class="container">
     <!-- Afficher le nombre d'utilisateurs -->
     <div style="display: flex ">
        <div class="col-xl-3 col-md-6" style="margin-top: 20px;">
            <div class="card bg-pattern">
                <div class="card-body">
                    <div class="float-right">
                        <i class="fa fa-archive text-primary h4 ml-3"></i>
                    </div>
                    <h5 class="font-size-20 mt-0 pt-1"><?php echo $total_user; ?></h5>
                    <p class="text-muted mb-0"><a href="admin_dashboard.php">Liste Etudiant</a></p>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6" style="margin-top: 20px;margin-left: 10px;">
            <div class="card bg-pattern">
                <div class="card-body">
                    <div class="float-right">
                        <i class="fa fa-archive text-primary h4 ml-3"></i>
                    </div>
                    <h5 class="font-size-20 mt-0 pt-1"><?php echo $total_msg; ?></h5>
                    <p class="text-muted mb-0"><a href="crm_dashboard.php">CRM</a></p>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6" style="margin-top: 20px;margin-left: 10px;">
            <div class="card bg-pattern">
                <div class="card-body">
                    <div class="float-right">
                        <i class="fa fa-archive text-primary h4 ml-3"></i>
                    </div>
                    <h5 class="font-size-20 mt-0 pt-1"><?php echo $total_inst; ?></h5>
                    <p class="text-muted mb-0"><a href="Instructor_dashboard.php">Liste Instructor</a></p>
                </div>
            </div>
        </div>
        </div>
    <!-- end row -->

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive project-list">
                        <table class="table project-table table-centered table-nowrap">
                            <thead>
                                <tr>
                                <th scope="col">ID</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">Subject</th>
                                    <th scope="col">State</th>
                                    <th scope="col">Message</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php
                                    // Si des utilisateurs sont trouvés
                                    if ($result->num_rows > 0) {
                                        // Boucle à travers les résultats de la requête
                                        while ($row = $result->fetch_assoc()) {
                                            // Intégration des données dans chaque ligne du tableau
                                            echo '<tr>';
                                            echo '<th scope="row">' . $row["id"] . '</th>';
                                            echo '<td>' . $row["name"] . '</td>';
                                            echo '<td>' . $row["email"] . '</td>';
                                            echo '<td>' . $row["subject"] . '</td>';
                                            echo '<td>' ;
                                            echo '<span class="text-danger font-12"><i class="mdi mdi-checkbox-blank-circle mr-1"></i>Not Seen </span>';
                                            echo'</td>';
                                            echo '<td>' . $row["message"] . '</td>';
                                            echo '<td>';
                                            echo '<div class="action">';
                                           
                                            echo'<a href="delete_crm.php?id=' . $row["id"] . '" class="text-danger" data-toggle="tooltip" data-placement="top" title="Supprimer l\'utilisateur"> <i class="fa fa fa-remove h5 m-0 text-danger"></i></a>';                                            echo '</div>';
                                            echo '</div>';
                                            echo '</td>';
                                            echo '</tr>';
                                        }
                                    } else {
                                        // Si aucun utilisateur trouvé
                                        echo '<tr><td colspan="7">Aucun utilisateur trouvé.</td></tr>';
                                    }
                                    ?>

                          
                            </tbody>
                        </table>
                    </div>
                    <!-- end project-list -->

                    <div class="pt-3">
                        <ul class="pagination justify-content-end mb-0">
                            <li class="page-item disabled">
                                <a class="page-link" href="#" tabindex="-1" aria-disabled="true">Previous</a>
                            </li>
                            <li class="page-item"><a class="page-link" href="#">1</a></li>
                            <li class="page-item active"><a class="page-link" href="#">2</a></li>
                            <li class="page-item"><a class="page-link" href="#">3</a></li>
                            <li class="page-item">
                                <a class="page-link" href="#">Next</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end row -->
</div>
<?php include("../repite/footer.php"); ?>
<a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top"><i class="bi bi-arrow-up"></i></a>
<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="lib/wow/wow.min.js"></script>
<script src="lib/easing/easing.min.js"></script>
<script src="lib/waypoints/waypoints.min.js"></script>
<script src="lib/owlcarousel/owl.carousel.min.js"></script>
<script src="js/main.js"></script>
</body>
</html>
