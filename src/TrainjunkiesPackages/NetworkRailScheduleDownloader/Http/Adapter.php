<?php

namespace TrainjunkiesPackages\NetworkRailScheduleDownloader\Http;

interface Adapter
{
    const BASE_URI = 'https://datafeeds.networkrail.co.uk/ntrod/';

    public function get($uri, $params = [], $headers = []);
}
