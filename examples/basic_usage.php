<?php

require '../vendor/autoload.php';

$rules = array(
    array('username', 'trim'),
    array('note', 'regexp_replace', 'search' => '/\S+@\S+/', 'replace' => 'xxxx@example.com'),
);

$filter = new \pokelabo\filter\Filter($rules);

$inputs['username'] = '  nobody  ';
$inputs['note'] = 'mailto: xyz@mysite.net';


$filtered_value = $filter($inputs);

printf("\ninputs = %s\nfiltered = %s\n\n",
       var_export($inputs, true),
       var_export($filtered_value, true));

