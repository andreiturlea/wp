<?php
/**
 * Created by IntelliJ IDEA.
 * User: andrei
 * Date: 02/04/15
 * Time: 16:43
 */
require_once 'idiorm.php';
ORM::configure('sqlite:./db.sqlite');
ORM::configure('id_column_overrides', array(
    'pw_user' => 'usr_id',
    'pw_article' => 'art_id',
    'pw_category' => 'cat_id'

));

function add_category($title)
{
    echo "11111: ".$title;
    if($title !== null && $title !== "")
    {
        echo "aici;";
        $cat = ORM::for_table('pw_category')->create();
        $cat->cat_title = $title;
        $cat->save();
        return $cat;
    } else echo "enter a category name";

}

$categories = array(
    add_category("drama"),
    add_category("scifi"),
    add_category("commedy"),
    add_category("18+")

);
