<?php
namespace bbs\Input;

require_once(__DIR__ . '/config.php');

use bbs\Config\Config;

class Input
{
    public function input_page()
    {
        $config = new Config();
        echo '<html>
                    <head>
                      <meta charset="utf-8">
                      <title>掲示板入力</title>
                    </head>

                    <body>
                        <div>
                          <h2>掲示板</h>
                        </div>

                        <div class="form-group">
                          <form action="index.php?action=save" method="post">

                        
                          <div class="form-group">
                          <label>ニックネーム</label>
                          <input type="textarea" name="name">
                          </div>
                        
                          <div class="form-group">
                          <label>タイトル</label>
                          <input type="textarea" name="title">
                          </div>

                          <div class="form-group">
                          <label>コメント</label>
                          <input type="textarea" name="comment">
                          </div>

                          <input type="submit" value="保存"></input>
                          </form>
                        </div>
                        <div>';
                        echo $config->list_link();
                echo '</div>
                    </body>
                  </html>';
    }

    public function save_page()
    {
        $config = new Config();
        //for ($post_count = 0; $post_count < 10; $post_count++) {
            if (array_key_exists('name', $_POST) && array_key_exists('title', $_POST) && array_key_exists('comment', $_POST)) {
                if ($_POST['name'] == '' && $_POST['title'] == '' && $_POST['comment'] == '') {
                    echo '<p>タスク名か内容の指定がありません。</p>';
                    echo '<a href = "' . $config->get_url('input') . '">投稿画面に戻る<a/>';
                    exit();
                }
                file_put_contents($config->get_file_directory() . date("YmdHis") . ".txt", $_POST['name'] . '|' . $_POST['title'] . '|' . $_POST['comment']);
    
            } else {
                echo '<p>データがありません。</p>';
                echo '<a href = "' . $config->get_url('input') . '">投稿画面に戻る<a/>';
                exit();
            }
        //}
    
        echo '<html>
                  <head>
                    <meta charset="utf-8">
                    <title>投稿</title>
                  </head>
                  <body>
                    <div>
                    <p>投稿しました</p>';
                   echo $config->list_link();
                echo '</div>
                    <div>';
        echo '</div>
                    <a href ="' . $config->get_url('input') . '">投稿する<a/></br>
                  </body>
                </html>';
    }

}

