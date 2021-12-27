<!DOCTYPE html>
<html>
  <head>
    <title>Mostra o Endereço</title>

    <?php
      $endereco=$_GET["endereco"];
      //Transforma o endereco escrito e obtêm o JSON e obtém a latitude e longitude.
      // ini_set("allow_url_fopen", 1);
        $json = file_get_contents('https://maps.googleapis.com/maps/api/geocode/json?address='.$endereco.'&key=AIzaSyD7u0NnHbPwL5vOjrfX8-cL_aiioPftVLc');
        $data = json_decode($json, true);

        //echo $data['results'][0]['geometry']['location']['lat']; // -1.400045
        //echo $data['results'][0]['geometry']['location']['lng']; // -48.488917
    ?>

    <link rel="stylesheet" type="text/css" href="./style.css" />
    <script>
        // Inicializa e adiciona o mapa.
        function initMap() {
          // A localização de do endereço do usuário
          const localizacao = { lat: <?php echo $data['results'][0]['geometry']['location']['lat']; ?>, lng: <?php echo $data['results'][0]['geometry']['location']['lng']; ?> };
          // The map, centralizado em localizacao
          const map = new google.maps.Map(document.getElementById("map"), {
            zoom: 17,
            center: localizacao,
          });
          // O marcador, posicionado no endereço informado
          const marker = new google.maps.Marker({
            position: localizacao,
            map: map,
          });
        }
    </script>
  </head>
  <body>
    <h3>Endereço no mapa</h3>
    <!--O elemento div do mapa -->
    <div id="map"></div>

    <!-- Async script executes immediately and must be after any DOM elements used in callback. -->
    <script
      src="https://maps.googleapis.com/maps/api/js?key=AIzaSyD7u0NnHbPwL5vOjrfX8-cL_aiioPftVLc&callback=initMap&libraries=&v=weekly"
      async
    ></script>
  </body>
</html>