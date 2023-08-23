<?php include('includes/header.php'); ?>
<?php
include('functions/conn.php');
session_start();
$data = new Database;
$message = '';
if (isset($_POST['login'])) {

    $field = array(
        'username' => $_POST['username'],
        'password' => $_POST['password']
    );
    if ($data->required_validation($field)) {
        if ($data->can_login("users_table", $field)) {
            $_SESSION['username'] = $_POST["username"];
            header("location: index.php");
        } else {
            $message = $data->error;
        }
    } else {
        $message = $data->error;
    }
}

?>

<div class="container" style="width:500px; margin-top:150px;">
    <h3>Formularz logowania</h3><br/>

    <?php
    if (isset($message)) {
        echo "<label class='text-danger'>$message</label>";
    }
    ?>
    <form method="post">
        <label>Login</label>
        <input type="text" name="username" class="form-control" />
        <br />
        <label>Hasło</label>
        <input type="password" name="password" class="form-control" />
        <br />
        <input type="submit" name="login" class="btn btn-info" value="Login" />
    </form>
    <a href="register.php" class="text-right" style="color:grey"> Nie masz konta? Zarejestruj się!</a>
</div>