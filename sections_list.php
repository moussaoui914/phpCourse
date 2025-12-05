<?php
require_once 'config.php';
$page_title = "Liste des sections";
require_once 'header.php';
$var ="SELECT * FROM sections";
$result = mysqli_query($conn, $var);
?>

<div class="container">
    <div class="card">
        <div class="card-header">
            <h2>📋 Liste des Sections</h2>
            <a href="courses_create.php" class="btn btn-success">➕ Nouvelle Section</a>
        </div>
        
        <div class="table-container">
            <table class="table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Titre</th>
                        <th>Contenue</th>
                        <th>Position</th>
                        <th>Date de création</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if(mysqli_num_rows($result) > 0): ?>
                        <?php while($section = mysqli_fetch_assoc($result)): ?>
                            <tr>
                                <td><?php echo $section['id'];?></td>
                                <td>
                                    <strong><?php echo htmlspecialchars($section['title']); ?></strong>
                                    <br>
                                    <small style="color: #666;">
                                        <?php echo substr(htmlspecialchars($section['content']), 0, 100); ?>...
                                    </small>
                                </td>
                                <td>
                                    <span class="badge">
                                        <?php echo $section['position']; ?>
                                    </span>
                                </td>
                                <td>
                                    <?php 
                                    $date = new DateTime($section['created_at']);
                                    echo $date->format('d/m/Y H:i');
                                    ?>
                                </td>
                                <td>
                                    <div class="actions">
                                        <a href="courses_edit.php?id=<?php echo $section['id']; ?>" 
                                           class="btn btn-sm btn-warning" title="Modifier">
                                            ✏️
                                        </a>
                                        <a href="courses_delete.php?id=<?php echo $section['id']; ?>" 
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
                                    Aucune section trouvé. 
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