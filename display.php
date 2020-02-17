<?php
namespace bbs\Display;

require_once(__DIR__ . '/config.php');

use bbs\Config\Config;

class Display
{
    public function list_page()
    {
    $config = new Config();
    echo '<html>
                <head>
                  <meta charset="utf-8">
                  <title>一覧</title>
                </head>
                <body>';
    $list = glob($config -> get_file_directory() . '*.txt');
    $new_list = [];
    if (array_key_exists('search_title', $_POST) && $_POST['search_title'] != '') {
        foreach ($list as $value){
            //$valueにserch_titleがあるかどうか比較
            if (strpos($value , $_POST['search_title']) !== false){
                //$new_listに検索条件と一致した項目を入れる
                $new_list[] = $value;
            }
        }
    }else{
        $new_list = $list;
    }
    $list = $new_list;
    echo '<p>日時検索</p>';
    echo '<form action="index.php?action=list" method="post">';
    if (array_key_exists('search_title', $_POST)) {
        echo '<input type="text" value="' . $_POST['search_title'] . '" name="search_title">';
    }else{
        echo '<input type="text" name="search_title">'; 
    }
    echo '<input type="submit" value="検索"></input>
            </form></br>';

    echo '<form action="index.php?action=delete" method="post">';
    echo '<input type="submit" value="削除"></input><br>';
    if (array_key_exists('page', $_GET)) {
        $page = $_GET['page'];
    } else {
        $page = 1;
    }
    $limit = 10;
    $count = count($list);
    $maxpage = $count / $limit;
    $maxpage = floor($maxpage);
    if (($count % $limit) != 0) {
        $maxpage += 1;
    }
    $start = $limit * ($page - 1);
    if ($page > $maxpage) {
        echo '<p>データがありません。</p>';
    } else {
        //foreach($list as $list_num => $name) {
        for ($index = 0; $index < $limit; $index++) {
            if (($start + $index) + 1 <= $count) {
                echo '<a href=' . $config->get_url('contents') . '&task=' . $list[$start + $index] . '>' . basename($list[$start + $index], ".txt") . '</a>';
                //echo '<input type="text" name="delete_content">';
                echo '<input type="checkbox"  name="delete_content[]" value="' . basename($list[$start + $index], ".txt") . '"><br>';
            } else {
                break;
            }
        }
        echo '</form>';
    }

    if ($page > 1) {
        $config->echo_pipe_line('<a href=' . $config -> get_url('list') . '&page=' . ($page - 1) . '>前のページ</a>');
    }
    for ($button = 0; $button < $maxpage; $button++) {
        $page_num = $button + 1;
        $config->echo_pipe_line('<a href=' . $config -> get_url('list') . '&page=' . $page_num . '>' . $page_num . 'ページ</a>');
    }
    if ($page < $maxpage) {
        echo '<a href=' . $config -> get_url('list') . '&page=' . ($page + 1) . '>次のページ</a>';
    }

    echo '<br><a href =' . $config -> get_url('input') . '>投稿する<a/></br>
          <a href = "' . $config -> get_url('logout') . '">ログアウト<a/>
                </body>
            </html>';
}

    public function contents_page()
    {
    $config = new Config();
    echo '<html>
        <body>';
    if (array_key_exists('task', $_GET)) {
        //echo htmlspecialchars(file_get_contents($_GET['task']));
        $box = explode( '|', file_get_contents($_GET['task']));
        echo '<p>ニックネーム：' . $box[0] . '</p>';
        echo '<hr width="200" size="1" color="#ff0000" align="left">';
        echo '<p>タイトル：' . $box[1] . '</p>';
        echo '<hr width="200" size="1" color="#ff0000" align="left">';
        echo '<p>コメント：' . $box[2] . '</p>';
        echo'</br>';
        echo $config -> list_link();
    } else {
        echo '<p>データがありません。</p>';
        echo $config -> list_link();
    }
        echo '</body>
            </html>';
    }
}

