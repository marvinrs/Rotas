<!DOCTYPE html>
<html>
  <head>
    <title>Distance Matrix Service</title>
    <script src="https://polyfill.io/v3/polyfill.min.js?features=default"></script>
    <link rel="stylesheet" type="text/css" href="./style_calcula_melhor_distancia.css" />
    <script src="./index.js"></script>
    <?php
      //Define o endereço inicial
      $endereco_inicial=str_replace(" ", "", "Avenida Dr. Gastão Vidigal, 1132 - Vila Leopoldina");
      // Cria as variaveis $destino1, $destino2, etc, de acordo com o número de endereços passados via $_GET.
      for ($i=1; $i<=count($_GET); $i++){
        $destino[$i] = $_GET["endereco$i"];
        //echo $destino[$i];
      }
      $valor_destino=array_values($destino);
      //transforma o array $destino em um Json
      $destino_transformado = json_encode($valor_destino, JSON_UNESCAPED_UNICODE);
      //for ($i=1; $i<=count($_GET); $i++){
      //  ${"destino$i"} = $_GET["endereco$i"];
      //}
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
      //pega a variavel destino_transformado em JSON e transforma em uma variavel javascript
      var destino_do_php = <?php echo $destino_transformado; ?>;   
      const request = {
        origins: [origin1],
        destinations: destino_do_php,
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
        var maior_distancia = Number.parseInt(response.rows[0].elements[0].distance.text);
        var endereco_maior_distancia = "";
        
        for(var m=0; m<destino_do_php.length; m++){
          
          if(maior_distancia<Number.parseInt(response.rows[0].elements[m].distance.text)){
            maior_distancia=Number.parseInt(response.rows[0].elements[m].distance.text);
            var endereco_maior_distancia = destino_do_php[m];
            var index = m+1;
          }      
        }
        //temp=endereco_maior_distancia;
        //window.alert("a maior distancia é "+maior_distancia);
        ///window.alert(temp);
        document.cookie = endereco_maior_distancia;
        window.alert("o endereço mais distante é "+endereco_maior_distancia);
        //window.alert("o index do endereço mais distante é "+index);
        
        //window.alert(maior_distancia);

        //var maior_distancia="oi";
        //windows.alert("maior_distancia");
        //window.alert(response.rows[0].elements[0].distance.text);
    
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
      <?php
        $vetor_endereco_maior=[];
        $vetor_endereco_maior=array_keys($_COOKIE);
        //print_r($vetor_endereco_maior);
        //echo $vetor_endereco_maior[0];
      ?>
        <h3 style="flex-grow: 0"><button onclick='location.href="melhorrota.php?<?php $i=1; foreach($destino as $valor){if($valor==$vetor_endereco_maior[0]){ continue;} echo "endereco".$i."=".$valor."&"; $i++;}  echo "endereco_mais_distante=".$vetor_endereco_maior[0];?>"' type="button">Calcular Melhor Rota</button></h3>
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
    >
//converte variavel JS para PHP
function jstophp(){


  var javavar=document.getElementById("text").value;  

  document.getElementById("rslt").innerHTML="<?php 
  $phpvar='"+javavar+"'; 
  echo $phpvar;?>";
}
  </script>
  
  <script>
        </script>

    </body>
</html>

<?php 
           //$temp = "<script>document.write(index)</script>";
           
           //for($i=1;var_dump(count($_COOKIE)); $i++){
           //  $mais_distante=$_COOKIE[$i];
           //}
           //echo $mais_distante;
          //$_SESSION['maior_distancia'] = $mais_distante;
          ?>