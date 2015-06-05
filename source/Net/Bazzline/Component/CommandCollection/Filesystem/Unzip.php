<?php
/**
 * @author stev leibelt <artodeto@bazzline.net>
 * @since 2015-05-26 
 */

namespace Net\Bazzline\Component\CommandCollection\Filesystem;

use Net\Bazzline\Component\Command\Command;
use Net\Bazzline\Component\Command\InvalidSystemEnvironmentException;
use Net\Bazzline\Component\Command\RuntimeException;

class Unzip extends Command
{
    /**
     * @param string $pathToArchive
     * @param null $outputPath
     * @return array
     * @throws RuntimeException
     */
    public function __invoke($pathToArchive, $outputPath = null)
    {
        return $this->unzip($pathToArchive, $outputPath);
    }

    /**
     * @param string $pathToArchive
     * @param null|string $outputPath
     * @return array
     * @throws RuntimeException
     * @todo implement parameter validation
     */
    public function unzip($pathToArchive, $outputPath = null)
    {
        if (!is_null($outputPath)) {
            $command = '/usr/bin/env unzip ' . $pathToArchive . ' -d ' . $outputPath;
        } else {
            $command = '/usr/bin/env unzip ' . $pathToArchive;
        }

        return $this->execute($command);
    }

    /**
     * @param string $pathToArchive
     * @return array
     * @throws RuntimeException
     * @todo implement parameter validation
     */
    public function listArchiveContent($pathToArchive)
    {
        $command = '/usr/bin/env unzip -l ' . $pathToArchive;

        return $this->execute($command);
    }

    /**
     * @throws InvalidSystemEnvironmentException
     */
    public function validateSystemEnvironment()
    {
        if (!is_executable('/usr/bin/unzip')) {
            throw new InvalidSystemEnvironmentException(
                '/usr/bin/unzip is mandatory'
            );
        }
    }
}