<?php
/**
 * @author stev leibelt <artodeto@bazzline.net>
 * @since 2015-05-26 
 */

namespace Net\Bazzline\Component\CommandCollection\Filesystem;

use Net\Bazzline\Component\Command\Command;
use Net\Bazzline\Component\Command\InvalidSystemEnvironmentException;
use Net\Bazzline\Component\Command\RuntimeException;

class Remove extends Command
{
    /**
     * @param string $source
     * @param boolean $recursive
     * @return array
     * @throws RuntimeException
     */
    public function __invoke($source, $recursive = true)
    {
        return $this->remove($source);
    }

    /**
     * @param string $source
     * @param boolean $recursive
     * @return array
     * @throws RuntimeException
     * @todo implement validation
     */
    public function remove($source, $recursive = true)
    {
        return $this->execute('/usr/bin/rm -f' . ($recursive ? 'r' : '') . ' ' . $source);
    }

    /**
     * @throws InvalidSystemEnvironmentException
     */
    public function validateSystemEnvironment()
    {
        if (!is_executable('/usr/bin/rm')) {
            throw new InvalidSystemEnvironmentException(
                '/usr/bin/rm is mandatory'
            );
        }
    }
}