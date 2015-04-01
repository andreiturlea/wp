<?php
/**
 * Created by IntelliJ IDEA.
 * User: andrei
 * Date: 01/04/15
 * Time: 12:51
 */

require_once 'idiorm.php';
ORM::configure('sqlite:./db.sqlite');

ORM::get_db()->exec('DROP TABLE IF EXISTS pw_user;');
try {
    ORM::get_db()->exec(
        'CREATE TABLE pw_user (' .
        'usr_id INTEGER PRIMARY KEY AUTOINCREMENT, ' .
        'usr_username VARCHAR(256), ' .
        'usr_password CHAR(40),' .
        'usr_salt CHAR(32),' .
        'usr_register_date TIMESTAMP,' .
        'usr_last_login TIMESTAMP)'
    );
}catch (Exception $ex){
    echo $ex;
}

ORM::get_db()->exec('DROP TABLE IF EXISTS pw_article;');
try {
    ORM::get_db()->exec(
        'CREATE TABLE pw_article (' .
        'art_id INTEGER PRIMARY KEY AUTOINCREMENT, ' .
        'art_title TEXT, ' .
        'art_content TEXT,' .
        'art_views  INT,' .
        'art_publish_date TIMESTAMP,' .
        'art_update_date TIMESTAMP,' .
        'art_author INTEGER, ' .
        'FOREIGN KEY(art_author) REFERENCES pw_user(usr_id))'
    );
}catch (Exception $ex){
    echo $ex;
}

ORM::get_db()->exec('DROP TABLE IF EXISTS pw_article;');
try {
    ORM::get_db()->exec(
        'CREATE TABLE pw_article (' .
        'art_id INTEGER PRIMARY KEY AUTOINCREMENT, ' .
        'art_title TEXT, ' .
        'art_content TEXT,' .
        'art_views  INTEGER,' .
        'art_publish_date TIMESTAMP,' .
        'art_update_date TIMESTAMP,' .
        'art_author INTEGER, ' .
        'FOREIGN KEY(art_author) REFERENCES pw_user(usr_id))'
    );
}catch (Exception $ex){
    echo $ex;
}

ORM::get_db()->exec('DROP TABLE IF EXISTS pw_category;');
try {
    ORM::get_db()->exec(
        'CREATE TABLE pw_category (' .
        'cat_id INTEGER PRIMARY KEY AUTOINCREMENT, ' .
        'cat_title VARCHAR(254)) '
    );
}catch (Exception $ex){
    echo $ex;
}

ORM::get_db()->exec('DROP TABLE IF EXISTS pw_article_category;');
try {
    ORM::get_db()->exec(
        'CREATE TABLE pw_article_category (' .
        'artc_art_id INTEGER, ' .
        'artc_cat_id INTEGER, ' .
        'FOREIGN KEY(artc_art_id) REFERENCES pw_article(art_id)' .
        'FOREIGN KEY(artc_cat_id) REFERENCES pw_category(cat_id))'
    );
}catch (Exception $ex){
    echo $ex;
}
