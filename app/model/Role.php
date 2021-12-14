<?php

   namespace App\model;

   use \Tamtamchik\SimpleFlash\Flash;
   use \Delight\Auth\Auth;
   use App\model\MyClass;



   class Role{
      private $Flash;
      private $auth;
      private $MyClass;
      public function __construct(Flash $Flash, Auth $auth, MyClass $MyClass){
         $this->Flash = $Flash;
         $this->auth = $auth;
         $this->MyClass = $MyClass;
      }







      /*
      * Проверяет админ или ID соответствует пользователю
      */
      public function AdminOrUser($idUser){
         if ($this->Admin() || $this->auth->getUserId() == $idUser) {
            return true;
         }
         return false;  
      }





      // Проверка Админ return bool
      public  function Admin(){
         return $this->auth->hasRole(\Delight\Auth\Role::ADMIN);
      }









      //Задать роль //$this->MyClass->giveRole('kerimovaleria@ya.ru');
      public function giveRole($email, $role = 'MANAGER'){
         switch ($role) {
            case 'ADMIN':
               try {
                  $this->auth->admin()->addRoleForUserByEmail($email, \Delight\Auth\Role::ADMIN);
               } catch (\Delight\Auth\InvalidEmailException $e) {
                  $this->MyClass->FlashRedirect('Не известный Email!', 'error', '/');
               }
               break;
            case 'MANAGER':
               try {
                  $this->auth->admin()->addRoleForUserByEmail($email, \Delight\Auth\Role::MANAGER);
               } catch (\Delight\Auth\InvalidEmailException $e) {
                  $this->MyClass->FlashRedirect('Не известный Email!', 'error', '/');
               }
               break;
               
         }
      }





      function EditUserProfile(\Delight\Auth\Auth $auth) {
         return $this->auth->hasAnyRole(\Delight\Auth\Role::ADMIN,);
      }

   }