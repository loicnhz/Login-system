<?php

require('model/frontend.php');

//Displaying the index view
function index()
{
    require('view/frontend/indexView.php');
}

//Displaying the signup view
function signup()
{
    require('view/frontend/signupView.php');
}

//Add a new user
function signupAddUser($username, $email, $password)
{
    //Try to find if the username or email address are already taken
    $uidMail = searchUidMail($username, $email);
    
    //If an entry is found
    if($isPresent = $uidMail->fetch())
    {
        header('Location: index.php?action=signup&error=mailUidTaken');
        exit();
    }
    else
    {
        $result = addUser($username, $email, password_hash($password, PASSWORD_DEFAULT));
        if($result)
        {
            header('Location: index.php?signup=success');
        }
        else
        {
            header('Location: index.php?action=signup&error=failed');
        }
    }
}

//Login to an account
function loginUser($email, $password)
{
    $userInfo = user($email);
    
    if($userInfo)
    {
        if($pwdCheck = password_verify($password, $userInfo['pwdUsers']))
        {
            //Creating session variables
            $_SESSION['loggedIn'] = true;
            $_SESSION['userId'] = $userInfo['idUsers'];
            $_SESSION['userUid'] = $userInfo['uidUsers'];
            header('Location: index.php?login=success');
            exit();
        }
        else
        {
            header('Location: index.php?error=wrongpwd');
            exit();
        }
    }
    else
    {
        header('Location: index.php?error=nouser');
    }
}

//Logout from an account
function logoutUser()
{
    session_unset();
    session_destroy();
    header('Location: index.php');
}