<?php
/**
 * @author stev leibelt <artodeto@bazzline.net>
 * @since 2015-09-12
 */
namespace Net\Bazzline\Component\CommandCollection\Http;

use Net\Bazzline\Component\Command\AbstractCommand;
use Net\Bazzline\Component\Command\InvalidSystemEnvironmentException;
use Net\Bazzline\Component\Command\RuntimeException;

class Curl extends AbstractCommand
{
    /** @var string */
    private $prefix = '';

    /** @var bool */
    private $isJson = false;

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
        $this->isJson   = true;
        $this->prefix  .= ' -H "Accept: application/json" -H "Content-Type: application/json"';
    }

    public function noSslSecurity()
    {
        $this->prefix .= ' --insecure';
    }

    public function noSslRevoke()
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
     * @param null|mixed $data
     * @return array
     */
    public function delete($host, $url, $data = null)
    {
        return $this->send($host, $url, 'DELETE', $data);
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
        $content    = '';
        $target     = $host . str_replace('%2F', '/', urlencode($url));

        if (!is_null($data)) {
            if ($this->isJson) {
                $content .= ' -d \'' . json_encode($data) . '\'';
            } else {
                if (is_array($data)) {
                    foreach ($data as $key => $value) {
                        $content .= ' -d ' . $key . '="' . $value . '"';
                    }
                } else {
                    $content .= ' -d ' . $data;
                }
            }
        }

        $command       .= $arguments . ' -X ' . $method . $content . ' ' . $target;
        $this->isJson   = true;
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
