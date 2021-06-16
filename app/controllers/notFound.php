<?php
/**
 * Created by PhpStorm.
 * User: leonardoavella
 * Date: 10/06/21
 * Time: 9:01 PM
 */
use Jenssegers\Blade\Blade;


$blade = new Blade(__DIR__.'/../../resources/views',__DIR__.'/../../resources/cache');

echo $blade->render('notfound', ['name'=>'leo']);