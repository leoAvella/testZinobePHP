<?php
/**
 * Created by PhpStorm.
 * User: leonardoavella
 * Date: 8/06/21
 * Time: 7:16 PM
 */

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;

class User extends Model {

    protected $fillable = ["id","job_title", "email", "first_name", "last_name", "document", "phone_number", "country", "state", "city", "birth_date", "password"];




}