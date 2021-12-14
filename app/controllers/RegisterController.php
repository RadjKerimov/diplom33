<?php
   namespace App\controllers;

   use League\Plates\Engine;
   use App\model\QueryBuilder;
   use App\model\MyClass;
   use \Delight\Auth\Auth;
   use \Tamtamchik\SimpleFlash\Flash;




   class RegisterController{
      private $templates; 
      private $db;
      private $auth;
      private $Flash;
      private $MyClass;
      
      public function __construct(Engine $templates, QueryBuilder $db, Auth $Auth, Flash $Flash, MyClass $MyClass){
         $this->templates = $templates;
         $this->db = $db;
         $this->auth = $Auth;
         $this->Flash = $Flash;
         $this->MyClass = $MyClass;
      }








      public function login(){
         if ($this->auth->isLoggedIn()) {
            $this->Flash::error('Вы  авторизованы!');
            $this->MyClass->Redirect('/');
         } 
 
         echo $this->templates->render('login.view', [
            'auth' => $this->auth,
            'getAllUsers' =>  $this->db->getAll('users'),
         ]);

         if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $rememberDuration = null;
            if ($_POST['remember'] == 1) {
               $rememberDuration = (int) (60 * 60 * 24 * 365.25);
            } 
               
            

            try {
               $this->auth->login($_POST['email'], $_POST['password'], $rememberDuration);  
               $this->MyClass->FlashRedirect('<b>' . $this->auth->getUsername() . '</b> &#129303; вы авторизовались!', 'info', '/');
            } catch (\Delight\Auth\InvalidEmailException $e) {
               $this->MyClass->FlashRedirect('Неправильный адрес электронной почты', 'error', '/login');
            } catch (\Delight\Auth\InvalidPasswordException $e) {
               $this->MyClass->FlashRedirect('Неверный пароль!', 'error', '/login');
            } catch (\Delight\Auth\EmailNotVerifiedException $e) {
               $this->MyClass->FlashRedirect('Электронная почта не потвержден!', 'error', '/login');
            } catch (\Delight\Auth\TooManyRequestsException $e) {
               $this->MyClass->FlashRedirect('Слишком много запросов!', 'error', '/login');
            } 
         }  
      }


      public function register(){
         if ($this->auth->isLoggedIn()) {
            $this->Flash::error('Вы  авторизованы!   <a href="/exit">хотите выйти из системы?</a>');
            $this->MyClass->Redirect('/');
         } 
         

         if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            try {
               $userId = $this->auth->register($_POST['email'], $_POST['password'], $_POST['username'],  function ($selector, $token) {
                  $this->verification($selector, $token);
               });
               $this->Flash::info('Мы зарегистрировали нового пользователя с идентификатором' . $userId);
            } catch (\Delight\Auth\InvalidEmailException $e) {
               $this->MyClass->FlashRedirect('Неверный адрес электронной почты', 'error', '/register');
            } catch (\Delight\Auth\InvalidPasswordException $e) {
                $this->MyClass->FlashRedirect('Неверный пароль', 'error', '/register');
            } catch (\Delight\Auth\UserAlreadyExistsException $e) {             
               $this->MyClass->FlashRedirect('<strong>Уведомление!</strong> Этот эл. адрес уже занят.', 'error', '/register');
            } catch (\Delight\Auth\TooManyRequestsException $e) {
               $this->MyClass->FlashRedirect('Слишком много запросов', 'error', '/register');
            }  
         }  
         echo $this->templates->render('register.view', []);
      }


      public function exit(){
         if ($this->auth->isLoggedIn()) {
            try {
               $this->auth->logOutEverywhere();
               $this->MyClass->Redirect('/');
               exit;
            } catch (\Delight\Auth\NotLoggedInException $e) {
               $this->MyClass->FlashRedirect('Не удалось выйти из системы!', 'error', '/');
            }  
         }else {
            $this->MyClass->FlashRedirect('Вы не авторизованы!', 'error', '/');
         }
    
      }


      public function verification($selector, $token){
         try {
            $this->auth->confirmEmail($selector, $token);
            $this->MyClass->FlashRedirect('Адрес электронной почты был подтвержден можете авторизоваться!', 'info', '/login');
         } catch (\Delight\Auth\InvalidSelectorTokenPairException $e) {
               $this->MyClass->FlashRedirect('Недопустимый токен', 'error', '/login');
         } catch (\Delight\Auth\TokenExpiredException $e) {
            $this->MyClass->FlashRedirect('Срок действия токена истек', 'error', '/login');
         } catch (\Delight\Auth\UserAlreadyExistsException $e) {
            $this->MyClass->FlashRedirect('Адрес электронной почты уже существует', 'error', '/login');
         } catch (\Delight\Auth\TooManyRequestsException $e) {
            $this->MyClass->FlashRedirect('Слишком много запросов!', 'error', '/login');
         }        
      }








   }
