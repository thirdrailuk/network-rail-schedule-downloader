<?php

namespace TrainjunkiesPackages\StaticDataFeeds\NetworkRail\Schedule;

class Day
{
    private $day;

    private $daysOrder = [
        'mon' => 'sun',
        'tue' => 'mon',
        'wed' => 'tue',
        'thu' => 'wed',
        'fri' => 'thu',
        'sat' => 'fri',
        'sun' => 'sat'
    ];

    private function __construct($day)
    {
        if (array_search($day, $this->daysOrder, true) === false) {
            throw new \InvalidArgumentException(
                sprintf(
                    '%s is not a valid day. [%s] are valid options',
                    $day,
                    implode(', ', $this->daysOrder)
                )
            );
        }

        $this->day = $day;
    }

    public static function fromDayString($day)
    {
        return new self($day);
    }

    public function __toString()
    {
        return sprintf('toc-update-%s', $this->daysOrder[$this->day]);
    }
}
