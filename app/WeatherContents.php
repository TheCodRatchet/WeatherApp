<?php

namespace App;

class WeatherContents
{
    private string $weather;
    private string $timeZone;

    public function __construct(string $filename, string $filename2)
    {
        $this->weather = file_get_contents($filename);
        $this->timeZone = file_get_contents($filename2);
    }

    public function getWeather(): string
    {
        return $this->weather;
    }

    public function getTimeZone(): string
    {
        return $this->timeZone;
    }
}