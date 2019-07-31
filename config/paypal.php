<?php
/**
 * PayPal Setting & API Credentials
 * Created by Raza Mehdi <srmk@outlook.com>.
 */

return [

    'client_id'=>'ARCmGs0NQvS_8Yz2OyPrUN6cIMZI4hU6wlkobR_sL80te7Vo094fNizP5iyx4wpyWYjCh9AMTvM-ugW4',
    'secret'=>'EIfF_GKQuTLs_uhXwDMqubzQKKxkZjDXPz5XS4VqFze6W1YIt3Cw2gLXQPSrlq0mf3aBJls_KqJerNdq',
    'settings'=> array(
      'mode'=>'live',
        'http.ConnectionTimeOut' =>30 ,
        'log.LogEnabled' =>true,
        'log.FileName' => storage_path().'/logs/paypal.log',
        'log.LogLevel' =>'ERROR',
    ),
];
