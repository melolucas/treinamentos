<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

    $config['email_config'] = Array(
            'smtp_crypto' => 'tls',
            'protocol' => 'smtp',
            'smtp_host' => 'mail.farmaciaeconomica.com.br',
            'smtp_pass' => '2539v5fg',
            'smtp_port' => '587',
            'mailpath' => '/usr/sbin/sendmail',
             'mailtype' => 'html',
            'smtp_auth'  => TRUE,
            'charset' => 'utf-8',
            'wordwrap' => TRUE
    );

    // $config['email_config'] = Array(
    //     'mailtype' => 'html',
    //     'charset' => 'iso-8859-1',
    //     'wordwrap' => TRUE
    // );

