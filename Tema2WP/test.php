<?php
/**
 * Created by IntelliJ IDEA.
 * User: andrei
 * Date: 02/04/15
 * Time: 12:20
 */

require_once 'idiorm.php';
ORM::configure('sqlite:./db.sqlite');

try {
    $result = ORM::for_table('pw_user')->find_many();
    print_r($result);
    foreach($result as $res) {
        echo $res->usr_password . "\n";
    }
    print_r (json_encode($result));
} catch (Exception $ex) {
    echo $ex->getMessage();
}
