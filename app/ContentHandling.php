<?php

namespace App;

class ContentHandling
{
    private \stdClass $content;
    private \stdClass $timeZone;

    public function __construct(string $file, string $file2)
    {
        $this->content = json_decode($file);
        $this->timeZone = json_decode($file2);
    }

    public function getCity(): string
    {
        return $this->content->location->name;
    }

    public function getCountry()
    {
        return $this->content->location->country;
    }

    public function getDate(): array
    {
        $dates = [];
        foreach ($this->content->forecast->forecastday as $day) {
            $dates[] = $day->date;
        }
        return $dates;
    }

    public function getTemperature(): array
    {
        $temperatures = [];
        foreach ($this->content->forecast->forecastday as $days) {
            $temperatures[] = $days->day->avgtemp_c;
        }
        return $temperatures;
    }

    public function getConditionText(): array
    {
        $condition = [];
        foreach ($this->content->forecast->forecastday as $days) {
            $condition[] = $days->day->condition->text;
        }
        return $condition;
    }

    public function getConditionPicture(): array
    {
        $condition = [];
        foreach ($this->content->forecast->forecastday as $days) {
            $condition[] = $days->day->condition->icon;
        }
        return $condition;
    }

    public function getHour(int $offset): string
    {
        $searchHours = null;
        $days = $this->content->forecast->forecastday[0];
        foreach ($days->hour as $hours) {
            $times = (int)substr($hours->time, -5, 2);
            $currentTime = (int)substr($this->timeZone->location->localtime, -5, 2);
            if ($times - $offset == $currentTime) {
                $searchHours = substr($hours->time, -5);
            }
        }
        return $searchHours;
    }

    public function getHourTemperature(int $offset): string
    {
        $searchTemperature = null;
        $days = $this->content->forecast->forecastday[0];
        foreach ($days->hour as $hours) {
            $times = (int)substr($hours->time, -5, 2);
            $currentTime = (int)substr($this->timeZone->location->localtime, -5, 2);
            if ($times - $offset == $currentTime) {
                $searchTemperature = $hours->temp_c;
            }
        }
        return $searchTemperature;
    }

    public function getHourPicture(int $offset): string
    {
        $searchPicture = null;
        $days = $this->content->forecast->forecastday[0];
        foreach ($days->hour as $hours) {
            $times = (int)substr($hours->time, -5, 2);
            $currentTime = (int)substr($this->timeZone->location->localtime, -5, 2);
            if ($times - $offset == $currentTime) {
                $searchPicture = $hours->condition->icon;
            }
        }
        return $searchPicture;
    }
}