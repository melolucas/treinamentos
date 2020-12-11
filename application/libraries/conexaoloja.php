<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class conexaoloja {

        public function conectarLoja($servidor, $banco)
        {
                //Cria a conexão com os parametros de cada loja.
                $loja = array
                (
                        'dsn'   => '',
                        'hostname' => $servidor,
                        'username' => 'SYSDBA',
                        'password' => 'money',
                        'database' => $banco,
                        'dbdriver' => 'ibase',
                        'dbprefix' => '',
                        'pconnect' => FALSE,
                        'db_debug' => (ENVIRONMENT !== 'production'),
                        'cache_on' => FALSE,
                        'cachedir' => '',
                        'char_set' => 'ANSI',
                        'dbcollat' => 'NONE',
                        'swap_pre' => '',
                        'encrypt' => FALSE,
                        'compress' => FALSE,
                        'stricton' => FALSE,
                        'failover' => array(),
                        'save_queries' => TRUE
                );
                
                $CI =& get_instance();
                $CI->lojas_firebird = $CI->load->database($loja, true);
                $CI->lojas_firebird =& $CI->lojas_firebird;

                if(true){
                        return true;
                        
                } else {
                        redirect('inicio/erro/');
                }
        }
}

?>