<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion des Cours</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

    <nav class="navbar">
        <div class="nav-container">
            <div class="nav-brand">
                <a href="index.php">📚 Gestion des Cours</a>
            </div>
            <ul class="nav-menu">
                <li><a href="courses_list.php">📋 Cours</a></li>
                <li><a href="sections_list.php">📑 Sections</a></li>
                <li><a href="register.php">Register</a></li>
                <?php
                    if(isset($_SESSION['username'])){ ?>
                        <li><a href="logout.php">Logout</a></li>
                        <li><a href="my_courses.php">My Courses</a></li>
                    <?php } ?>
            </ul>
        </div>
    </nav>