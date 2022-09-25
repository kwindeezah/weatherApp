<?php
    $weather = "";
    $error = "";
     
    if ($_GET['city']) {
         
     $urlContents = file_get_contents("http://api.openweathermap.org/data/2.5/weather?q=".urlencode($_GET['city']).",&appid=46ee41bc4c146b691f592a88969959b3");
         
        $weatherArray = json_decode($urlContents, true);
         
        if ($weatherArray['cod'] == 200) {
         
            $weather = "The weather in ".$_GET['city']." is currently '".$weatherArray['weather'][0]['description']."'. ";
 
            $tempInCelcius = intval($weatherArray['main']['temp'] - 273);
 
            $weather .= " The temperature is ".$tempInCelcius."&deg;C and the wind speed is ".$weatherArray['wind']['speed']."m/s.";
             
        } else {
             
            $error = "Could not find city - please try again.";
             
        }
         
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>Weather App</title>

    <style type="text/css">
        html { 
            background: url(weather.jpg) no-repeat center center fixed; 
            -webkit-background-size: cover;
            -moz-background-size: cover;
            -o-background-size: cover;
            background-size: cover;
        }
   
        body {
         
            background: none;
         
        }
     
        .container {
         
            text-align: center;
            color: white;
            margin-top: 100px;
            width: 450px;
         
        }
     
        input {
         
            margin: 20px 0;
         
        }
     
        #weather {
         
            margin-top:15px;
         
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>What's The Weather?</h1>
        <form action="" method="get">
            <fieldset class="form-group">
              <label for="city">Enter the name of a city.</label>
              <input type="text" class="form-control" name="city" id="city" placeholder="Eg. London, Tokyo" value = "<?php echo $_GET['city']; ?>">
            </fieldset>
             
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
        <div id="weather"><?php
              if ($weather) {
                  echo '<div class="alert alert-success" role="alert">
  '.$weather.'</div>';     
              } else if ($error) {
                  echo '<div class="alert alert-danger" role="alert">
  '.$error.'</div>';    
              }
        ?></div>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.2/js/bootstrap.min.js" integrity="sha384-vZ2WRJMwsjRMW/8U7i6PWi6AlO1L79snBrmgiDpgIWJ82z8eA5lenwvxbMV1PAh7" crossorigin="anonymous"></script>
</body>
</html>