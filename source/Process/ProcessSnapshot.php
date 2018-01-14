<?php
/**
 * @author stev leibelt <artodeto@bazzline.net>
 * @since 2014-12-14 
 */

namespace Net\Bazzline\Component\CommandCollection\Process;

use Net\Bazzline\Component\Command\AbstractCommand;
use Net\Bazzline\Component\Command\RuntimeException;

/**
 * Class ProcessSnapshot
 * @package Example\ps
 */
class ProcessSnapshot extends AbstractCommand
{
    /**
     * @return array
     * @throws RuntimeException
     */
    public function ps()
    {
        return $this->execute(
            '/usr/bin/ps auxf'
        );
    }

    /**
     * @return array
     */
    public function __invoke()
    {
        return $this->ps();
    }
}