<!DOCTYPE html>
<html>
  <head>
    <title>Add Map</title>

    <?php
      //Transforma o endereco em uma string do PHP e mostra na tela a lat e lng
      // ini_set("allow_url_fopen", 1);
        $json = file_get_contents('https://maps.googleapis.com/maps/api/geocode/json?address=Rua%20Quarenta%20181%20Maracangalha&key=AIzaSyD7u0NnHbPwL5vOjrfX8-cL_aiioPftVLc');
        $data = json_decode($json, true);

        echo $data['results'][0]['geometry']['location']['lat']; // -1.400045
        echo $data['results'][0]['geometry']['location']['lng']; // -48.488917
    ?>

    <link rel="stylesheet" type="text/css" href="./style.css" />
    <script>
        // Inicializa e adiciona o Mapa
        function initMap() {
          // Seleciona o endereco do usuario com a latitude e longitude
          const casa = { lat: <?php echo $data['results'][0]['geometry']['location']['lat']; ?>, lng: <?php echo $data['results'][0]['geometry']['location']['lng']; ?> };
          // The map, centered at casa
          const map = new google.maps.Map(document.getElementById("map"), {
            zoom: 14,
            center: casa,
          });
          // The marker, positioned at Uluru
          const marker = new google.maps.Marker({
            position: casa,
            map: map,
          });
        }
    </script>
  </head>
  <body>
    <h3>My Google Maps Demo Casa</h3>
    <!--The div element for the map -->
    <div id="map"></div>

    <!-- Async script executes immediately and must be after any DOM elements used in callback. -->
    <script
      src="https://maps.googleapis.com/maps/api/js?key=AIzaSyD7u0NnHbPwL5vOjrfX8-cL_aiioPftVLc&callback=initMap&libraries=&v=weekly"
      async
    ></script>
  </body>
</html>