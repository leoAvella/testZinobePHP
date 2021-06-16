<?php
/**
 * Created by PhpStorm.
 * User: leonardoavella
 * Date: 10/06/21
 * Time: 9:10 PM
 */


use App\Entities\User;

if(isset($_SESSION['user'])){
    header('Refresh: 1; URL = index.php?r=users');
    exit();
}


if( isset($_POST['email'])  && isset($_POST['password']) ){

    $user = User::where(['email' => $_POST['email'], 'password' => $_POST['password'] ])->first();

    if(isset($user->userid)){
        $_SESSION['user'] = $user;
        die( json_encode(['message' => "Usuario logeado", 'error' => false, 'data' => []]) );
    } else{
        die( json_encode(['message' => "Usuario o contraseña errado", 'error' => true, 'data' => []]) );
    }
}




use Jenssegers\Blade\Blade;

$blade = new Blade(__DIR__.'/../../resources/views',__DIR__.'/../../resources/cache');

echo $blade->render('login', []);


