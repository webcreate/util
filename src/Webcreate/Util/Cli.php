<?php

/*
 * @author Jeroen Fiege <jeroen@webcreate.nl>
 * @copyright Webcreate (http://webcreate.nl)
 */

namespace Webcreate\Util;

use Symfony\Component\Process\Process;

/**
 * Command line interface utility
 *
 * @author Jeroen Fiege <jeroen@webcreate.nl>
 */
class Cli
{
    protected $process;
    protected $timeout = 120;

    /**
     * Set timeout
     *
     * @param int $timeout
     * @return $this
     */
    public function setTimeout($timeout)
    {
        $this->timeout = $timeout;

        return $this;
    }

    /**
     * Returns timeout
     *
     * @return int
     */
    public function getTimeout()
    {
        return $this->timeout;
    }

    /**
     * Prepares a commandline
     *
     * @param  string $command
     * @param  array  $arguments
     * @return string
     */
    public function prepare($command, array $arguments = array())
    {
        $commandline = $command;

        foreach ($arguments as $option => $value) {
            if (is_bool($value)) {
                if ($value === true) {
                    $commandline .= ' ' . $option;
                }
            } else {
                $seperator = ' ';
                if (!is_integer($option)) {
                    $commandline .= ' ' . $option;
                    if (substr($option, -1, 1) == '=') {
                        $seperator = '';
                    }
                }
                $commandline .= $seperator . $this->escapeArgument($value);
            }
        }

        return $commandline;
    }

    protected function escapeArgument($arg)
    {
        if (defined('PHP_WINDOWS_VERSION_MAJOR') && strpos($arg, '%') !== FALSE) {
            return '"'.$arg.'"';
        }

        return escapeshellarg($arg);
    }

    /**
     * Runs the process.
     *
     * The callback receives the type of output (out or err) and
     * some bytes from the output in real-time. It allows to have feedback
     * from the independent process during execution.
     *
     * The STDOUT and STDERR are also available after the process is finished
     * via the getOutput() and getErrorOutput() methods.
     *
     * @param string               $commandline The command line to run
     * @param Closure|string|array $callback    A PHP callback to run whenever there is some
     *                                          output available on STDOUT or STDERR
     * @param string $cwd The working directory
     *
     * @return integer The exit status code
     *
     * @throws \RuntimeException When process can't be launch or is stopped
     */
    public function execute($commandline, $callback = null, $cwd = null)
    {
        $this->process = new Process($commandline, $cwd, null, null, $this->timeout);

        return $this->process->run($callback);
    }

    /**
     * Returns the internal process
     *
     * @return \Symfony\Component\Process\Process
     */
    public function getProcess()
    {
        return $this->process;
    }

    /**
     * Returns the current output of the process (STDOUT).
     *
     * @return string The process output
     */
    public function getOutput()
    {
        return $this->process->getOutput();
    }

    /**
     * Returns the current error output of the process (STDERR).
     *
     * @return string The process error output
     */
    public function getErrorOutput()
    {
        return $this->process->getErrorOutput();
    }
}
