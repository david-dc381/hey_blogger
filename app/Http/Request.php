<?php namespace App\Custom\Http;
use \Illuminate\Http\Request as Base;

/**
 * Todo este archivo 'Request' se creo porque el protocolo
 * https no se configuro en el proyecto y es por eso que no
 * reconocen nuestros assets, img, js, css. Y todo esto porque
 * https un protocolo seguro y es algo comun
 */

class Request extends Base {

    public function isSecure() {
        $isSecure = parent::isSecure();
        if ($isSecure) {
            return true;
        }
        if (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == 'on') {
            return true;
        } else if (!empty($_SERVER['HTTP_X_FORWARDED_PROTO']) && $_SERVER['HTTP_X_FORWARDED_PROTO'] == 'https' || !empty($_SERVER['HTTP_X_FORWARDED_SSL']) && $_SERVER['HTTP_X_FORWARDED_SSL'] == 'on') {
            return true;
        }
        return false;
    }

}
