<?php
require_once 'config.php';
$page_title = "Liste des Cours";
require_once 'header.php';
$var ="SELECT * FROM course";
$result = mysqli_query($conn, $var);
?>

<div class="container">
    <div class="card">
        <div class="card-header">
            <h2>📋 Liste des Cours</h2>
            <a href="courses_create.php" class="btn btn-success">➕ Nouveau Cours</a>
        </div>
        
        <div class="table-container">
            <table class="table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Titre</th>
                        <th>Niveau</th>
                        <th>Date de création</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if(mysqli_num_rows($result) > 0): ?>
                        <?php while($course = mysqli_fetch_assoc($result)): ?>
                            <tr>
                                <td><?php echo $course['id'];?></td>
                                <td>
                                    <strong><?php echo htmlspecialchars($course['title']); ?></strong>
                                    <br>
                                    <small style="color: #666;">
                                        <?php echo substr(htmlspecialchars($course['description']), 0, 100); ?>...
                                    </small>
                                </td>
                                <td>
                                    <?php 
                                    $badge_class = '';
                                    switch($course['level']) {
                                        case 'Delivered': $badge_class = 'badge-success'; break;
                                        case 'Under Process': $badge_class = 'badge-warning'; break;
                                        case 'Cancelled': $badge_class = 'badge-danger'; break;
                                    }
                                    ?>
                                    <span class="badge <?php echo $badge_class; ?>">
                                        <?php echo $course['level']; ?>
                                    </span>
                                </td>
                                <td>
                                    <?php 
                                    $date = new DateTime($course['created_at']);
                                    echo $date->format('d/m/Y H:i');
                                    ?>
                                </td>
                                <td>
                                    <div class="actions">
                                        <a href="sections_by_course.php?course_id=<?php echo $course['id']; ?>" 
                                           class="btn btn-sm btn-primary" title="Voir les sections">
                                            📑 Sections
                                        </a>
                                        <a href="courses_edit.php?id=<?php echo $course['id']; ?>" 
                                           class="btn btn-sm btn-warning" title="Modifier">
                                            ✏️
                                        </a>
                                        <a href="courses_delete.php?id=<?php echo $course['id']; ?>" 
                                           class="btn btn-sm btn-danger btn-delete" title="Supprimer">
                                            🗑️
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        <?php endwhile; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="5" style="text-align: center; padding: 40px;">
                                <p style="color: #666; font-size: 18px;">
                                    Aucun cours trouvé. 
                                    <a href="courses_create.php">Créez votre premier cours</a>
                                </p>
                            </td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php 
mysqli_free_result($result);
require_once 'footer.php';  
?>