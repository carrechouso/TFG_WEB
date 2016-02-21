<?php
/*class EmailConfig {
	public $gmail = array(
     'transport' => 'Smtp',
     'from' => array('site@caketest.lo' => 'CakeTest'),
     'host' => 'ssl://smtp.gmail.com', 
     'port' => 465,
     'username' => 'dscerredelo@gmail.com',
     'password' => '5'       
	);
}*/

class EmailConfig {

    public $default = array(
                            'host' => 'ssl://smtp.gmail.com',
                            'port' => 465,
                            'timeout' => 30,
                            'username' => 'micorreo@gmail.com',
                            'password' => 'miclave',
                            'client' => null,
                            'tls' => false
    );

    public $smtp = array(
        'transport' => 'Smtp',
        'from' => array('tfgusuario@gmail' => 'My Site'),
                            'host' => 'ssl://smtp.gmail.com',
							  'port' => 465,
							  'username' => 'tfgusuario@gmail.com',
							  'password' => 'tfgpass.',
							  'className' => 'Smtp',
							  'log' => true,
						       'context' => [
										    'ssl' => [
										        'verify_peer' => false,
										        'verify_peer_name' => false,
										        'allow_self_signed' => true
										    ]
										  ],
						        'charset' => 'utf-8',
						        //'headerCharset' => 'utf-8'
    );  
}
?>