<?php
    namespace App\classes\Helpers;

    class Helper {
        static function limpaMascara($campo)
        {
            $campo = str_replace(['.', '-', '(', ')', ' '], '', $campo);
            return $campo;
        }
    }