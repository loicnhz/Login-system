<!-- $title variable -->
<?php $title = 'Login'; ?>

<!-- $content variable -->
<?php ob_start(); ?>

<form class="form-login text-center" action="index.php?action=signupAddUser" method="post">
    <img src="view/frontend/img/logo.png" alt="Logo" width="280" class="mb-4">
    <?php
    //Displaying an error message
    if(isset($_GET['error']))
    {
    ?>
        <div class="alert alert-danger">
        <?php
        if($_GET['error'] == 'emptyfields')
        {
            echo 'Des champs sont vides';
        }
        else if($_GET['error'] == 'invalidemailuid')
        {
            echo 'Le nom d\'utilisateur et l\'adresse mail sont incorrects';
        }
        else if($_GET['error'] == 'invalidemail')
        {
            echo 'L\'adresse mail est incorrecte';
        }
        else if($_GET['error'] == 'invaliduid')
        {
            echo 'Le nom d\'utilisateur est incorrect';
        }
        else if($_GET['error'] == 'invalidpassword')
        {
            echo 'Le mot de passe est invalide (6 caractères minimum, au moins une miniscule, une majuscule, un chiffre et un caractère spécial)';
        }
        else if($_GET['error'] == 'passwordcheck')
        {
            echo 'Les mots de passe ne sont pas similaires';
        }
        else if($_GET['error'] == 'failed')
        {
            echo 'La création du compte n\'a échouée';
        }
        else if ($_GET['error'] == 'mailUidTaken')
        {
            echo 'Le nom d\'utilisateur/adresse email est déjà pris';
        }
        ?>
        </div>
    <?php
    }
    ?>
    <div class="form-group">
        <input type="text" name="uid" class="form-control" placeholder="Nom d'utilisateur" value="<?php if(isset($_GET['uid'])) { echo $_GET['uid']; } ?>" required autofocus>
    </div>
    <div class="form-group">
        <input type="email" name="email" class="form-control" placeholder="Adresse e-mail" value="<?php if(isset($_GET['email'])) { echo $_GET['email']; } ?>" required>
    </div>
    <div class="form-group">
        <input type="password" name="pwd" class="form-control" placeholder="Mot de passe" required>
    </div>
    <div class="form-group">
        <input type="password" name="pwd-repeat" class="form-control" placeholder="Confirmer le mot de passe" required>
    </div>
    <button class="btn btn-lg btn-primary btn-block" name="signup-submit" type="submit">S'enregistrer</button>
    <p class="mt-3"><a href="index.php">Se connecter</a></p>
</form>

<?php $content = ob_get_clean(); ?>

<!-- Using a template -->
<?php require('template.php'); ?>