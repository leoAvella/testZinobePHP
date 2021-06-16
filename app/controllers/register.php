<?php
/**
 * Created by PhpStorm.
 * User: leonardoavella
 * Date: 10/06/21
 * Time: 9:10 PM
 */


if(isset($_SESSION['user'])){
    header('Refresh: 1; URL = index.php?r=users');
    exit();
}


/**AJAX SEARCH DATA**/
if(isset($_POST['documentSearch'])){
    $searchedValue = $_POST['documentSearch'];
    try {
        $apis = [
            'http://www.mocky.io/v2/5d9f39263000005d005246ae?mocky-delay=1s',
            'http://www.mocky.io/v2/5d9f38fd3000005b005246ac?mocky-delay=10s'
        ];
        for($i = 0; $i<sizeof($apis); $i++){
            $data = App\customer\CustomerData::getData($apis[$i]);
            if(isset($data['objects'])){
                $neededObject = array_filter(
                    $data['objects'],
                    function ($e) use ($searchedValue, $i) {
                        $key =  ($i == 0)?'document':'cedula';
                        if ($e[$key] == $searchedValue)
                            die((json_encode(['message' => 'Resultados de la busqueda', 'error' => false, 'data' => $e, 'api' => $i])));
                    }
                );
            }
        }
       die( json_encode(['message' => "No se encontraron resultados para el documento $searchedValue", 'error' => true, 'data' => []]) );
    } catch (Exception $exception){
        die(json_encode(['message'=> $exception->getMessage(), 'error' => true, 'data'=> []]));
    }
}


use App\Entities\User;
/******/
if(isset($_POST['user'])){

    try{
        $userE = User::where(['document' => $_POST['user']['document']])->first();
        if($userE){
            die( json_encode(['message' => "El Usuario con documento ".$userE->document." ya esta registrado", 'error' => true]) );
        } else {
            $user = User::create($_POST['user']);
            die( json_encode(['message' => "Usuario guardado", 'error' => false]) );
        }
    } catch (Exception $exception){
        die( json_encode(['message' => $exception->getMessage(), 'error' => true]) );
    }

}



use Jenssegers\Blade\Blade;

$blade = new Blade(__DIR__.'/../../resources/views',__DIR__.'/../../resources/cache');

echo $blade->render('register', []);


