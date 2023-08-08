<?php include('includes/header.php'); ?>
<?php
include('functions/conn.php');
session_start();
$data = new Database;
$message = '';
if (isset($_POST['register'])) {
    $field = array(
        'email' => $_POST['email'],
        'username' => $_POST['username'],
        'password' => $_POST['password'],
        'repassword' => $_POST['repassword']

    );
    if ($data->required_validation($field)) {
        if ($data->register($field)) {
            header("Location: login_form.php");
        } else {
            $message = $data->error;
        }
    } else {
        $message = $data->error;
    }
}
?>

<div class="container" style="width:500px; margin-top:150px;">
    <h3>Formularz rejestracji</h3><br />
    <?php
    if (isset($message)) {
        echo "<label class='text-danger'>$message</label>";
    }
    ?>

    <form method="post">
        <label>Adres e-mail</label>
        <input type="text" name="email" class="form-control" />
        <br />
        <label>Nazwa użytkownika</label>
        <input type="text" name="username" class="form-control" />
        <br />
        <label>Hasło</label>
        <input type="password" name="password" class="form-control" />
        <br />
        <label>Powtórz Hasło</label>
        <input type="password" name="repassword" class="form-control" />
        <br />
        <input type="submit" name="register" class="btn btn-info" value="Zarejestruj" />
    </form>

</div>