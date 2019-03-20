<?php

namespace TrainjunkiesPackages\NetworkRailScheduleDownloader\NetworkRail\Schedule;

class TOC
{
    private $code;

    private function __construct($code)
    {
        if (!preg_match('/^[A-Z]{2}$/', $code)) {
            throw new \InvalidArgumentException(
                sprintf('TOC code (%s) is not a valid format', $code)
            );
        }

        $this->code = $code;
    }

    public static function fromCode($code)
    {
        return new self($code);
    }

    public function full()
    {
        return sprintf('CIF_%s_TOC_FULL_DAILY', $this->code);
    }

    public function update()
    {
        return sprintf('CIF_%s_TOC_UPDATE_DAILY', $this->code);
    }
}
