ZeDoctrineExtensions
==================

A set of Doctrine 2 extensions http://www.doctrine-project.org

Mainly the current existing are a start for platform dependant
SQL functions.

Installation
------------

The recommended way to install `zeineddin/ze-doctrine-extensions` is through
[composer](http://getcomposer.org/):

1. Add this project and [doctrine-extensions](https://github.com/pradeep-sanjaya/doctrine-extensions) in your composer.json:

    ```json
    "repositories": [
            {
                "url": "https://github.com/pradeep-sanjaya/doctrine-extensions.git",
                "type": "git"
            }
    ],
    "require": {
        "pradeep-sanjaya/doctrine-extensions": "dev-master"
    }
    ```

2. Now tell composer to download ze-doctrine-extensions by running the command:

    ```bash
    $ php composer.phar update
    ```