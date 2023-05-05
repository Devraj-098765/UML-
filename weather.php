<?php

    //create the connection
    $conn = mysqli_connect("localhost","root","","weather");
    if (mysqli_error($conn)) {
        die("Error in query: " . mysqli_error($conn));
    }
    $apikey="f3d44717a14140b7ad16a6c7c649fb55";
    $city="Ontario";
    //fetch from api
    $json_data=file_get_contents("https://api.openweathermap.org/data/2.5/weather?q=".$city."&units=metric&appid=".$apikey);
    //convert into json format
    $data = json_decode($json_data,true);
    //access the data 
    $city = $data['name'];
    $temp = $data['main']['temp'];
    $humidity = $data['main']['humidity'];
    $wind_speed =$data['wind']['speed'];
    $pressure = $data['main']['pressure'];
    $timestamp = $data['dt'];
    $date = gmdate("Y-m-d\TH:i:s\Z", $timestamp);
    //echo "$date";
    //query 
    $sql = "INSERT INTO weather(city,temperature,humidity,pressure,wind_speed,datetime,id) VALUES('$city','$temp','$humidity','$pressure','$wind_speed','$date','1')";
    //echo "$sql";
    //run the query
    mysqli_query($conn,$sql);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>devraj khatri</title>
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="./devrajkhatri-2329460.css">
    <script src="./devrajkhatri-2329460.js" defer></script>
</head>
<body>
    <h1 class="top">Weather forecast</h1>
    <div class="one">
        <div class="day1">
            <div class="card">
                <div class="weather loading">
                    <h2 class="city">Weather in Ontario</h2>
                    <h1 class="temp"><?php echo $data['temperature']; ?>°C</h1>
                    <div class="flex">
                        <img src="https://openweathermap.org/img/wn/04n.png" alt="" class="icon" />
                        <div class="description">Cloudy</div>
                    </div>
                    <div class="humidity">Humidity: 60%</div>
                    <div class="wind">Wind speed: 6.2 km/h</div>
                    <p class="time"></p>
                </div>
            </div>
        </div>
    </div>
    <div class="search">
        <input type="text" class="search-bar" placeholder="Search">
        <button>
            <svg stroke="currentColor" fill="currentColor" stroke-width="0" viewBox="0 0 1024 1024" height="1.5em" width="1.5em" xmlns="http://www.w3.org/2000/svg">
            <path
              d="M909.6 854.5L649.9 594.8C690.2 542.7 712 479 712 412c0-80.2-31.3-155.4-87.9-212.1-56.6-56.7-132-87.9-212.1-87.9s-155.5 31.3-212.1 87.9C143.2 256.5 112 331.8 112 412c0 80.1 31.3 155.5 87.9 212.1C256.5 680.8 331.8 712 412 712c67 0 130.6-21.8 182.7-62l259.7 259.6a8.2 8.2 0 0 0 11.6 0l43.6-43.5a8.2 8.2 0 0 0 0-11.6zM570.4 570.4C528 612.7 471.8 636 412 636s-116-23.3-158.4-65.6C211.3 528 188 471.8 188 412s23.3-116.1 65.6-158.4C296 211.3 352.2 188 412 188s116.1 23.2 158.4 65.6S636 352.2 636 412s-23.3 116.1-65.6 158.4z">
            </path>
          </svg>
        </button>
      </div>
</body>

</html>