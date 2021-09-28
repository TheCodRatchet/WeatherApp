<?php

require_once "vendor/autoload.php";

use App\WeatherContents;
use App\ContentHandling;

?>

<form method="post">
    <label for="name">Enter location:</label><br>
    <input type="text" id="name" name="name"><br>
    <input type="submit" name="submit" value="Search">
</form>

<?php
$weather = null;
$content = null;

if (isset($_POST['submit'])) {
    if (file_get_contents("http://api.weatherapi.com/v1/forecast.json?key=ed93b22b0d204631b6381246212809&q={$_POST['name']}&days=3")) {
        $weather = new WeatherContents("http://api.weatherapi.com/v1/forecast.json?key=ed93b22b0d204631b6381246212809&q={$_POST['name']}&days=3",
            "http://api.weatherapi.com/v1/timezone.json?key=ed93b22b0d204631b6381246212809&q={$_POST['name']}");
        $content = new ContentHandling($weather->getWeather(), $weather->getTimeZone());
    } else {
        echo "Location not found";
    }
}

$date = date('Y-m-d H:i')
?>


<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">
    <title>Daniels Weather App</title>
</head>
<body>
<section class="vh-100" style="background-color: #cdc4f9;">
    <div class="container py-5 h-100">
        <div class="row d-flex justify-content-center align-items-center h-100">
            <div class="col-md-12 col-xl-10">

                <div class="card shadow-0 border border-dark border-5 text-dark" style="border-radius: 10px;">
                    <div class="card-body p-4">

                        <div class="row text-center">
                            <div class="col-md-9 text-center border-end border-5 border-dark py-4"
                                 style="margin-top: -1.5rem; margin-bottom: -1.5rem;">
                                <div class="d-flex justify-content-around mt-3">
                                    <p class="small"><?php echo "{$content->getCountry()}, {$content->getCity()}" ?></p>
                                    <p class="small"><?php echo $content->getDate()[0] ?></p>
                                    <p class="small">Today's average</p>
                                </div>
                                <div class="d-flex justify-content-around align-items-center py-5 my-4">
                                    <p class="fw-bold mb-0"
                                       style="font-size: 7rem;"><?php echo $content->getTemperature()[0] . "°C" ?></p>
                                    <div class="text-start">
                                        <img src="<?php echo $content->getConditionPicture()[0] ?>">
                                        <p class="small mb-0"><?php echo $content->getConditionText()[0] ?></p>
                                    </div>
                                </div>
                                <div class="d-flex justify-content-around align-items-center mb-3">
                                    <div class="flex-column">
                                        <i class="fas fa-minus"></i>
                                    </div>
                                    <div class="flex-column border" style="border-radius: 10px; padding: .75rem">
                                        <p class="small mb-0">
                                            <img src="<?php echo $content->getConditionPicture()[0] ?>">
                                            <strong><?php echo $content->getTemperature()[0] . "°C" ?></strong></p>
                                    </div>
                                    <div class="flex-column">
                                        <p class="small mb-0">
                                            <img src="<?php echo $content->getConditionPicture()[1] ?>">
                                            <strong><?php echo $content->getTemperature()[1] . "°C" ?></strong></p>
                                    </div>
                                    <div class="flex-column">
                                        <p class="small mb-0">
                                            <img src="<?php echo $content->getConditionPicture()[2] ?>">
                                            <strong><?php echo $content->getTemperature()[2] . "°C" ?></strong></p>
                                    </div>
                                    <div class="flex-column">
                                        <i class="fas fa-minus"></i>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3 text-end">
                                <p class="small mt-3 mb-5 pb-5">For Today</p>
                                <p class="pb-1"><span class="pe-2"></span> <strong></strong></p>
                                <p class="pb-1"><span class="pe-2"><?php echo $content->getHour(0) ?></span>
                                    <strong><?php echo $content->getHourTemperature(0) . "°C" ?></strong>
                                    <img src="<?php echo $content->getHourPicture(0) ?>"></p>
                                <p class="pb-1"><span class="pe-2"><?php echo $content->getHour(1) ?></span>
                                    <strong><?php echo $content->getHourTemperature(1) . "°C" ?></strong>
                                    <img src="<?php echo $content->getHourPicture(1) ?>"></p>
                                <p class="pb-1"><span class="pe-2"><?php echo $content->getHour(2) ?></span>
                                    <strong><?php echo $content->getHourTemperature(2) . "°C" ?></strong>
                                    <img src="<?php echo $content->getHourPicture(2) ?>"></p>
                                <p class="pb-1"><span class="pe-2"><?php echo $content->getHour(3) ?></span>
                                    <strong><?php echo $content->getHourTemperature(3) . "°C" ?></strong>
                                    <img src="<?php echo $content->getHourPicture(3) ?>"></p>
                                <p class="pb-1"><span class="pe-2"><?php echo $content->getHour(4) ?></span>
                                    <strong><?php echo $content->getHourTemperature(4) . "°C" ?></strong>
                                    <img src="<?php echo $content->getHourPicture(4) ?>"></p>
                                <p><span class="pe-2"><?php echo $content->getHour(5) ?></span>
                                    <strong><?php echo $content->getHourTemperature(5) . "°C" ?></strong>
                                    <img src="<?php echo $content->getHourPicture(5) ?>"></p>
                            </div>
                        </div>

                    </div>
                </div>

            </div>
        </div>
    </div>
</section>
</body>
</html>
