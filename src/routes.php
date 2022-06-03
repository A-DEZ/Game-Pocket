<?php

// list of accessible routes of your application, add every new route here
// key : route to match
// values : 1. controller name
//          2. method name
//          3. (optional) array of query string keys to send as parameter to the method
// e.g route '/item/edit?id=1' will execute $itemController->edit(1)
return [
    '' => ['HomeController', 'index',],
    'games/show' => ['GameController', 'show', ['id']],
    'games/rate' => ['RateController', 'rate',['id']],
    'games/popularity' => ['PopularityController', 'popularity', ['url', 'id']],
    'games/comment' => ['CommentController', 'add', ['id']],
    'games/search' => ['GameController', 'search', ['query']],
    'forms/contact' => ['FormController', 'form',],
    'games/add' => ['GameController', 'addGame'],
    'user/login' => ['UserController', 'login',],
    'user/logout' => ['UserController', 'logout',],
    'games/sort' => ['GameController', 'gameAll', ['key']],
    'games/favorite' => ['FavoriteController', 'add', ['id']],
    'games/favorite/delete' => ['FavoriteController', 'delete', ['id']],
    'user/favorite' => ['FavoriteController', 'showFavorite',],
    'games/index' => ['GameController', 'gameAll',],
    'user/register' => ['UserController', 'register']
];
