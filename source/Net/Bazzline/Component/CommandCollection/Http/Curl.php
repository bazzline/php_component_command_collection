<?php
/**
 * @author stev leibelt <artodeto@bazzline.net>
 * @since 2015-09-12
 */
namespace Net\Bazzline\Component\CommandCollection\Http;

use Net\Bazzline\Component\Command\Command;
use Net\Bazzline\Component\Command\InvalidSystemEnvironmentException;
use Net\Bazzline\Component\Command\RuntimeException;

class Curl extends Command
{
    /** @var string */
    private $prefix = '';

    public function isSilent()
    {
        $this->prefix .= ' -s';
    }

    public function noSslSecurity()
    {
        $this->prefix .= ' --ssl-no-revoke';
    }

    public function isJson()
    {
        $this->prefix .= ' -H "Accept: application/json" -H "Content-Type: application/json"';
    }

    /**
     * @param string $url
     * @return array
     */
    public function delete($url)
    {
        return $this->send($url, 'DELETE');
    }

    /**
     * @param string $url
     * @return array
     */
    public function get($url)
    {
        return $this->send($url, 'GET');
    }

    /**
     * @param string $url
     * @param null|mixed $data
     * @return array
     */
    public function post($url, $data = null)
    {
        return $this->send($url, 'POST', $data);
    }

    /**
     * @param string $url
     * @param null|mixed $data
     * @return array
     */
    public function put($url, $data = null)
    {
        return $this->send($url, 'PUT', $data);
    }

    /**
     * @param string $url
     * @param string $method
     * @param null|mixed $data
     * @return array
     * @throws RuntimeException
     * @todo implement parameter validation
     */
    public function send($url, $method, $data = null)
    {
        $arguments  = $this->prefix;
        $command    = '/usr/bin/curl';
        $encodedUrl = urlencode($url);

        if (!is_null($data)) {
            $arguments .= ' -d';
            if (is_array($data)) {
                foreach ($data as $key => $value) {
                    $arguments .= $key . '="' . $value . '"';
                }
            } else {
                $arguments .= $data;
            }
        }

        $command .= $arguments . ' -X ' . $method . ' ' . $encodedUrl;

        return $this->execute($command);
    }

    /**
     * @throws InvalidSystemEnvironmentException
     */
    public function validateSystemEnvironment()
    {
        if (!is_executable('/usr/bin/curl')) {
            throw new InvalidSystemEnvironmentException(
                '/usr/bin/curl is mandatory'
            );
        }
    }
}