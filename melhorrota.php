<!DOCTYPE html>
<html>
  <head>
    <title>Waypoints in Directions</title>
    <script src="https://polyfill.io/v3/polyfill.min.js?features=default"></script>
    <link rel="stylesheet" type="text/css" href="./style_melhorrota.css" />
  </head>
  <body>
      <?php
      //Define o endereço inicial
      $endereco_inicial=str_replace(" ", "", "Avenida Dr. Gastão Vidigal, 1132 - Vila Leopoldina");
      //echo $endereco_inicial;
      //cria o array waypoints de acrodo com o passado via $_GET
        for ($i=1; $i<=(count($_GET)-1); $i++){
            $waypoints[$i] = $_GET["endereco$i"];
            //echo $destino[$i];
        }
        $valor_waypoints=array_values($waypoints);
        //transforma o array $waypoints em um Json
        $waypoints_transformado = json_encode($valor_waypoints, JSON_UNESCAPED_UNICODE);
      
        //endereco mais distante - final
        $distante=$_GET["endereco_mais_distante"];
        //echo $distante;
        ?>
    <div id="container">
      <div id="map"></div>
      <div id="sidebar">
        <div>
          <b>Start:</b>
          <select id="start">
            <option value="Avenida Dr. Gastão Vidigal, 1132 - Vila Leopoldina">Avenida Dr. Gastão Vidigal, 1132 - Vila Leopoldina</option>
          </select>
          <br />
          <b>Waypoints:</b> <br />
          <i>(Ctrl+Click para selecionar vários Waypoints)</i> <br />
          <select multiple id="waypoints">
            <?php
              for ($j=1; $j<=(count($_GET)-1); $j++){
                echo "<option value='".$waypoints[$j]."'>".$waypoints[$j]."</option>";
              }
            ?>
          </select>
          <br />
          <b>End:</b>
          <select id="end">
            <option value="<?php echo $distante; ?>"><?php echo $distante; ?></option>
          </select>
          <br />
          <input type="submit" id="submit" />
        </div>
        <div id="directions-panel"></div>
      </div>
    </div>

    <script>   
function initMap() {
  const directionsService = new google.maps.DirectionsService();
  const directionsRenderer = new google.maps.DirectionsRenderer();
  const map = new google.maps.Map(document.getElementById("map"), {
    zoom: 6,
    center: { lat: 41.85, lng: -87.65 },
  });

  directionsRenderer.setMap(map);
  document.getElementById("submit").addEventListener("click", () => {
    calculateAndDisplayRoute(directionsService, directionsRenderer);
  });
}

function calculateAndDisplayRoute(directionsService, directionsRenderer) {
  const waypts = [];
  const checkboxArray = document.getElementById("waypoints");

  for (let i = 0; i < checkboxArray.length; i++) {
    if (checkboxArray.options[i].selected) {
      waypts.push({
        location: checkboxArray[i].value,
        stopover: true,
      });
    }
  }

  directionsService
    .route({
      origin: document.getElementById("start").value,
      destination: document.getElementById("end").value,
      waypoints: waypts,
      optimizeWaypoints: true,
      travelMode: google.maps.TravelMode.DRIVING,
    })
    .then((response) => {
      directionsRenderer.setDirections(response);

      const route = response.routes[0];
      const summaryPanel = document.getElementById("directions-panel");

      summaryPanel.innerHTML = "";

      // For each route, display summary information.
      for (let i = 0; i < route.legs.length; i++) {
        const routeSegment = i + 1;

        summaryPanel.innerHTML +=
          "<b>Route Segment: " + routeSegment + "</b><br>";
        summaryPanel.innerHTML += route.legs[i].start_address + " to ";
        summaryPanel.innerHTML += route.legs[i].end_address + "<br>";
        summaryPanel.innerHTML += route.legs[i].distance.text + "<br><br>";
      }
    })
    .catch((e) => window.alert("Directions request failed due to " + status));
}
</script>

    <!-- Async script executes immediately and must be after any DOM elements used in callback. -->
    <script
      src="https://maps.googleapis.com/maps/api/js?key=AIzaSyD7u0NnHbPwL5vOjrfX8-cL_aiioPftVLc&callback=initMap&v=weekly"
      async
    ></script>
  </body>
</html>