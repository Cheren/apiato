<?php

$tableName = 'countries';
$countryNameMaxLength = 50;

return [

    'table' => [
        'name' => $tableName,
        'name_max_length' => $countryNameMaxLength
    ],

    'rules' => [
        'name' => [
            'required',
            'unique:' . $tableName,
            'max:' . $countryNameMaxLength
        ],
        'params' => [
            'array'
        ]
    ]

];
