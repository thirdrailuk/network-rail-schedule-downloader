<?php

namespace Trainjunkies\StaticDataFeeds\Exception;

class NetworkRailException extends \Exception
{
    public static function unauthorized(
        $requestedFile,
        \Exception $previousException
    ) {
        $message = sprintf(
            'Unable to download file: "%s", Do you have the correct permission to download?',
            $requestedFile
        );

        return new self(
            $message,
            $previousException->getCode(),
            $previousException
        );
    }
}
