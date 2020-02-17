<?php
namespace bbs\Delete;

//require_once('../loginout.php');
//require_once('../input.php');
//require_once('../display.php');
require_once(__DIR__ . '/config.php');

//$loginout = new Loginout();
//$input = new Input();
//$dispaly = new Display();

class Delete
{
    function delete_page()
    {
        $config = new \bbs\Config\Config();
        echo '<html>
            <body>';
        if (array_key_exists('delete_content', $_POST)) {
            //print_r($_POST['delete_content']);
            if ($_POST['delete_content'] == '') {
                echo '<p>ファイルの指定がありません。</p>';
                echo '<a href = "' . $config->get_url('list') . '">投稿確認はこちら<a/>';
                exit();
            }
            foreach ($_POST['delete_content'] as $value) {
                unlink($config->get_file_directory() . $value . '.txt');
            }
            //unlink(get_file_directory() . $_POST['delete_content'] . '.txt');
            echo '<p>タスクを削除しました。</P>
                  <a href = "' . $config->get_url('list') . '">投稿確認はこちら<a/>';
        } else {
            echo '<p>削除したいファイルを指定してください。</p>';
            echo '<a href = "' . $config->get_url('list') . '">投稿確認はこちら<a/>';
            exit();
        }
    }
}
