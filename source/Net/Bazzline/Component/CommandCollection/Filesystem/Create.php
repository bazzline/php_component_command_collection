<?php
/**
 * @author stev leibelt <artodeto@bazzline.net>
 * @since 2015-05-26 
 */

namespace Net\Bazzline\Component\CommandCollection\Filesystem;

use Net\Bazzline\Component\Command\AbstractCommand;
use Net\Bazzline\Component\Command\InvalidSystemEnvironmentException;
use Net\Bazzline\Component\Command\RuntimeException;

class Create extends AbstractCommand
{
    /**
     * @param string $destination
     * @param boolean $recursive
     * @return array
     * @throws RuntimeException
     */
    public function __invoke($destination, $recursive = true)
    {
        return $this->copy($destination, $recursive);
    }

    /**
     * @param string $destination
     * @param boolean $recursive
     * @return array
     * @throws RuntimeException
     */
    public function copy($destination, $recursive = true)
    {
        if (file_exists($destination)) {
            throw new RuntimeException(
                'given destination exists already'
            );
        }

        return $this->execute('/usr/bin/env mkdir ' . ($recursive ? '-p ' : '') . $destination);
    }

    /**
     * @throws InvalidSystemEnvironmentException
     */
    public function validateSystemEnvironment()
    {
        if (!is_executable('/usr/bin/mkdir')) {
            throw new InvalidSystemEnvironmentException(
                '/usr/bin/mkdir is mandatory'
            );
        }
    }
}
