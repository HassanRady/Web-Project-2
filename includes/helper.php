<?php

// function to make a link button
function aElement($class, $name, $value, $href, $text)
{
    $a = " <a class='$class' name='$name' value='$value' href='$href'>$text</a>";
    echo $a;
}

// function to crypt a password
function encrypt_password($password, $cost = 10)
{
    $options = ['cost' => $cost,];
    $password_encrypted = password_hash($password, PASSWORD_BCRYPT, $options);
    return $password_encrypted;
}