<?php

namespace TrainjunkiesPackages\NetworkRailScheduleDownloader\NetworkRail;

class Authentication
{
    /**
     * @var string
     */
    private $username;

    /**
     * @var string
     */
    private $password;

    private function __construct($username = '', $password = '')
    {
        if (strlen($username) === 0 || strlen($password) === 0) {
            throw new \Exception('Please provide Network Rail Datafeeds username and/or password');
        }

        $this->username = $username;
        $this->password = $password;
    }

    public static function fromUsernameAndPassword($username, $password)
    {
        return new self($username, $password);
    }

    public function username()
    {
        return $this->username;
    }

    public function password()
    {
        return $this->password;
    }
}
