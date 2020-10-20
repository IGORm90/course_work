<?php

namespace application\controllers;

use application\core\Controller;
use application\lib\Pagination;
use application\models\Admin;
use application\models\Account;

class MainController extends Controller{

      

   public function indexAction(){
      $Pagination = new Pagination($this->route, $this->model->postsCount(), 3);
      $vars = [
         'pagination' => $Pagination->get(),
         'list' => $this->model->postsList($this->route),
         'recomend' => $this->model->recomendList(),
      ];
      $this->view->render('Главная страница', $vars);
   }

   public function aboutAction(){
      $this->view->render('Обо мне');
   }

   public function contactAction(){
      if(!empty($_POST)){
         if(!$this->model->contactValidate($_POST)){
            $this->view->message('error', 'error');
         }
         mail('igmuz90@gmail.com', 'Сообщение из блога', $_POST['name'].'|'.$_POST['email'].'|'.$_POST['text'], 'From: igmuzstudy@gmail.com');
         $this->view->message('succcess', 'сообщение отправленно');
      }
         $this->view->render('Контакты');
   }

   public function postAction(){
      $adminModel = new Admin;
      if(!$adminModel->isPostExists($this->route['id'])){
         $this->view->errorCode(404);
      }
      $canDoRate = true;
		if(isset($_SESSION['account']['id'])){
         $id = (int)$_SESSION['account']['id'];
         $accountModel = new Account;
         if($accountModel->checkRating($id, $this->route['id'])){
            $canDoRate = false;
         }
      }
      $vars = [
         'data' => $adminModel->postData($this->route['id'])[0],
         'canDoRate' => $canDoRate,
      ];
      $this->view->render('Пост', $vars);
   }


   
}