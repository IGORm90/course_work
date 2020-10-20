<?php

namespace application\models;

use application\core\Model;

class Account extends Model {

	public function validate($input, $post) {

		$rules = [
			'login' => [
				'pattern' => '#^[a-z0-9]{3,15}$#',
				'message' => 'Логин указан неверно (разрешены только латинские буквы и цифры от 3 до 15 символов',
			],
			'password-1' => [
				'pattern' => '#^[a-z0-9]{8,30}$#',
				'message' => 'Пароль указан неверно (разрешены только латинские буквы и цифры от 10 до 30 символов',

			],
			'password-2' => [
				'pattern' => '#^[a-z0-9]{8,30}$#',
				'message' => 'Пароль указан неверно (разрешены только латинские буквы и цифры от 10 до 30 символов',

			],
		];
		foreach ($input as $val) {
			if (!isset($post[$val]) or !preg_match($rules[$val]['pattern'], $post[$val])) {
				$this->error = $rules[$val]['message'];
				return false;
			}
		}
		return true;
	}


	public function checkLoginExists($login) {
		$params = [
			'login' => $login,
		];
		if ($this->db->column('SELECT id FROM accounts WHERE login = :login', $params)) {
			$this->error = 'Этот логин уже используется';
			return false;
		}
		return true;
	}


	public function register($post) {
		$params = [
			'id' => '',
			'login' => $post['login'],
			'password' => password_hash($post['password-1'], PASSWORD_BCRYPT),

		];
		$this->db->query('INSERT INTO accounts VALUES (:id, :login, :password)', $params);
		
	}

	public function checkData($login, $password) {
		$params = [
			'login' => $login,
		];
		$hash = $this->db->column('SELECT password FROM accounts WHERE login = :login', $params);
		if (!$hash or !password_verify($password, $hash)) {
			return false;
		}
		return true;
	}
	
	public function login($login) {
		$params = [
			'login' => $login,
		];
		$data = $this->db->row('SELECT * FROM accounts WHERE login = :login', $params);
		$_SESSION['account'] = $data[0];
	}

	public function addRating($id_post, $id_user, $rating){
		$params = [
			'id' => '',
			'id_post' => (int)$id_post,
			'id_user' => (int)$id_user,
			'rating' => (int)$rating,
		];
		$this->db->query('INSERT INTO rating_post VALUES (:id, :id_post, :id_user, :rating)', $params);		
		$nextParams = [
			'id_post' => $params['id_post'],
			'sum_value' => $params['rating'],
		];
		$this->db->query('UPDATE posts_rating SET sum_value = sum_value + :sum_value, count_rate = count_rate + 1  WHERE id_post = :id_post', $nextParams);
		return true;
	}

	public function checkRating($id_user, $id_post){
		 $params = [
			 'id_user' => $id_user,
			 'id_post' => $id_post,
		 ];
		 $data = $this->db->column('SELECT EXISTS(SELECT * FROM rating_post WHERE id_post = :id_post AND id_user = :id_user)', $params);
		 if($data === '0'){
			 return false;
		 } else {
			 return true;
		 }

	}

	public function getRateFromUser($id_user){
		$params = [
			'id_user' => $id_user,
		];
		$data = $this->db->row('SELECT * FROM rating_post WHERE id_user = :id_user', $params);
		return $data;
	}

}