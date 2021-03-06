<?php

namespace application\models;

use application\core\Model;

class Admin extends Model{

    public $error;
    
    public function loginValidate($post){
        $config = require 'application/config/admin.php';
        if($config['login'] != $post['login'] or $config['password'] != $post['password']){
            $this->error = 'неправильные данные';
            return false;
        }
        return true;
    }

    public function postValidate($post, $type){
        $nameLen = iconv_strlen($post['name']);
        $descriptionLen = iconv_strlen($post['description']);
        $textLen = iconv_strlen($post['text']);
        if($nameLen < 3 or $nameLen > 100){
            $this->error = 'Название должно содержать от 3 до 100 символов';
            return false;
        } elseif ($descriptionLen < 3 or $descriptionLen > 100){
            $this->error = 'Описание должно содержать от 3 до 100 символов';
            return false;
        } elseif ($textLen < 10 or $textLen > 5000){
            $this->error = 'Текст должен содержать от 10 до 5000 символов';
            return false;
        }

         if(empty($_FILES['img']['tmp_name']) and $type == 'add'){
             $this->error = 'Изображение не выбрано';
             return false;
         }
        
        return true;
    }

    public function postAdd($post){
        $params = [
            'id' => '',
            'description' => $post['description'],
            'name' => $post['name'],
            'text' => $post['text'],
            'dt' => null,
        ];

        if($this->db->query('INSERT INTO posts VALUES (:id, :name, :description, :text, :dt)', $params)){
            $last_id = $this->db->lastInsertId();
            $params2 = [
                'id_post' => $last_id,
            'sum_value' => 0,
            'count_rate' => 0,
            ];
            $this->db->query('INSERT INTO posts_rating VALUES (:id_post, :sum_value, :count_rate)', $params2);
        }
        return $last_id;
    }

    public function postEdit($post, $id){
        $params = [
            'id' => $id,
            'description' => $post['description'],
            'name' => $post['name'],
            'text' => $post['text'],
        ];
        $this->db->query('UPDATE posts SET name = :name, description = :description, text = :text WHERE id = :id', $params);
        return $this->db->lastInsertId();
    }

    public function postUploadImage($path, $id){
        move_uploaded_file($path, 'public/materials/'.$id.'.jpg');
    }

    public function isPostExists($id) {
        $params = [
            'id' =>$id,
        ];
        return $this->db->column('SELECT id FROM posts WHERE id = :id', $params);
    }

    public function postDelete($id){
        $params = [
            'id' =>$id,
        ];
        $this->db->query('DELETE FROM posts WHERE id = :id', $params);
        unlink('public/materials/'.$params['id'].'.jpg');
    }

    public function postData($id){
        $params = [
            'id' => $id,
        ];
        return $this->db->row('SELECT * FROM posts WHERE id = :id', $params);
    }

}
