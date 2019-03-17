<!-- $title variable -->
<?php $title = 'Login'; ?>

<!-- $content variable -->
<?php ob_start(); ?>


<?php
if(isset($_SESSION['loggedIn']) AND $_SESSION['loggedIn'] === true)
{
?>
    <?php
    //Displaying a success message
    if(isset($_GET['login']))
    {
    ?>
        <div class="alert alert-success">
        <?php
        if($_GET['login'] == 'success')
        {
            echo 'Vous venez de vous connecter';
        }
        ?>
        </div>
    <?php
    }
    ?>
    <form action="index.php?action=logout" method="post">
        <div class="form-group">
            <button class="btn btn-primary btn-block" name="logout-submit" type="submit">Se déconnecter</button>
        </div>
    </form>

<?php
}
else
{
?>

    <form class="form-login text-center" action="index.php?action=login" method="post">
        <img src="view/frontend/img/logo.png" alt="Logo" width="280" class="mb-4">
        <?php
        //Displaying an error message
        if(isset($_GET['error']))
        {
        ?>
            <div class="alert alert-danger">
            <?php
            if($_GET['error'] == 'nouser')
            {
                echo 'Mauvais identifiant ou mot de passe';
            }
            else if($_GET['error'] == 'wrongpwd')
            {
                echo 'Mauvais identifiant ou mot de passe';
            }
            else if($_GET['error'] == 'emptyfields')
            {
                echo 'Les champs sont vides';
            }
            ?>
            </div>
        <?php
        }
        ?>
        <?php
        //Displaying a success message
        if(isset($_GET['signup']))
        {
        ?>
            <div class="alert alert-success">
            <?php
            if($_GET['signup'] == 'success')
            {
                echo 'Compte créé avec succès';
            }
            ?>
            </div>
        <?php
        }
        ?>
        <div class="form-group">
            <input type="email" id="inputEmail" name="email" class="form-control" placeholder="Adresse e-mail" required autofocus>
        </div>
        <div class="form-group">
            <input type="password" id="inputPassword" name="pwd" class="form-control" placeholder="Mot de passe" required>
        </div>
        <button class="btn btn-lg btn-primary btn-block" name="login-submit" type="submit">Se connecter</button>
        <p class="mt-3"><a href="index.php?action=signup">S'enregistrer</a></p>
    </form>

<?php
}
?>


<?php $content = ob_get_clean(); ?>

<!-- Using a template -->
<?php require('template.php'); ?>