<?php
require_once 'config.php';
$page_title = "Supprimer un Cours";
require_once 'header.php';

if (!isset($_GET['id'])) {
    echo '<div class="alert alert-danger">ID du cours invalide</div>';
    require_once 'footer.php';
    exit();
}

$course_id = $_GET['id'];

if($_SERVER['REQUEST_METHOD']== 'POST'){

    $sql = "DELETE from course where id = $course_id";

    $result = mysqli_query($conn,$sql);


    if($result){
        echo "cours supprimer avec succes";
    }
    header('location:courses_list.php');
}


?>
<div class="container">
    <div class="form-container">
        <div class="card">
            <div class="card-header">
                <h2>Supprimer un Cours</h2>
                <a href="courses_list.php" class="btn btn-secondary">← Retour à la liste</a>
            </div>
            
            <form method="POST" action="">
                <div class="form-group">
                    <h2>Voulez vous supprimer ce cours !</h2>
                </div>
                <div style="display: flex; gap: 10px; margin-top: 30px;">
                    <button style="background:red " type="submit" class="btn btn-success">Supprimer le cours</button>
                    <a href="courses_list.php" class="btn btn-secondary">Annuler</a>
                </div>
            </form>
        </div>
    </div>
</div>

<?php require_once 'footer.php'; ?>

