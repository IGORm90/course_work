<?php

namespace application\lib;

use PDO;

class Db {
        
        protected $db;

        function __construct(){
            $config = require 'application/config/db.php';
            $this->db = new PDO('mysql:host='.$config['host'].';dbname='.$config['name'], $config['user'], $config['password']);
        }
        
        public function query($sql, $params = []){
            $stat = $this->db->prepare($sql);
            if(!empty($params)){
                foreach($params as $key => $val){
                    if (is_int($val)) {
                        $type = PDO::PARAM_INT;
                    } else {
                        $type = PDO::PARAM_STR;
                    }
                    $stat->bindValue(':'.$key, $val, $type);
                }
            }
            $stat->execute();
            return $stat;
        }

        // public function update($id_post, $sum_value){
        //     $sql = "UPDATE posts_rating SET sum_value = :sum_value + $sum_value, count_rate = :count_rate + 1 WHERE id_post = $id_post";
        //     $stat = $this->db->prepare($sql);
        //     $stat->execute();
        //     return true;
        // }

        public function row($sql, $params = []) {
            $result = $this->query($sql, $params);
            return $result->fetchAll(PDO::FETCH_ASSOC);
        }

        public function column($sql, $params = []){
            $result = $this->query($sql, $params);
            return $result->fetchColumn();
        }

        public function lastInsertId() {
            return $this->db->lastInsertId();
        }

    }