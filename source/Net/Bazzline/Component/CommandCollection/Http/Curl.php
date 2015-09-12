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

    /**
     * @param string $url
     * @param string $method
     * @param null|mixed $data
     * @return array
     * @throws RuntimeException
     */
    public function __invoke($url, $method, $data = null)
    {
        return $this->send($url, $method, $data);
    }


    public function beSilent()
    {
        $this->prefix .= ' -s';
    }

    public function isJson()
    {
        $this->prefix .= ' -H "Accept: application/json" -H "Content-Type: application/json"';
    }

    public function noSslSecurity()
    {
        $this->prefix .= ' --ssl-no-revoke';
    }

    /**
     * @param string $header
     */
    public function addHeader($header)
    {
        $this->prefix .= ' -H "' . $header . '"';
    }

    /**
     * @param string $host
     * @param string $url
     * @return array
     */
    public function delete($host, $url)
    {
        return $this->send($host, $url, 'DELETE');
    }

    /**
     * @param string $host
     * @param string $url
     * @return array
     */
    public function get($host, $url)
    {
        return $this->send($host, $url, 'GET');
    }

    /**
     * @param string $host
     * @param string $url
     * @param null|mixed $data
     * @return array
     */
    public function post($host, $url, $data = null)
    {
        return $this->send($host, $url, 'POST', $data);
    }

    /**
     * @param string $host
     * @param string $url
     * @param null|mixed $data
     * @return array
     */
    public function put($host, $url, $data = null)
    {
        return $this->send($host, $url, 'PUT', $data);
    }

    /**
     * @param string $host
     * @param string $url
     * @param string $method
     * @param null|mixed $data
     * @return array
     * @throws RuntimeException
     * @todo implement parameter validation
     * @todo add noUrlEncode option
     */
    public function send($host, $url, $method, $data = null)
    {
        $arguments  = $this->prefix;
        $command    = '/usr/bin/curl';
        $target     = $host . str_replace('%2F', '/', urlencode($url));

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

        $command       .= $arguments . ' -X ' . $method . ' ' . $target;
        $this->prefix   = '';

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