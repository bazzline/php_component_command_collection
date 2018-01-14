<?php
/**
 * @author stev leibelt <artodeto@bazzline.net>
 * @since 2014-12-14 
 */

namespace Net\Bazzline\Component\CommandCollection\Filesystem;

use Net\Bazzline\Component\Command\AbstractCommand;
use Net\Bazzline\Component\Command\RuntimeException;

/**
 * Class ListSource
 */
class ListSource extends AbstractCommand
{
    /**
     * @param string $path
     * @param string $option
     * @return array
     */
    public function __invoke(
        $path,
        $option = 'halt'
    ) {
        return $this->ls(
            $path,
            $option
        );
    }

    /**
     * @param string $path
     * @param string $option
     * @return array
     * @throws RuntimeException
     */
    public function ls(
        $path,
        $option = 'halt'
    ) {
        $command = '/usr/bin/ls ';

        if (strlen($option) > 0) {
            $command .= '-' . $option;
        }

        return $this->execute(
            $command . ' ' . $path
        );
    }
} 