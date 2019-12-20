<?php

    $ativado = false;

    class Utf8{

        public static function encode($valor){

            global $ativado;

            if($ativado){

                $registro = utf8_encode($valor);
            }else{

                $registro = $valor;
            }

            return $registro;
        }

        public static function decode($valor){

            global $ativado;

            if($ativado){

                $registro = utf8_decode($valor);
            }else{

                $registro = $valor;
            }

            return $registro;
        }
    }

?>
