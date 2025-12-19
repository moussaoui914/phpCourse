<?php
require_once 'config.php';
require_once 'header.php';

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

            
            <div style="margin-top: 40px; padding: 20px; background: var(--light-color); border-radius: 8px;">
                <h4 style="margin-bottom: 15px;">📊 Statistiques rapides</h4>
                <div style='display: flex; justify-content: center; gap: 40px; margin-top: 20px;'>
                    <div style='text-align: center;'>
                        <div style='font-size: 32px; font-weight: bold; color: var(--primary-color);'>
                            <?php echo $courses_count; ?>
                        </div>
                        <div>Cours</div>
                    </div>
                    
                    <div style='text-align: center;'>
                        <div style='font-size: 32px; font-weight: bold; color: #28a745;'>
                            <?php echo $sections_count; ?>
                        </div>
                        <div>Sections</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php require_once 'footer.php'; ?>