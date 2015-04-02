<?php
/**
 * Created by IntelliJ IDEA.
 * User: andrei
 * Date: 01/04/15
 * Time: 15:37
 */

require_once 'idiorm.php';
ORM::configure('sqlite:./db.sqlite');
date_default_timezone_set("Europe/Athens");

function generateRandomString($length = 32) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, strlen($characters) - 1)];
    }
    return $randomString;
}

function checkPassword($pwd, &$errors) {
    $errors_init = $errors;

    if (strlen($pwd) < 6) {
        $errors[] = "Password too short!";
    }

    if (!preg_match("#[0-9]+#", $pwd)) {
        $errors[] = "Password must include at least one number!";
    }

    if (!preg_match("#[a-zA-Z]+#", $pwd)) {
        $errors[] = "Password must include at least one letter!";
    }

    return ($errors == $errors_init);
}



function add_user()
{

    if (isset($_POST["username"])) {
        $username = $_POST["username"];


        if (strlen($username) >= 6) {
            $username2 = ORM::for_table('pw_user')->where('usr_username', $username)->count();
            if ($username2 !== 1) {

                if (isset($_POST["password"])) {

                    $password = $_POST["password"];
                    if (strlen($password) >= 6) {
                        $errors = [];
                        if(checkPassword($password, $errors)) {

                            if (isset($_POST["confirm"])) {
                                $confirm = $_POST["confirm"];

                                if ($password == $confirm) {
                                    $salt = generateRandomString();
                                    $user = ORM::for_table('pw_user')->create();
                                    $user->usr_username = $username;
                                    $user->usr_salt = $salt;
                                    $user->usr_password = sha1($password . $salt);
                                    $user->usr_register_date = date('Y-m-d H:i:s');
                                    $user->save();
                                    echo "ok";
                                    return $user;


                                } else {
                                    echo "confirm";
                                }
                            } else {
                                echo "setconfirm";
                            }
                        } else {
                            echo "password_strength";
                        }
                    } else {
                        echo "password //less than 6";
                    }
                } else {
                    echo "password //is not set";
                }
            } else {
                echo "user_exists";
            }
        } else {
            echo "username //less than 6";
        }


    } else {
        echo "username //is not set";
    }


}

$user = add_user();


//echo "<br>";
//echo('users: ' . ORM::for_table('pw_user')->count() . '<br>');

?>