<?php
require_once 'config.php';
require_once 'header.php';

if(isset($_SESSION['username'])){
$username = $_SESSION['username'];
}
$courses_count = 0;
$sections_count = 0;

    $sql = "SELECT COUNT(*) as total FROM course";
    $result = mysqli_query($conn, $sql);
    if ($result) {
        $row = mysqli_fetch_assoc($result);
        $courses_count = $row['total'];
    }
    
    $sql = "SELECT COUNT(*) as total FROM sections";
    $result = mysqli_query($conn, $sql);
    if ($result) {
        $row = mysqli_fetch_assoc($result);
        $sections_count = $row['total'];
    }
?>

<div class="container">
    <div class="card">
        <div class="card-header">
            <h2>🏠 Bienvenue dans le système de gestion des cours <?php if (isset($_SESSION['username'])){
                echo "Mr " .$_SESSION['username'];
            }?></h2>
        </div>
        
        <div style="text-align: center; padding: 40px 20px;">
            <h3 style="color: var(--primary-color); margin-bottom: 20px;">
                Gestion complète des cours et sections
            </h3>
            
            <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 20px; margin-top: 40px;">
                <a href="courses_list.php" class="btn btn-primary" style="padding: 20px; text-align: center;">
                    <div style="font-size: 48px; margin-bottom: 10px;">📋</div>
                    <h4>Liste des Cours</h4>
                    <p>Consulter et gérer tous les cours</p>
                </a>
                
                <a href="courses_create.php" class="btn btn-success" style="padding: 20px; text-align: center;">
                    <div style="font-size: 48px; margin-bottom: 10px;">➕</div>
                    <h4>Nouveau Cours</h4>
                    <p>Créer un nouveau cours</p>
                </a>
                
                <a href="sections_list.php" class="btn btn-warning" style="padding: 20px; text-align: center;">
                    <div style="font-size: 48px; margin-bottom: 10px;">📑</div>
                    <h4>Sections</h4>
                    <p>Gérer les sections</p>
                </a>
            </div>
            
            <?php include("stats_dashboard.php") ?>
        </div>
    </div>
</div>

<?php require_once 'footer.php'; ?>