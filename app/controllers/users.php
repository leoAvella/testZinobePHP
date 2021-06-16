<?php
/**
 * Created by PhpStorm.
 * User: leonardoavella
 * Date: 10/06/21
 * Time: 9:10 PM
 */


use App\Entities\User;


if(!isset($_SESSION['user'])){
    header('Refresh: 1; URL = index.php?r=login');
    exit();
}

if(isset($_POST['logout'])){
    session_destroy();
    die( json_encode(['message' => "Sesión terminada", 'error' => false, 'data' => []]) );
}



if(isset($_POST['search_user'])){
    try{
        if(trim($_POST['search_user'])!=''){
            $users = User::whereRaw("UPPER(first_name) LIKE '%".strtoupper($_POST['search_user'])."%'")
                ->select(["id","job_title", "email", "first_name", "last_name", "document", "phone_number", "country", "state", "city", "birth_date"])
                ->orWhereRaw("UPPER(email) LIKE '%".strtoupper($_POST['search_user'])."%'" )
                ->get()->toArray();
        } else {
            $users = [];
        }
        die( json_encode(['message' => (sizeof($users)==0)?"No hay coincidencias":"Usuarios", 'error' => false, 'data' => $users]) );
    } catch (Exception $exception){
        die( json_encode(['message' => $exception->getMessage(), 'error' => true, 'data' => []]) );
    }
}


use Jenssegers\Blade\Blade;

$blade = new Blade(__DIR__.'/../../resources/views',__DIR__.'/../../resources/cache');

echo $blade->render('users', []);


