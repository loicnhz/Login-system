<?php
session_start();

require('controller/frontend.php');

try 
{
    if(isset($_GET['action']))
    {
        //Signup action
        if($_GET['action'] == 'signup')
        {
            signup();
        }
        //Signup of an user
        else if($_GET['action'] == 'signupAddUser')
        {
            if(isset($_POST['signup-submit']) AND isset($_POST['uid']) AND isset($_POST['email']) AND isset($_POST['pwd']) AND isset($_POST['pwd-repeat']))
            {
                //Check if there are empty fields
                if (empty($_POST['uid']) OR empty($_POST['email']) OR empty($_POST['pwd']) OR empty($_POST['pwd-repeat'])) 
                {
                    header('Location: index.php?action=signup&error=emptyfields&uid=' . $_POST['uid'] . '&email=' . $_POST['email']);
                    exit();
                }
                //Check if the email address and username are correct
                else if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL) AND !preg_match('#^[a-zA-Z0-9]*$#', $_POST['uid']))
                {
                    header('Location: index.php?action=signup&error=invalidemailuid');
                    exit();
                }
                //Check if the email address is correct
                else if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL))
                {
                    header('Location: index.php?action=signup&error=invalidemail&uid=' . $_POST['uid']);
                    exit();
                }
                //Check if the username is correct
                else if (!preg_match('#^[a-zA-Z0-9]*$#', $_POST['uid']))
                {
                    header('Location: index.php?action=signup&error=invaliduid&email=' . $_POST['email']);
                    exit();
                }
                //Check if the password is correct
                else if (!preg_match('#^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*\W).{6,}$#', $_POST['pwd']))
                {
                    header('Location: index.php?action=signup&error=invalidpassword&uid=' . $_POST['uid'] . '&email=' . $_POST['email']);
                    exit();
                }
                //Check that both passwords are the same
                else if ($_POST['pwd'] !== $_POST['pwd-repeat'])
                {
                    header('Location: index.php?action=signup&error=passwordcheck&uid=' . $_POST['uid'] . '&email=' . $_POST['email']);
                    exit();
                }
                else
                {
                    signupAddUser($_POST['uid'], $_POST['email'], $_POST['pwd']);
                }
            }
            else
            {
                header('Location: index.php?action=signup');
                exit();
            }
        }
        //Login action
        else if($_GET['action'] == 'login')
        {
            if(isset($_POST['login-submit']) AND isset($_POST['email']) AND isset($_POST['pwd']))
            {
                if(empty($_POST['email']) OR empty($_POST['pwd']))
                {
                    header('Location: index.php?error=emptyfields');
                    exit();
                }
                else
                {
                    loginUser($_POST['email'], $_POST['pwd']);
                }
            }
            else
            {
                header('Location: index.php');
                exit();
            }
        }
        //Logout action
        else if($_GET['action'] == 'logout')
        {
            logoutUser();
        }
    }
    else
    {
        index();
    }
}
catch(Exception $e)
{
    echo 'Erreur : ' . $e->getMessage();
}