<?php

$weather = "";
$error = "";

if(array_key_exists('city', $_GET)){

    $city = str_replace(' ', '', $_GET['city']);

    $file_headers = @get_headers("https://www.weather-forecast.com/locations/".$city."/forecasts/latest");
if($file_headers[0] == 'HTTP/1.1 404 Not Found') {
            
            
            $error = "Sorry the city could not be found.";
            
        } else {


$arrContextOptions=array(
    "ssl"=>array(
        "verify_peer"=>false,
        "verify_peer_name"=>false,
    ),
);  

$response = file_get_contents("https://www.weather-forecast.com/locations/".$city."/forecasts/latest", false, stream_context_create($arrContextOptions));

$pageArray = explode('(1&ndash;3 days)</div><p class="b-forecast__table-description-content"><span class="phrase">',$response);

    if(sizeof($pageArray) > 1){
    $secondPageArray = explode('</span></p></td>', $pageArray[1]);

    if(sizeof($secondPageArray) > 1){

    $weather = $secondPageArray[0];

    } else {
        $error = "Sorry the city could not be found.";
    }

    } else {
        $error = "Sorry the city could not be found.";
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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">

    <title>Weather Scraper</title>

    <style type="text/css">
        html { 
  background: url(background.jpg) no-repeat center center fixed; 
  -webkit-background-size: cover;
  -moz-background-size: cover;
  -o-background-size: cover;
  background-size: cover;
}

body{
    background: none;
}

.container{
    text-align: center;
    margin-top: 100px;
    width: 500px;
}

input{
    margin: 10px 0;
}

#weather{
    margin-top : 15px;
}

</style>
  </head>
  <body>
    
  <div class="container">
    <h1>How's The Weather?</h1>
    <p></p>
    <form>
  <div class="form-group">
    <label for="city">Enter the name of the city</label>
    <input type="text" class="form-control"  name="city" id="city" placeholder="Eg. Mumbai, Madurai" value="<?php 
    
    if(array_key_exists('city', $_GET)){
    
    
    echo $_GET['city']; 
    
    }
    
    
    
    
    ?>">
  </div>
  <button type="submit" class="btn btn-primary">Submit</button>
</form>
    <div id="weather">
    <?php 
        if($weather) {
            echo  '<div class="alert alert-success" role="alert">'.$weather.'</div>';
        } else if($error){
            echo  '<div class="alert alert-danger" role="alert">'.$error.'</div>';
        }

    ?>
</div>

</div>

    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: jQuery and Bootstrap Bundle (includes Popper) -->
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-fQybjgWLrvvRgtW6bFlB7jaZrFsaBXjsOMm/tB9LTS58ONXgqbR9W8oWht/amnpF" crossorigin="anonymous"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.min.js" integrity="sha384-VHvPCCyXqtD5DqJeNxl2dtTyhF78xXNXdkwX1CZeRusQfRKp+tA7hAShOK/B/fQ2" crossorigin="anonymous"></script>
    -->
    
  </body>
</html>