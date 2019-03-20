<?php

namespace TrainjunkiesPackages\StaticDataFeeds\NetworkRail\Schedule;

use Psr\Http\Message\ResponseInterface;

class DownloadHandler
{
    private $length;

    public function __construct($length = 1024)
    {
        $this->length = $length;
    }

    public function handleDownload(ResponseInterface $response, callable $function)
    {
        $body = $response->getBody();

        while (!$body->eof()) {
            $function(
                $body->read($this->length)
            );
        }
    }
}
