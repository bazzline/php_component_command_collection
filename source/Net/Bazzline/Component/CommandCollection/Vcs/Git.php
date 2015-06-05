<?php
/**
 * @author stev leibelt <artodeto@bazzline.net>
 * @since 2015-05-26 
 */

namespace Net\Bazzline\Component\CommandCollection\Vcs;

use Net\Bazzline\Component\Command\Command;
use Net\Bazzline\Component\Command\InvalidSystemEnvironmentException;
use Net\Bazzline\Component\Command\RuntimeException;

class Git extends Command
{
    /**
     * @return array
     * @throws RuntimeException
     */
    public function __invoke()
    {
        return $this->execute('/usr/bin/env git');
    }

    /**
     * @param string $source
     * @param string $branch
     * @return array
     */
    public function checkout($source, $branch)
    {
        $this->validateRepositoryPath($source, 'source');

        $currentWorkingDirectory = getcwd();
        chdir($source);
        $return = $this->execute('/usr/bin/env git checkout ' . $branch);
        chdir($currentWorkingDirectory);

        return $return;
    }

    /**
     * clones repository/source - to bad "clone" is an illegal method name
     *
     * @param string $source
     * @param string $destination
     * @return array
     * @throws RuntimeException
     */
    public function create($source, $destination)
    {
        return $this->execute('/usr/bin/env git clone ' . $source . ' ' . $destination);
    }

    /**
     * @param string $source
     * @return array
     */
    public function listTags($source)
    {
        $this->validateRepositoryPath($source, 'source');

        $currentWorkingDirectory = getcwd();
        chdir($source);
        $return = $this->execute('/usr/bin/env git tag -l');
        chdir($currentWorkingDirectory);

        return $return;
    }

    /**
     * @param string $source
     * @return array
     * @todo implement $origin
     */
    public function update($source)
    {
        $this->validateRepositoryPath($source, 'source');

        $currentWorkingDirectory = getcwd();
        chdir($source);
        $return = $this->execute('/usr/bin/env git pull');
        chdir($currentWorkingDirectory);

        return $return;
    }

    /**
     * @throws InvalidSystemEnvironmentException
     */
    public function validateSystemEnvironment()
    {
        if (!is_executable('/usr/bin/git')) {
            throw new InvalidSystemEnvironmentException(
                '/usr/bin/git is mandatory'
            );
        }
    }

    /**
     * @param string $path
     * @param string $identifier
     */
    private function validateRepositoryPath($path, $identifier = 'source')
    {

        if (!is_writable($path)
            || !is_dir($path)) {
            throw new RuntimeException(
                'given ' . $identifier . ' needs to be a writable directory'
            );
        }
    }
}