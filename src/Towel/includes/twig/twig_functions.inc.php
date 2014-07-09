<?php

/**
 * Defines custom twig Functions
 */

$app = get_app();

/**
 * Renders an url with the given parameters.
 *
 * {{ url('/full/path/manual/Route') }}
 *
 * or for named routes.
 *
 * {{ url('route_name', { id: 69 }) }}
 *
 */
$url = new Twig_SimpleFunction('url', function ($route, $parameters = array(), $absolute = false) {
    return url($route, $parameters, $absolute);
});
$app->twig()->addFunction($url);


/**
 * Renders all messages. Use this for global messages.
 *
 * {{ render_messages() }}
 */
$render_messages = new Twig_SimpleFunction('render_messages', function() {
   static $messages = array();
   $app = get_app();
   $out = '';

   if (empty($message)) { //First time we will read the message from the session, after that from the current messages.
    $messages = $app->session()->get('messages');
   }

   foreach ($messages as $message) {
       $out .= "<div class='alert alert-{$message->mt}'>{$message->content}</div>";
   }
    $app->session()->set('messages', array()); //Clean Messages.
   return $out;
});
$app->twig()->addFunction($render_messages);

/**
 * Assets url
 */
$assets_url = new Twig_SimpleFunction('assets_url', function ($application, $path) {
    return assets_url($application, $path);
});
$app->twig()->addFunction($assets_url);


/** Users */

$app->twig()->addFunction(new Twig_SimpleFunction('is_authenticated', function () {
    $app = get_app();
    return $app->isAuthenticated();
}));

$app->twig()->addFunction(new Twig_SimpleFunction('user_name', function () {
    $app = get_app();
    $user = $app->getCurrentUser();
    //vdd($user);
    return $user->username;
}));
