<?php

namespace application\models;

use application\core\Model;

class Main extends Model{

    public $error;
    

    public function postsCount(){
        return $this->db->column('SELECT COUNT(id) FROM posts');
    }

    public function postsList($route){
        $max = 3;
        $params = [
            'max' => $max,
            'start' => (($route['page'] ?? 1 ) - 1) * $max,
        ];
        return $this->db->row('SELECT * FROM posts LEFT JOIN posts_rating ON posts.id = posts_rating.id_post ORDER BY id DESC LIMIT :start, :max', $params);
    }

    public function recomendList(){
        return $this->db->row('SELECT * FROM posts LEFT JOIN posts_rating ON posts.id = posts_rating.id_post ORDER BY sum_value/count_rate DESC LIMIT 2');
    }
}