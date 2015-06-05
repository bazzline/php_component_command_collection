<?php
/**
 * @author stev leibelt <artodeto@bazzline.net>
 * @since 2015-05-26 
 */

namespace Net\Bazzline\Component\CommandCollection\Filesystem;

use Net\Bazzline\Component\Command\Command;
use Net\Bazzline\Component\Command\InvalidSystemEnvironmentException;
use Net\Bazzline\Component\Command\RuntimeException;

class Move extends Command
{
    /**
     * @param string $source
     * @param string $destination
     * @return array
     * @throws RuntimeException
     * @throws InvalidSystemEnvironmentException
     */
    public function __invoke($source, $destination)
    {
        return $this->move($source, $destination);
    }

    /**
     * @param string $source
     * @param string $destination
     * @return array
     * @throws RuntimeException
     * @throws InvalidSystemEnvironmentException
     */
    public function move($source, $destination)
    {
        if (!is_readable($source)
            && (
                !is_file($source)
                || !is_dir($source)
            )
        ) {
            throw new RuntimeException(
                'given source needs to be a readable file or directory'
            );
        }

        return $this->execute('/usr/bin/env mv ' . $source . ' ' . $destination);
    }

    /**
     * @throws InvalidSystemEnvironmentException
     */
    public function validateSystemEnvironment()
    {
        if (!is_executable('/usr/bin/mv')) {
            throw new InvalidSystemEnvironmentException(
                '/usr/bin/mv is mandatory'
            );
        }
    }
}