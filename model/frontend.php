<?php

//Connection to the database
function dbConnect()
{
    $db = new PDO('mysql:host=localhost;dbname=loginsystem;charset=utf8', 'root', '');
    return $db;
}

//Add a new user to the database
function addUser($username, $email, $password)
{
    $db = dbConnect();
    $req = $db->prepare('INSERT INTO users (uidUsers, emailUsers, pwdUsers) VALUES (?, ?, ?)');
    $result = $req->execute(array($username, $email, $password));
    return $result;
}

//Check if the username or email address are already taken in the database
function searchUidMail($username, $email)
{
    $db = dbConnect();
    $req = $db->prepare('SELECT * FROM users WHERE uidUsers = ? OR emailUsers = ?');
    $req->execute(array($username, $email));

    return $req;
}

//Retrieving informations from an user
function user($email)
{
    $db = dbConnect();
    $req = $db->prepare('SELECT * FROM users WHERE emailUsers = ?');
    $req->execute(array($email));

    return $req->fetch();
}