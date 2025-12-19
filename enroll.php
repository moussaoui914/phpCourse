<?php
require('config.php');

$idCourse = $_GET['id'];
$username = $_SESSION['username']; 

$getId = "SELECT id from users where username = '$username'";
$result = mysqli_query($conn,$getId);

$userId = mysqli_fetch_assoc($result);



if ($_SERVER['REQUEST_METHOD']== 'POST'){
$sql = "INSERT into enrollments(course_id,user_id) values(?,?)";
$resultFinal = mysqli_prepare($conn,$sql);
mysqli_stmt_bind_param($resultFinal,'ii',$idCourse,$userId);
$stm =mysqli_stmt_execute($resultFinal);
if($stm){
    header('location:courses_list.php');
}
}
?>






<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Accueil - Gestion des Cours</title>
    <link rel="stylesheet" href="stylee.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body>
    <header class="header">
        <div class="header-container">
            <div class="logo">
                <h1><i class="fas fa-graduation-cap"></i> Gestion des Cours</h1>
            </div>
            <div class="user-info">
                <div class="user-dropdown">
                    <button class="user-btn">
                        <i class="fas fa-user-circle"></i>
                        <span>Mr Admin</span>
                        <i class="fas fa-chevron-down"></i>
                    </button>
                    <div class="dropdown-menu">
                        <a href="#"><i class="fas fa-user"></i> Mon Profil</a>
                        <a href="#"><i class="fas fa-cog"></i> Paramètres</a>
                        <a href="#logout-popup" class="logout-btn"><i class="fas fa-sign-out-alt"></i> Déconnexion</a>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <form action="" method="POST">
            <div class="popup-overlay" id="logout-popup">
        <div class="popup-container">
            <div style="background : green" class="popup-header">
                <h3><i class="fas fa-sign-out-alt"></i> Confirmation d'ajout du cour</h3>
                <a href="#" class="popup-close">&times;</a>
            </div>
            <div class="popup-body">
                <div class="popup-icon">
                    <i class="fas fa-question-circle"></i>
                </div>
                <p>Confirmer l'ajout de ce cour</p>
            </div>
            <div class="popup-footer">
                <a href="index.php" class="btn btn-secondary popup-close">Annuler</a>
                <input style="background : green" class="btn btn-danger" type="submit" value="Ajouter">
            </div>
        </div>
    </div>
    </form>

</body>
</html>