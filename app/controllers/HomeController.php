<?php
   namespace App\controllers;

   use League\Plates\Engine;
   use App\model\QueryBuilder;
   use \Delight\Auth\Auth;
   use \Tamtamchik\SimpleFlash\Flash;
   use App\model\MyClass;
   use App\model\Role;



   class HomeController{
      private $templates; 
      private $db;
      private $auth;
      private $MyClass;
      private $Role;
      public function __construct(Engine $templates, QueryBuilder $db, Auth $auth, MyClass $MyClass, Role $Role){
         $this->templates = $templates;
         $this->db = $db;
         $this->auth = $auth;
         $this->MyClass = $MyClass;
         $this->Role = $Role;
      }



      public function home(){
         $status = [
            '1' => 'status-success',
            '2' => 'status-danger',
            '3' => 'status-warning',
         ];
         echo $this->templates->render('name.view', [
            'auth' => $this->auth,
            'getAllUsers' =>  $this->db->getAll('users'),
            'Role' => $this->Role,
            'status' => $status,
         ]);
      }


      public function NOT_FOUND(){
         echo '404';
         die;
      }
      
      public function NOT_ALLOWED(){
         echo '405';
      }


   }