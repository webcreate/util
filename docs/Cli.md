# Cli

The Cli class is a small wrapper around Symfony Process component.

## Usage

    ``` php
    use Webcreate\Util\Cli;

    $cli = new Cli();
    $commandline = $cli->prepare('/usr/bin/svn', array('list', 'svn://somerepos'));
    $exitCode = $cli->execute($commandline);
    $output = $cli->getOutput();

    ```