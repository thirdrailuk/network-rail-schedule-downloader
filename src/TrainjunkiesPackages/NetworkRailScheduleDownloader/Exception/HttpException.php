<?php

namespace TrainjunkiesPackages\NetworkRailScheduleDownloader\Exception;

class HttpException extends \Exception
{
    public static function httpError(\Exception $e)
    {
        return new self('HTTP Exception:' . $e->getMessage(), $e->getCode(), $e);
    }
}
