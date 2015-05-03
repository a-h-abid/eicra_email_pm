<?php

return [

    'transporter'       => 'ABD\Mailer\Transporters\Gmail',

    'transporters'      => [

        'ABD\Mailer\Transporters\Gmail'     => ['gmail'],

        'ABD\Mailer\Transporters\Outlook'   => ['live','hotmail','msn','outlook'],

        'ABD\Mailer\Transporters\Yahoo'     => ['yahoo'],

    ],

    'driver'            => 'smtp',

    'encription'        => 'tls',

    'authentication'    => true,

];