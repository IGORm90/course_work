<?php

namespace application\controllers;

use application\core\Controller;

class AccountController extends Controller {

	// Регистрация

	public function registerAction() {
		if (!empty($_POST)) {
			if($_POST['password-1'] != $_POST['password-2']){
				$this->view->message('error', 'Пароли не совпадаюты');
			}
			if (!$this->model->validate(['login', 'password-1', 'password-2'], $_POST)) {
				$this->view->message('error', $this->model->error);
			}
			elseif (!$this->model->checkLoginExists($_POST['login'])) {
				$this->view->message('error', $this->model->error);
			}
			$this->model->register($_POST);
			$this->view->location('account/login');
		}
		$this->view->render('Регистрация');
	}


	// Вход

	public function loginAction() {
		if (!empty($_POST)) {
			if (!$this->model->validate(['login', 'password-1'], $_POST)) {
				$this->view->message('error', $this->model->error);
			}
			elseif (!$this->model->checkData($_POST['login'], $_POST['password-1'])) {
				$this->view->message('error', 'Логин или пароль указан неверно');
			}
			$this->model->login($_POST['login']);
			$this->view->location('account/profile');
		}
		$this->view->render('Вход');
	}

	// Профиль

	public function profileAction() {
		$data = $this->model->getRateFromUser($_SESSION['account']['id']);
		$vars = [
			'data' => $data,
		];
		$this->view->render('Профиль', $vars);
	}

	public function logoutAction() {
		unset($_SESSION['account']);
		$this->view->redirect('account/login');
	}

	public function ratingAction(){
		if(!isset($_SESSION['account']['id'])){
			$this->view->message('error', 'Вы не авторизированы!');
		}
		  $star = $_POST['star'];
		  $id_user = $_SESSION['account']['id'];
		  $id_post = $_POST['id-post'];
		  if($this->model->addRating($id_post, $id_user, $star)) {
		  	echo "Ваша оценка сохранена.";
		  }
	 }

	 

}