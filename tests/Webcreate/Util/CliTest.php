<?php

/*
 * @author Jeroen Fiege <jeroen@webcreate.nl>
 * @copyright Webcreate (http://webcreate.nl)
 */

use Webcreate\Util\Cli;

class CliTest extends PHPUnit_Framework_TestCase
{
    /**
     * @dataProvider prepareProvider
     */
    public function testPerpare($command, $arguments, $expected)
    {
        $cli = new Cli();
        $commandline = $cli->prepare($command, $arguments);

        $this->assertEquals($expected, $commandline);
    }

    public function prepareProvider()
    {
        return array(
                array('test', array('-n' => 1), 'test -n \'1\''),
                array('abc', array('-n=' => 1), 'abc -n=\'1\''),
                array('abc', array('-n' => true, 'arg2'), 'abc -n \'arg2\''),
                array('abc', array('-n' => false, 'arg2', 'arg3'), 'abc \'arg2\' \'arg3\''),
                array('echo', array('-x' => 'hello world'), 'echo -x \'hello world\''),
        );
    }
}