<?php

   namespace App\model;

   use App\model\QueryBuilder;
   use App\model\MyClass;

   class Images {
      private $db;
      private $MyClass;

      public function __construct(QueryBuilder $db, MyClass $MyClass){
         $this->db = $db;
         $this->MyClass = $MyClass;
      }

      




      public function saveImg($file, $id = '') {

         $file = $_FILES['img'];
         // Название картины 
         $name = explode('.', $file['name']);
         // Получаем расширение картины
         $Expansion = explode('.', $file['name']);
         // Разрешенные расширение
         $AllowedExtensions = ['png', 'jpg', 'jpeg'];

         //Новое название картины
         $newName = array_shift($name) . uniqid('user') . '.jpg';
         //Откуда берем картину
         $from = $file['tmp_name'];
         //Куда сохранит  картину
         $to = 'img/ava/' . $newName;



         if (!$file['error']) {
            if (in_array(array_pop($Expansion), $AllowedExtensions)) {
               if (move_uploaded_file($from, $to)) {
                  if (!empty($id)) {
                     $userImg = $this->db->getOne('users', $id)['img'];
                     if (file_exists('img/ava/' . $userImg)) {
                        $this->delete($userImg);
                     }
                  }
                  return $newName;
               }
            } else {
               $this->MyClass->FlashRedirect("Расширение не поддерживается!!!", 'error', $_SERVER['REQUEST_URI']);
            }
         } else {
            $this->MyClass->FlashRedirect('Не удалось сохранит картину!', 'error', $_SERVER['REQUEST_URI']);
         }
      
      
      
      }





      public function delete($name) {
         return unlink('img/ava/' . $name);
      }







   }
   