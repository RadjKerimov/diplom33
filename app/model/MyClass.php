<?php

   namespace App\model;

   use \Tamtamchik\SimpleFlash\Flash;
   use \Delight\Auth\Auth;

   

   class MyClass{
      private $Flash;
      private $auth;
      public function __construct(Flash $Flash, Auth $auth){
         $this->Flash = $Flash;
         $this->auth = $auth;
      }







      public function FlashRedirect ($text, $StatusDisplay, $Redirect){
         $this->Flash::$StatusDisplay($text);
         $this->Redirect($Redirect);
      }




      public function Redirect($to ='/' ){
         header('Location: ' .$to);
         exit();
      }




      // Проверяет авторизован пользыватель или нет 
      public function InTheSystem (){
         if (!$this->auth->isLoggedIn()) {
            $this->FlashRedirect('Вы не авторизованы!', 'error', '/login');
         }
      }




   }