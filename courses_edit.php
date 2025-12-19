<?php
require_once 'config.php';
require_once 'header.php';

if (!isset($_GET['id'])) {
    echo '<div class="alert alert-danger">ID invalide</div>';
    require_once 'footer.php';
    exit();
}
$course_id = $_GET['id'];



$sql = "SELECT * FROM course where id = ?";

$sqlParam = mysqli_prepare($conn,$sql);

mysqli_stmt_bind_param($sqlParam,'i',$course_id);
mysqli_stmt_execute($sqlParam);
$result = mysqli_stmt_get_result($sqlParam);

if (mysqli_num_rows($result) == 0) {
    echo '<div class="alert alert-danger">Cours non trouvé</div>';
    require_once 'footer.php';
    exit();
}

$course = mysqli_fetch_assoc($result);
mysqli_stmt_close($sqlParam);

$title = $course['title'];
$description = $course['description'];
$level = $course['level'];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = $_POST['title'];
    $description = $_POST['description'];
    $level = $_POST['level'];
    
    if (empty($title) || empty($description) || empty($level)) {
         echo "Tous les champs sont obligatoires";
    } else {
        $sql = "UPDATE Course SET title = ?, description = ?, level = ? WHERE id = ?";
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, "sssi", $title, $description, $level, $course_id);
        
        if (mysqli_stmt_execute($stmt)) {
            echo "Cours modifié avec succès !";
            header("location:courses_list.php");
        } else {
            echo "Erreur lors de la modification : ";
        }
        mysqli_stmt_close($stmt);
    }
}
?>

<div class="card">
    <div class="card-header">
        <h2><i class="fas fa-edit"></i> Modifier le Cours</h2>
    </div>
    <div class="card-body">
        
        <form method="POST" action="">
            <div class="mb-3">
                <label for="title" class="form-label">Titre du Cours *</label>
                <input type="text" class="form-control" id="title" name="title" 
                       value="<?php echo htmlspecialchars($title) ?>" required>
            </div>
            
            <div class="mb-3">
                <label for="description" class="form-label">Description *</label>
                <textarea class="form-control" id="description" name="description" 
                          rows="5" required><?php echo htmlspecialchars($description); ?></textarea>
            </div>
            
            <div class="mb-3">
                <label for="level" class="form-label">Statut *</label>
                <select class="form-select" id="level" name="level" required>
                    <option value="Under Process" <?php echo ($level == 'Under Process') ? 'selected' : ''; ?>>En cours</option>
                    <option value="Delivered" <?php echo ($level == 'Delivered') ? 'selected' : ''; ?>>Livré</option>
                    <option value="Cancelled" <?php echo ($level == 'Cancelled') ? 'selected' : ''; ?>>Annulé</option>
                </select>
            </div>
            
            <div class="d-flex justify-content-between">
                <a href="courses.php" class="btn btn-secondary">
                    <i class="fas fa-times"></i> Annuler
                </a>
                <button type="submit" class="btn btn-success">
                    <i class="fas fa-save"></i> Enregistrer les modifications
                </button>
            </div>
        </form>
    </div>
</div>

<?php 
mysqli_free_result($result);
require_once 'footer.php'; 
?>