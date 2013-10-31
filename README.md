phpkg-filter
============

Filters(converts) values in an array.

Installation
------------

Install composer in your project:

    curl -s https://getcomposer.org/installer | php

Create a composer.json file in your project root:

    {
        "require": {
            "pokelabo/filter": "1.0.*"
        },
        "repositories": [
            {
                "type": "git",
                "url": "https://github.com/pokelabo/phpkg-filter.git",
                "url": "https://github.com/pokelabo/phpkg-core-utility.git"
            }
        ]
    }

Usage
-----

You can filter(converts) values in an array with specified rules.

Assume that you have values as below:

    $inputs = array('username' => '  nobody  '
                    'note'     => 'mailto: xyz@mysite.net');

You can define filter rules against the values in form of array of array.  

    $rules = array(
        array('username', 'trim'),
        array('note', 'regexp_replace',
                      'search' => '/\S+@\S+/',
                      'replace' => 'xxxx@example.com'),
    );

It has two rules, each rule forms array(`key of array`, `filter name` [, `options`...]).  

Now it is ready to filter values:

    $filter = new \pokelabo\filter\Filter($rules);
    $filtered_value = $filter($inputs);

Filters
-------

#### trim

Trimms string value.

| options            | default | description                                                            |
| :----------------- | :------ | :--------------------------------------------------                    |
| left               | true    | If `true`, it trims left side of `input.                               |
| right              | true    | If `true`, it trims right side of `input.                              |
| unicode            | true    | If `true`, it also trims more spaces defined by UNICODE specification. |

#### regexp_replace

Seaches regexp pattern `search` in `input` and replace with the string `replace`.

| options            | default | description                                                               |
| :----------------- | :------ | :--------------------------------------------------                       |
| search             |         | _Required_. Search pattern in regexp format.                              |
| replace            |         | _Required_. A string replace to.                                          |

#### string_replace

Seaches specified `search` string in `input` and replace all with the string `replace`.

| options            | default | description                                         |
| :----------------- | :------ | :-------------------------------------------------- |
| search             |         | _Required_. Search string.                          |
| replace            |         | _Required_. A string replace to.                    |

License
-------

MIT Public License
