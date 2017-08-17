<!DOCTYPE html>
<html lang="ru">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=Edge">
  <link href="https://fonts.googleapis.com/css?family=Roboto:400,900&amp;subset=cyrillic" rel="stylesheet">
  <link rel="stylesheet" href="style.css">
  <title>Document</title>
</head>
<body>
  <div class="wrapper">
   <!--  <a href="http://less4.loc/www">Главная</a> -->
    <br>
    <?php   

    $userCity = $_GET["city"];

    if ($userCity === NULL) {
      $userCity = "Москва";
    }

    $owAPI = "http://api.openweathermap.org/data/2.5/weather?q=" . $userCity . "&units=metric&lang=ru&appid=aa334c49b122b042d7b3f9bbde33f488";
    $getWeather = file_get_contents($owAPI);
    $json = json_decode($getWeather, TRUE);

    $roundTemp = $json["main"]["temp"];
    $pressure = $json["main"]["pressure"] . " мм рт. ст.";
    $wind = $json["wind"]["speed"] . " м/с";
    $humidity = $json["main"]["humidity"] . "%";
    $sunrise = $json["sys"]["sunrise"];
    $sunset = $json["sys"]["sunset"];

    $currentMainWeather = "Сейчас в $json[name] " . $json["weather"][0]["description"] . ". " . "Температура: " . round($roundTemp) . "&#8451;";

    ?>  
    
      <h1 class="labelHeader">Какие стихии буйствуют <br>в твоём городе?</h1>
    
      <form>
        <input class="cityInput" type="text" name="city" id="" placeholder="Введите город...">
        <input class="submitBtn" type="submit" value="Узнать">
      </form>
      <div class="weatherResultMain">
        <p><?php echo $currentMainWeather . "."?></p>
      </div>
      <div class="weatherResultExtra">
        <p><span class="bold">Насколько влажно? Вот настолько:</span> <?= $humidity ?></p>
        <p><span class="bold">Давленьице:</span> <?= $pressure ?></p>
        <p><span class="bold">Ветрище:</span> <?= $wind ?> <span class="wind">💨</span> <span class="cat">😺</span></p>
        <p><span class="bold">Сегодня солнышко встало в:</span> <?= date("G:i", $sunrise) ?></p>
        <p><span class="bold">А закат в:</span> <?= date("G:i", $sunset) ?></p>
      </div>


      
  </div>

  <script>
    var cityInput = document.querySelector(".cityInput");

    cityInput.addEventListener("click", function(event) {
    event.preventDefault();
    cityInput.removeAttribute("placeholder");
    
    });
  </script>
    
</body>
</html>
