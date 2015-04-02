<?php
/**
 * Created by IntelliJ IDEA.
 * User: andrei
 * Date: 02/04/15
 * Time: 16:10
 */

require_once 'idiorm.php';
ORM::configure('sqlite:./db.sqlite');
ORM::configure('id_column_overrides', array(
    'pw_user' => 'usr_id',
    'pw_article' => 'art_id',
    'pw_category' => 'cat_id'

));
date_default_timezone_set("Europe/Athens");

if (isset($_POST["id"]))
{
    $id = $_POST["id"];
    if (isset($_POST["title"]))
    {
        $title = $_POST["title"];
        if($title !== "")
        {
            if (isset($_POST["content"]))
            {
                $content = $_POST["content"];
                if($content !== "")
                {
                    if (isset($_POST["author"]))
                    {
                        $author = $_POST["author"];
                        if($author !== "")
                        {
                            $count = ORM::for_table('pw_article')->where('art_author', $author)->count();
                            if($count > 0){

                                //TODO: cat_id (categorii articole; array);

                            } else
                            {
                                echo "author";
                            }
                        } else
                        {
                            echo "author";
                        }

                    } else
                    {
                        echo "author";
                    }

                } else
                {
                    echo "content";
                }
            } else
            {
                echo "content";
            }
        } else
        {
            echo "title";
        }

    } else
    {
        echo "title";
    }
} else
{
    echo "article id not set";
}