<?php

return [

    'mode' => APP_MODE,

    'view' => new \ABD\Extensions\Views\CustomViews(),

    'log.path' => './logs',

    'log.writer' => new \Slim\Logger\DateTimeFileWriter(),

];