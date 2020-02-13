<?php
//require_once('../login.php');
//require_once('../input.php');
//require_once('../display.php');
//require_once('../delete.php');

//$loginout = new Loginout();
//$input = new Input();
//$dispaly = new Display();
//$delete = new Delete();


class Config
{
    public function get_url($action)
    {
        return 'http://localhost:8080/index.php?action=' . $action;
    }

    public function get_file_directory()
    {
        return '/Users/miyakoshihayato/Desktop/workspace2/bbs/text/';
    }

    public function get_file_directory_login()
    {
        return '/Users/miyakoshihayato/Desktop/workspace2/bbs/login/';
    }

    public function list_link()
    {
    return '<a href = "' . $this->get_url('list') . '">投稿確認はこちら<a/>';
    }

    public function echo_pipe_line($text)
    {
        echo $text . '|';
    }
}

