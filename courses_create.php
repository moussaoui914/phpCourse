<?php
require_once 'config.php';
require_once 'header.php';


if($_SERVER['REQUEST_METHOD']== 'POST'){
    $title = $_POST['title'];
    $description = $_POST['description'];
    $level = $_POST['level'];
    $date = $_POST['created_at'];

    $sql = "INSERT INTO course(title, description, level,created_at) 
    VALUES ('$title','$description','$level','$date')";

    $result = mysqli_query($conn,$sql);

        // $stmt = mysqli_prepare($conn, $sql);
        // mysqli_stmt_bind_param($stmt, "sss", $title, $description, $level);
        // mysqli_stmt_execute($stmt)


    if($result){
        echo "cours ajouter avec succes";
    }
    header('location:courses_list.php');
}


?>
<div class="container">
    <div class="form-container">
        <div class="card">
            <div class="card-header">
                <h2>➕ Créer un Nouveau Cours</h2>
                <a href="courses_list.php" class="btn btn-secondary">← Retour à la liste</a>
            </div>
            
            <form method="POST" action="">
                <div class="form-group">
                    <label for="title">Titre du cours *</label>
                    <input type="text" class="form-control" id="title" name="title" 
                           required maxlength="50" placeholder="Entrez le titre du cours">
                </div>
                
                <div class="form-group">
                    <label for="description">Description</label>
                    <textarea class="form-control" id="description" name="description" 
                              rows="4" placeholder="Décrivez le cours..."></textarea>
                </div>
                
                <div class="form-group">
                    <label for="level">Niveau *</label>
                    <select class="form-control" id="level" name="level" required>
                        <option value="">Sélectionnez un niveau</option>
                        <option value="Delivered">Delivered</option>
                        <option value="Under Process">Under Process</option>
                        <option value="Cancelled">Cancelled</option>
                    </select>
                </div>
                
                <div class="form-group">
                    <label for="created_at">Date de création *</label>
                    <input type="datetime-local" 
                           class="form-control" 
                           id="created_at" 
                           name="created_at"
                           required
                           placeholder="AAAA-MM-JJ HH:MM">
                    <small class="text-muted">
                        Format: AAAA-MM-JJ HH:MM (ex: 2024-01-20 14:30)
                    </small>
                </div>
                
                <div style="display: flex; gap: 10px; margin-top: 30px;">
                    <button type="submit" class="btn btn-success">💾 Enregistrer le cours</button>
                    <a href="courses_list.php" class="btn btn-secondary">Annuler</a>
                </div>
            </form>
        </div>
    </div>
</div>

<?php require_once 'footer.php'; ?>

