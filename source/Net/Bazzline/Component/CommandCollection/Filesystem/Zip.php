<?php
/**
 * @author stev leibelt <artodeto@bazzline.net>
 * @since 2015-05-26 
 */

namespace Net\Bazzline\Component\CommandCollection\Filesystem;

use Net\Bazzline\Component\Command\Command;
use Net\Bazzline\Component\Command\InvalidSystemEnvironmentException;
use Net\Bazzline\Component\Command\RuntimeException;

class Zip extends Command
{
    /**
     * @param string $archiveName
     * @param array $items
     * @return array
     * @throws RuntimeException
     */
    public function __invoke($archiveName, array $items)
    {
        return $this->zip($archiveName, $items);
    }

    /**
     * @param string $archiveName
     * @param array $items
     * @return array
     * @throws RuntimeException
     * @todo implement parameter validation
     */
    public function zip($archiveName, array $items)
    {
        $command = '/usr/bin/zip -r ' . $archiveName . ' ' . implode(' ' , $items);

        return $this->execute($command);
    }

    /**
     * @throws InvalidSystemEnvironmentException
     */
    public function validateSystemEnvironment()
    {
        if (!is_executable('/usr/bin/zip')) {
            throw new InvalidSystemEnvironmentException(
                '/usr/bin/zip is mandatory'
            );
        }
    }
}