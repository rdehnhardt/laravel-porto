<?php

use Porto\Serializers\ArraySerializer;

return [
    'default_serializer' => ArraySerializer::class,

    'hash' => [
        'salt' => 'your-salt-string',
        'length' => 'your-length-integer',
    ],
];