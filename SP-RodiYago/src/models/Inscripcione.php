<?php 
// Mismo nombre que la tabla que voy a manejar

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Inscripcione extends Model {

    public function __get($name){ return $this->$name; }
    public function __set($name, $value){ $this->$name = $value; }
}

