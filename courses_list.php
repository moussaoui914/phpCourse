<?php
require_once 'config.php';
$page_title = "Liste des Cours";
require_once 'header.php';
$query = "SELECT * FROM Course ORDER BY created_at DESC";
$result = mysqli_query($conn, $query);
?>

<div class="card">
    <div class="card-header">
        <h2><i class="fas fa-book"></i> 📋 Liste des Cours</h2>
        <a href="courses_create.php" class="btn btn-success">
            <i class="fas fa-plus-circle"></i> ➕ Nouveau Cours
        </a>
    </div>
    
    <div class="table-container">
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Image</th>
                    <th>Titre</th>
                    <th>Niveau</th>
                    <th>Date de création</th>
                    <th>Sections</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php if(mysqli_num_rows($result) > 0): ?>
                    <?php while($course = mysqli_fetch_assoc($result)): ?>
                        <?php
                        // Compter les sections pour ce cours
                        $section_query = "SELECT COUNT(*) as count FROM sections WHERE course_id = " . $course['id'];
                        $section_result = mysqli_query($conn, $section_query);
                        $section_count = mysqli_fetch_assoc($section_result);
                        mysqli_free_result($section_result);
                        ?>
                        <tr>
                            <td><?php echo $course['id'];?></td>
                            <td>
                                <div class="course-image">
                                    <img src=".\ze.png">
                                </div>
                            </td>
                            <td>
                                <strong><?php echo htmlspecialchars($course['title']); ?></strong>
                                <br>
                                <small class="course-description">
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
                                $date = date_create($course['created_at']);
                                echo date_format($date, 'd/m/Y H:i');
                                ?>
                            </td>
                            <td>
                                <span class="section-count">
                                    <i class="fas fa-list"></i> <?php echo $section_count['count']; ?>
                                </span>
                            </td>
                            <td>
                                <div class="actions">
                                    <a href="sections_by_course.php?course_id=<?php echo $course['id']; ?>" 
                                       class="btn btn-sm btn-primary" title="Voir les sections">
                                        <i class="fas fa-eye"></i> Voir
                                    </a>
                                    <a href="courses_edit.php?id=<?php echo $course['id']; ?>" 
                                       class="btn btn-sm btn-warning" title="Modifier">
                                        <i class="fas fa-edit"></i> Modif
                                    </a>
                                    <a href="courses_delete.php?id=<?php echo $course['id']; ?>" 
                                       class="btn btn-sm btn-danger btn-delete" title="Supprimer">
                                        <i class="fas fa-trash"></i> Supp
                                    </a>
                                </div>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="7" class="text-center">
                            <div class="empty-state">
                                <i class="fas fa-book fa-3x"></i>
                                <h3>Aucun cours trouvé</h3>
                                <p>Commencez par créer votre premier cours</p>
                                <a href="courses_create.php" class="btn btn-primary">
                                    <i class="fas fa-plus-circle"></i> Créer un cours
                                </a>
                            </div>
                        </td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<?php 
mysqli_free_result($result);
mysqli_close($conn);
require_once 'footer.php';  
?>