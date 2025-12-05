<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo isset($page_title) ? $page_title : 'Gestion des Cours'; ?></title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <nav class="navbar">
        <div class="nav-container">
            <div class="nav-brand">
                <a href="index.php">📚 Gestion des Cours</a>
            </div>
            <ul class="nav-menu">
                <li><a href="courses_list.php" class="<?php echo basename($_SERVER['PHP_SELF']) == 'courses_list.php' ? 'active' : ''; ?>">📋 Cours</a></li>
                <li><a href="sections_list.php" class="<?php echo basename($_SERVER['PHP_SELF']) == 'sections_list.php' ? 'active' : ''; ?>">📑 Sections</a></li>
                <li><a href="courses_create.php" class="<?php echo basename($_SERVER['PHP_SELF']) == 'courses_create.php' ? 'active' : ''; ?>">➕ Nouveau Cours</a></li>
            </ul>
        </div>
    </nav>
    
    <main class="container">
        <!-- Les messages flash seront affichés ici -->
        <?php if(isset($_SESSION['message'])): ?>
            <div class="alert alert-<?php echo $_SESSION['message_type']; ?>">
                <?php 
                    echo $_SESSION['message'];
                    unset($_SESSION['message']);
                    unset($_SESSION['message_type']);
                ?>
            </div>
        <?php endif; ?>