<?php
require_once 'config.php';
require_once 'header.php';


if($_SERVER['REQUEST_METHOD']== 'POST'){
    $username = $_POST['username'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM users WHERE username = ? AND password = ?";
    $requete = mysqli_prepare($conn,$sql);
    mysqli_stmt_bind_param($requete,"ss",$username,$password);
    mysqli_stmt_execute($requete);
    $result= mysqli_stmt_get_result($requete);


    if(mysqli_num_rows($result)== 1){
        $_SESSION['username'] = $username;
        $_SESSION['pasword'] = $password;
        header("location:index.php");
    }else{
        echo "user not found";
    }

}


?>
<div class="container">
    <div class="form-container">
        <div class="card">
            <div class="card-header">
                <h2>Login Form</h2>
            </div>
            
            <form method="POST" action="">
                <div class="form-group">
                    <label for="title">Username</label>
                    <input type="text" class="form-control" id="title" name="username" 
                           required maxlength="50" placeholder="Entrez votre Username">
                </div>
                <div class="form-group">
                    <label for="description">Password</label>
                    <input type="password" class="form-control" id="title" name="password" 
                           required maxlength="50" placeholder="Entrer votre Password">
                </div>
                
                <div style="display: flex; gap: 10px; margin-top: 30px;">
                    <button type="submit" class="btn btn-success">Login</button>
                    <a href="courses_list.php" class="btn btn-secondary">Annuler</a>
                </div>
            </form>
        </div>
    </div>
</div>

<?php require_once 'footer.php'; ?>

