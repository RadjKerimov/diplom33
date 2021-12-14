# Дипломная работа! 

## Возможности проекта!
- Регистрироваться
- Авторизация
- Редактировать свои данные
- Менять статус
- Менять аватарку
- Менять Email и пароль 
- Удалять своего пользователя
- Роли MANAGER && ADMIN


### Возможности ролей 
- Manager может редактировать свой профиль, изменят аватарку и статус а так же пароль и email
- Admin может буквально все удалят редактировать любой аккаунт, а так же добовлят нового пользывателя 


## Дополнительно:
Настройки подключения к базе данных в файле ConfigDI/ConfigDI.php на строке 15

```php
  return new PDO("mysql:host=localhost; dbname=diplom3; charset=utf8", "root", "root");
```
## Компоненты:
```php
  "require": {
        "nikic/fast-route": "^1.3",
        "php-di/php-di": "^6.3",
        "delight-im/auth": "^8.3",
        "kint-php/kint": "^3.3",
        "tamtamchik/simple-flash": "^2.0",
        "league/plates": "^3.4",
        "aura/sqlquery": "^2.7",
     }
```
## Собственные компоненты:
  - Images
  - MyClass
  - QueryBuilder
  - Role

## Аккаунты пользователей из базы:
- admin@ya.ru
- user1@ya.ru
- user2@ya.ru

Пароль 123
