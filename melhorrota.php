<!DOCTYPE html>
<html>
  <head>
    <title>Distance Matrix Service</title>
    <script src="https://polyfill.io/v3/polyfill.min.js?features=default"></script>
    <link rel="stylesheet" type="text/css" href="./style.css" />
    <script src="./index.js"></script>
    <?php
      //Define o endereço inicial
      $endereco_inicial=str_replace(" ", "", "Avenida Dr. Gastão Vidigal, 1132 - Vila Leopoldina");
      // Cria as variaveis $destino1, $destino2, etc, de acordo com o número de endereços passados via $_GET.
      for ($i=1; $i<=count($_GET); $i++){
        ${"destino$i"} = $_GET["endereco$i"];
      }
      //echo $destino1;
      //echo $destino4;
      ?>
  </head>
  <body>
    <script>
      function initMap() {
      const bounds = new google.maps.LatLngBounds();
      const markersArray = [];
      const map = new google.maps.Map(document.getElementById("map"), {
        center: { lat: 55.53, lng: 9.4 },
        zoom: 10,
      });
      // initialize services
      const geocoder = new google.maps.Geocoder();
      const service = new google.maps.DistanceMatrixService();
      // cria requisicao
      const origin1 = "<?php echo $endereco_inicial; ?>";
      for (var i = 1; i <= <?php echo count($_GET);?>; i++) {
        const destination 'Hello, ${name}';
      }
      const destinationA = "Stockholm, Sweden";
      const destinationB = "";
      const request = {
        origins: [origin1],
        destinations: [destinationA, destinationB],
        travelMode: google.maps.TravelMode.DRIVING,
        unitSystem: google.maps.UnitSystem.METRIC,
        avoidHighways: false,
        avoidTolls: false,
      };
    
      // put request on page
      document.getElementById("request").innerText = JSON.stringify(
        request,
        null,
        2
      );
      // get distance matrix response
      service.getDistanceMatrix(request).then((response) => {
        // put response
        document.getElementById("response").innerText = JSON.stringify(
          response,
          null,
          2
        );
    
        // show on map
        const originList = response.originAddresses;
        const destinationList = response.destinationAddresses;
    
        deleteMarkers(markersArray);
    
        const showGeocodedAddressOnMap = (asDestination) => {
          const handler = ({ results }) => {
            map.fitBounds(bounds.extend(results[0].geometry.location));
            markersArray.push(
              new google.maps.Marker({
                map,
                position: results[0].geometry.location,
                label: asDestination ? "D" : "O",
              })
            );
          };
          return handler;
        };
    
        for (let i = 0; i < originList.length; i++) {
          const results = response.rows[i].elements;
    
          geocoder
            .geocode({ address: originList[i] })
            .then(showGeocodedAddressOnMap(false));
    
          for (let j = 0; j < results.length; j++) {
            geocoder
              .geocode({ address: destinationList[j] })
              .then(showGeocodedAddressOnMap(true));
          }
        }
      });
    }
    
    function deleteMarkers(markersArray) {
      for (let i = 0; i < markersArray.length; i++) {
        markersArray[i].setMap(null);
      }
    
      markersArray = [];
    }
    </script>
    <div id="container">
      <div id="map"></div>
      <div id="sidebar">
        <h3 style="flex-grow: 0">Request</h3>
        <pre style="flex-grow: 1" id="request"></pre>
        <h3 style="flex-grow: 0">Response</h3>
        <pre style="flex-grow: 1" id="response"></pre>
      </div>
    </div>

    <!-- Async script executes immediately and must be after any DOM elements used in callback. -->
    <script
      src="https://maps.googleapis.com/maps/api/js?key=AIzaSyD7u0NnHbPwL5vOjrfX8-cL_aiioPftVLc&callback=initMap&v=weekly"
      async
    ></script>
  </body>
</html>