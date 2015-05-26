<?php
/**
 * @author stev leibelt <artodeto@bazzline.net>
 * @since 2015-05-26 
 */

namespace Net\Bazzline\Component\CommandCollection\Filesystem;

use Net\Bazzline\Component\Command\Command;
use Net\Bazzline\Component\Command\InvalidSystemEnvironmentException;
use Net\Bazzline\Component\Command\RuntimeException;

class Copy extends Command
{
    /**
     * @param string $source
     * @param string $destination
     * @param boolean $recursive
     * @return array
     * @throws RuntimeException
     */
    public function __invoke($source, $destination, $recursive = true)
    {
        return $this->copy($source, $destination, $recursive);
    }

    /**
     * @param string $source
     * @param string $destination
     * @param boolean $recursive
     * @return array
     * @throws RuntimeException
     */
    public function copy($source, $destination, $recursive = true)
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

        if (file_exists($destination)) {
            throw new RuntimeException(
                'given destination exists already'
            );
        }

        return $this->execute('/usr/bin/cp ' . ($recursive ? '-r ' : '') . $source . ' ' . $destination);
    }

    /**
     * @throws InvalidSystemEnvironmentException
     */
    public function validateSystemEnvironment()
    {
        if (!is_executable('/usr/bin/cp')) {
            throw new InvalidSystemEnvironmentException(
                '/usr/bin/cp is mandatory'
            );
        }
    }
}