# Util library

Webcreate/Util is a PHP library containing some simple utility classes.

[![Build Status](https://secure.travis-ci.org/webcreate/util.png?branch=master)](https://travis-ci.org/webcreate/util)

Installation / Usage
--------------------

1. Download the [`composer.phar`](https://getcomposer.org/composer.phar) executable or use the installer.

    ``` sh
    $ curl -s https://getcomposer.org/installer | php
    ```


2. Create a composer.json defining your dependencies. Note that this example is
a short version for applications that are not meant to be published as packages
themselves. To create libraries/packages please read the [guidelines](https://packagist.org/about).

    ``` json
    {
        "require": {
            "webcreate/util": "dev-master"
        }
    }
    ```

3. Run Composer: `php composer.phar install`

Overview utility classes
------------------------

[Cli](docs/Cli.md)

The Cli class is a small wrapper around Symfony Process component.