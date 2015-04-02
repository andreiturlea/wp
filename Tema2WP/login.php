<?php
/**
 * Created by IntelliJ IDEA.
 * User: andrei
 * Date: 01.04.2015
 * Time: 21:35
 */

require_once 'idiorm.php';
ORM::configure('sqlite:./db.sqlite');
ORM::configure('id_column_overrides', array(
    'pw_user' => 'usr_id'
));
date_default_timezone_set("Europe/Athens");

if (isset($_POST["username"]))
{
    $username = $_POST["username"];
    if (strlen($username) >= 6)
    {
        if (isset($_POST["password"]))
        {
            $password = $_POST["password"];
            if (strlen($password) >= 6)
            {
                $count = ORM::for_table('pw_user')->where('usr_username', $username)->count();
                if($count > 0)
                {
                    $result = ORM::for_table('pw_user')->where('usr_username', $username)->find_one();
                    $storedPassword = $result->usr_password;
                    $encryptedPassword = sha1($password.$result->usr_salt);
                    if($storedPassword == $encryptedPassword)
                    {

                        try {
                            $datetime = date('Y-m-d H:i:s');
                            $result->set('usr_last_login', $datetime);
                            $result->save();
                        } catch (Exception $exc)
                        {
                            echo $exc->getMessage();
                        }
                        echo "ok" . "<br>";
                        echo $datetime;

                    } else
                    {
                        echo "wrong_password";
                    }
                } else
                {
                    echo "user_doesnt_exist";
                }

            } else
            {
                echo "password //less than 6";
            }

        } else
        {
            echo "password //not set";
        }



    } else
    {
        echo "username //less than 6";
    }

} else
{
    echo "username //not set";
}