<?php
   namespace App\controllers;

   use League\Plates\Engine;
   use App\model\QueryBuilder;
   use App\model\MyClass;
   use \Delight\Auth\Auth;
   use \Tamtamchik\SimpleFlash\Flash;
   use App\model\Role;
   use App\controllers\RegisterController;
   use App\model\Images;

class UserController {
      private $templates; 
      private $db;
      private $auth;
      private $MyClass;
      private $Role;
      private $images;
      private $status = [
            '1' => 'Онлайн',
            '2' => 'Офлайн',
            '3' => 'Не беспокоить',
         ];
      public function __construct( Engine $templates, QueryBuilder $db, Auth $Auth,  MyClass $MyClass,  Role $Role, Images $images){
         $this->templates = $templates;
         $this->db = $db;
         $this->auth = $Auth;
         $this->MyClass = $MyClass;
         $this->Role = $Role;
         $this->images = $images;
      }





      public function create_user(){
         $this->MyClass->InTheSystem();
         if (!$this->Role->Admin()) {
            $this->MyClass->Redirect('/404');
         }


         if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            try {
               $userId = $this->auth->admin()->createUser($_POST['email'], $_POST['password'], $_POST['username']);
            } catch (\Delight\Auth\InvalidEmailException $e) {
               $this->MyClass->FlashRedirect('Неверный адрес электронной почты', 'error', '/create_user');
            } catch (\Delight\Auth\InvalidPasswordException $e) {
               $this->MyClass->FlashRedirect('Неверный пароль', 'error', '/create_user');
            } catch (\Delight\Auth\UserAlreadyExistsException $e) {
               $this->MyClass->FlashRedirect('Пользователь уже существует', 'error', '/create_user');
            }

            if ( $this->db->getOne('users', $userId)['id'] ) {
               unset($_POST['username'], $_POST['password'], $_POST['email'], $_POST['deleteImg']);



               $imgName = $this->images->saveImg($_FILES['img']);
              if ($imgName) {
                  $_POST['img'] = $imgName;
                  $this->db->update('users', $userId, $_POST);
                  $this->MyClass->FlashRedirect("Мы зарегистрировали нового пользователя с ID $userId", 'info', '/create_user');
              } 
              $this->MyClass->FlashRedirect('Не удалось сохранит изображение!!!', 'error', '/create_user');

            }
         }//post
      

         echo $this->templates->render('create_user.view', [
            'auth' => $this->auth,
            'status' => $this->status,
         ]);
      }









      public function edit_profile($var) {
         $var = $var['id'];
         $this->MyClass->InTheSystem();
      
         if (!$this->Role->AdminOrUser($var)) {
            $this->MyClass->Redirect('/404');
         }



               if ($_SERVER['REQUEST_METHOD'] == 'POST') { 
                  $result = $this->db->update('users', $var, [
                     'username' => trim($_POST['username']),
                     'surname' => trim($_POST['surname']),
                     'works' => trim($_POST['works']),
                     'tel' => trim($_POST['tel']),
                     'address' => trim($_POST['address']),
                  ]);


                  if ($result) {
                     $this->MyClass->FlashRedirect('Данные сохранены!', 'info', "/edit/$var");
                  }
                     $this->MyClass->FlashRedirect('Не удалось сохранить!', 'error', "/edit/$var");
               }
   
         
        
         echo $this->templates->render('edit.view', [
            'auth' => $this->auth,
            'getOneUsers' =>  $this->db->getOne('users' , $var),
         ]);
      }





      public function security($var){
         $var= $var['id'];
         $this->MyClass->InTheSystem();

         if (!$this->Role->AdminOrUser($var)) {
            $this->MyClass->Redirect('/404');
         }


         if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $email = trim($_POST['email']);
            $password = trim($_POST['password']);
            $newPassword = trim($_POST['newPassword']);


            if ($newPassword == $password) {
               if ($this->Role->Admin()) {
                  try {
                     $this->auth->admin()->changePasswordForUserById($var, $newPassword);
                  } catch (\Delight\Auth\UnknownIdException $e) {
                     $this->MyClass->FlashRedirect('Неизвестный ID!!!', 'error', "/security/$var");
                  } catch (\Delight\Auth\InvalidPasswordException $e) {
                     $this->MyClass->FlashRedirect('Неверный пароль!!!', 'error', "/security/$var");
                  }
               }elseif ($this->auth->id() == $var) {
                  try {
                     $this->auth->changePassword($password, $newPassword);
                  } catch (\Delight\Auth\NotLoggedInException $e) {
                     $this->MyClass->FlashRedirect('Не вошел в систему!', 'error', "/security/$var");
                  } catch (\Delight\Auth\InvalidPasswordException $e) {
                     $this->MyClass->FlashRedirect('Неверный пароль!', 'error', "/security/$var");
                  } catch (\Delight\Auth\TooManyRequestsException $e) {
                     $this->MyClass->FlashRedirect('Слишком много запросов!', 'error', "/security/$var");
                  }
               }

               $result = $this->db->update('users', $var, ['email' => $email,]);
               if ($result) {
                  $this->MyClass->FlashRedirect('Данные обновлены!!!', 'info', "/security/$var");
               }          
            }else {
               $this->MyClass->FlashRedirect('Пароли не совпадают!', 'error', "/security/$var");
            }
         }


         echo $this->templates->render('security.view', [
            'auth' => $this->auth,
            'getOneUsers' =>  $this->db->getOne('users', $var),
         ]);
      }




      public function status_profile($var){
         $var = $var['id'];
         $this->MyClass->InTheSystem();

         if (!$this->Role->AdminOrUser($var)) {
            $this->MyClass->Redirect('/404');
         }

 
         if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $result = $this->db->update('users', $var, [ 'status' => $_POST['status']] );

            if ($result) {
               $this->MyClass->FlashRedirect('Статус обновлен!', 'info', "/status/$var");
            }
            $this->MyClass->FlashRedirect('Не удалось изменить статус!', 'error', "/status/$var");
         }


         echo $this->templates->render('status.view', [
            'auth' => $this->auth,
            'getOneUsers' =>  $this->db->getOne('users', $var),
            'status' => $this->status,
         ]);


      }



   
      public function page_profile(){
         $this->MyClass->InTheSystem();

        

         echo $this->templates->render('page_profile.view', [
            'auth' => $this->auth,
            'getOneUsers' =>  $this->db->getOne('users', $this->auth->getUserId()),
         ]);

      }




      public function avatar($var){
         $this->MyClass->InTheSystem();
         if (!$this->Role->AdminOrUser($var)) {
            $this->MyClass->Redirect('/404');
         }

         $var = $var['id'];
         $userData = $this->db->getOne('users', $var);

         if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $img = $this->images->saveImg($_FILES, $var);
            $this->db->update('users', $var, [
               'img' => $img,
            ]);
         }
         //d($this->db->getOne('users', $var)); die;

         echo $this->templates->render('avatar.view', [
            'auth' => $this->auth,
            'getOneUsers' =>  $this->db->getOne('users', $var),
         ]);      

      }



      public function delete($id) {
         $id = $id['id'];
         $user = $this->db->getOne('users', $id);
        
         if (!empty($user)) {
            $this->db->delete('users', $id);
            $this->images->delete($user['img']);
            $this->MyClass->FlashRedirect('Пользыватель удален! ', 'info', '/');
         }else {
            $this->MyClass->FlashRedirect('Нет такого пользователя', 'error', '/');
         }
         
      }



   }