<?php
/**
 * Created by IntelliJ IDEA.
 * User: andrei
 * Date: 01/04/15
 * Time: 15:37
 */

require_once 'idiorm.php';
ORM::configure('sqlite:./db.sqlite');

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
                        if (isset($_POST["confirm"])) {
                            $confirm = $_POST["confirm"];

                            if ($password == $confirm) {
                                $user = ORM::for_table('pw_user')->create();
                                $user->usr_username = $username;
                                $user->usr_password = $password;
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


echo "<br>";
echo('users: ' . ORM::for_table('pw_user')->count() . '<br>');

?>