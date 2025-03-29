<?php
if(array_key_exists('submit',$_GET)) {
    if(!$_GET['city']) {
        $error = "Sorry,your input field is empty";
    }
    if($_GET['city']) {
        $apiData = file_get_contents("https://api.openweathermap.org/data/2.5/weather?q=". $_GET['city']."&APPID=f5cc1847f208ddd6fc680a969760a10f");
        $weatherArray = json_decode($apiData,true);
        if($weatherArray['cod'] == 200) {
        //c=k -273.15
        $tempCelsius = $weatherArray['main']['temp'] -273;
        $weather ="<b> ".$weatherArray['name'].",".$weatherArray['sys']['country'].":".intval($tempCelsius)."&deg;C</b> <br>";
        $weather .="<b> Weather Condition:</b>" .$weatherArray['weather']['0']['description']."<br>";
        $weather .="<b> Atmosperic pressure:</b>" .$weatherArray['main']['pressure']."hpa<br>";
        $weather .="<b> Wind Speed:</b>" .$weatherArray['wind']['speed']."meter/sec<br>";
        $weather .="<b> Cloudness:</b>" .$weatherArray['clouds']['all']."%<br>";
        date_default_timezone_set('Asia/karachi');
        $sunrise = $weatherArray['sys']['sunrise'];
        $weather.="<b>sunrise: </b>" .date(" g:i a",$sunrise)."<br>";
        $weather.="<b>Current Time: </b>" .date(" F j, Y, g:i a",$sunrise);
        } else {
            $error = "cloud not be find, Your city name is not valid";
        }
    }
}
   
?>


<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

    <title>Weather App</title>
    <style>
        body {
            margin: 0px;
            padding: 0px;
            box-sizing: border-box;
            background-image: url("weather02.png.jpg");
            color: white;
            font-family: poppin, 'Times New Roman', Times, serif;
            font-size: large;
            background-size: cover;
            background-attachment: fixed;
        }
        .container {
            text-align: center;
            justify-content: center;
            align-items: center;
            width: 440px;
        }
        .h1 {
            font-weight: 700;
            margin-top: 150px;
        }
        .input {
            width: 350px;
            padding: 5px;
        }
    </style>
  </head>
  <body>
    <div class="container">
    <h1>Search Global Weather</h1>
    <form action="" method="GET">
        <p><label for="city">Enter your city Name</label></p>
        <p><input type="text"name="city" id="city" placeholder="city Name"></p>
        <button type="submit" name="submit" class="btn btn-success"> submit</button>
        <div class="output mt-3">
            <?php 
            if ($weather) {
                echo'<div class="alert alert-success" role="alert">'
            .$weather.
          '</div>';
            }
            //if ($error) {
            //    echo'<div class="alert alert-danger" role="alert">'
            //.$error.'</div>';
            //}
             ?>
        </div>
    </form>
    </div>
    

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
  </body>
</html>