<?php
require_once 'config.php';
$page_title = "Détails du Cours";
require_once 'header.php';

if (!isset($_GET['course_id'])) {
    echo '<div class="alert alert-danger">ID du cours invalide</div>';
    require_once 'footer.php';
    exit();
}

$course_id = $_GET['course_id']; 

$query_course = "SELECT * FROM course WHERE id = ?";
$stmt_course = mysqli_prepare($conn, $query_course);
mysqli_stmt_bind_param($stmt_course, "i", $course_id);
mysqli_stmt_execute($stmt_course);
$result_course = mysqli_stmt_get_result($stmt_course);

if (mysqli_num_rows($result_course) == 0) {
    echo '<div class="alert alert-danger">Cours non trouvé</div>';
    require_once 'footer.php';
    exit();
}

$course = mysqli_fetch_assoc($result_course);
mysqli_stmt_close($stmt_course);

$query_sections = "SELECT * FROM sections WHERE course_id = ? ORDER BY position";
$stmt_sections = mysqli_prepare($conn, $query_sections);
mysqli_stmt_bind_param($stmt_sections, "i", $course_id); 
mysqli_stmt_execute($stmt_sections);
$result_sections = mysqli_stmt_get_result($stmt_sections);
?>

<div class="card mb-4">
    <div class="card-header bg-primary text-white">
        <div class="d-flex justify-content-between align-items-center">
            <h2 class="mb-0">
                <i class="fas fa-book-open"></i> <?php echo htmlspecialchars($course['title']); ?>
            </h2>
            <a href="section_create.php?course_id=<?php echo $course_id; ?>" 
               class="btn btn-light">
                <i class="fas fa-plus"></i> Ajouter Section
            </a>
        </div>
    </div>
    <div class="card-body">
        <p><strong>Description :</strong></p>
        <p><?php echo nl2br(htmlspecialchars($course['description'])); ?></p>
        
        <div class="row mt-3">
            <div class="col-md-6">
                <p><strong>Statut :</strong> 
                    <span class="badge bg-info">
                        <?php echo $course['level']; ?>
                    </span>
                </p>
            </div>
            <div class="col-md-6">
                <p><strong>Date de création :</strong> 
                    <?php echo date('d/m/Y à H:i', strtotime($course['created_at'])); ?>
                </p>
            </div>
        </div>
    </div>
    <div class="card-footer">
        <a href="courses_list.php" class="btn btn-secondary">
            <i class="fas fa-arrow-left"></i> Retour aux cours
        </a>
        <a href="course_edit.php?id=<?php echo $course_id; ?>" class="btn btn-warning">
            <i class="fas fa-edit"></i> Modifier
        </a>
    </div>
</div>

<div class="card">
    <div class="card-header">
        <h3><i class="fas fa-list"></i> Sections de ce cours</h3>
    </div>
    <div class="card-body">
        <?php if(mysqli_num_rows($result_sections) > 0): ?>
            <div class="list-group">
                <?php while($section = mysqli_fetch_assoc($result_sections)): ?>
                    <div class="list-group-item">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h5>
                                    <?php echo htmlspecialchars($section['title']); ?>
                                    <small class="text-muted">(Position: <?php echo $section['position']; ?>)</small>
                                </h5>
                                <p class="mb-1">
                                    <?php echo substr(htmlspecialchars($section['content']), 0, 100); ?>...
                                </p>
                                <small>
                                    <i class="fas fa-calendar"></i> 
                                    <?php echo date('d/m/Y', strtotime($section['created_at'])); ?>
                                </small>
                            </div>
                        </div>
                    </div>
                <?php endwhile; ?>
            </div>
        <?php else: ?>
            <div class="alert alert-info text-center">
                <i class="fas fa-info-circle fa-2x mb-2"></i>
                <h4>Aucune section trouvée</h4>
                <p>Ajoutez des sections à ce cours</p>
                <a href="section_create.php?course_id=<?php echo $course_id; ?>" 
                   class="btn btn-primary">
                    <i class="fas fa-plus"></i> Ajouter une section
                </a>
            </div>
        <?php endif; ?>
    </div>
</div>

<?php
mysqli_free_result($result_course);
mysqli_free_result($result_sections);
mysqli_stmt_close($stmt_sections);
require_once 'footer.php';
?>