<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Helper extends Model
{

    // esta función nos sirve para hacer el random de caracteres para las imagenes, un token de seguridad
    public static function getToken($length = 50)
    {
        $token = "";
        $codeAlphabet    = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
        $codeAlphabet   .= "abcdefghijklmnopqrstuvwxyz"; // '.=', concatencaión con la variable de arriba
        $codeAlphabet   .= "0123456789";
        $max = strlen($codeAlphabet) - 1; // -1, para que empiece desde cero
        for ($i=0; $i < $length; $i++) { 
            $token .= $codeAlphabet[self::crypto_rand_secure(0, $max)]; // con self:: accedemos al funciones estaticas y con $this a publicas u objetos ya construidos.
        }

        return $token;
    }

    // para hacer una encriptacion random segura
    public static function crypto_rand_secure ($min, $max)
    {   // trata de sacar el minimo de usuarios repetidos
        $range = $max - $min;
        if ($range < 1) {
            return $min;    // esto hace que no sea tal al azar la cadena
        }
        $log    = ceil(log($range, 2));
        $bytes  = (int) ($log / 8) + 1; // longitud en bytes
        $bits   = (int) $log + 1; // longitud en bits
        $filter = (int) (1 << $bits) - 1; // establecer todos los bits inferiores a 1

        do {
            $rnd = hexdec(bin2hex(openssl_random_pseudo_bytes($bytes)));
            $rnd = $rnd & $filter; // descarta bits irrelevantes
        } while ($rnd >= $range);
        
        return $min + $rnd;
    }

    public static function saveImage($file, $folder)
    {
        // concatenamos el nombre de la img con el token
        $name = 'img'.self::getToken().'.'.$file->getClientOriginalExtension(); // obtenemos la extensión de la imagen.
        // esto nos devuelve la raiz del proyecto, y nos posiciona en la carpeta public y ahí dentro nos genera una carpeta img
        $path = public_path()."/img/".$folder;
        // aqui le decimos que se mueva a la ruta con el nombre que generamos de la img
        $file->move($path, $name);
        return $name;
    }

    public static function deleteImage($name, $folder)
    {
        if (strlen($name) > 0) {
            // verificamos si el archivo existe
            if (file_exists(public_path()."/img".'/'.$folder.'/'.$name)) {
                // si el archivo existe nos hace un borrado del archivo
                unlink(public_path()."/img".'/'.$folder.'/'.$name);
            }
        }
    }

    // use HasFactory;
}
