<?php

use yii\helpers\Html;
// use yii\grid\GridView;
// use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Orders');
$this->params['breadcrumbs'][] = $this->title;
?>
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.6.0/dist/leaflet.css"
  integrity="sha512-xwE/Az9zrjBIphAcBb3F6JVqxf46+CDLwfLMHloNu6KEQCAWi6HcDUbeOfBIptF7tcCzusKFjFw2yuvEpDL9wQ=="
  crossorigin=""/>
<script src="https://unpkg.com/leaflet@1.6.0/dist/leaflet.js"
  integrity="sha512-gZwIG9x3wUXg2hdXF6+rVkLF/0Vi9U8D2Ntg4Ga5I5BZpVkVxlJWbSQtXPSiUTtC0TjtGOmxa1AJPuV0CPthew=="
  crossorigin=""></script>
  
<div class="row">
    <div class="">

        <h1><?= Html::encode($this->title) ?></h1>

        <p>
            <?= Html::a(Yii::t('app', 'Create Order'), ['create'], ['class' => 'btn btn-success']) ?>
        </p>

        <div class="col-md-6">
            <table class="table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th >First Name</th>
                        <th>Last Name</th>
                        <th>Date</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    
                        <?php foreach ($orders as $key => $order) { ?>
                            <tr>
                            <td><?= $key + 1 ?><td>
                            <td><?= $order->first_name ?><td>
                            <td><?= $order->last_name ?><td>
                            <td><?= $order->scheduled_date ?><td>
                            <td>
                                <select class="form-control">
                                    <?php foreach ($statuses as $status) { ?>
                                        <option 
                                        <?php echo $order->status_id === $status->id ? "selected" : ""; ?>
                                        ><?= $status->name ?></option>
                                    <?php } ?>

                                </select>
                            <td>
                            </tr>
                        <?php } ?>
                
                </tbody>
            </table>
        </div>
        <div class="col-md-6">
            <div id="mapid"></div>
        <div>

    </div>
</div>

<script>
    var mymap = L.map('mapid').setView([51.505, -0.09], 13);

    L.tileLayer('https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token=sk.eyJ1IjoiZGVtbzAwNCIsImEiOiJjazc0cHJncnUwNjh3M3Fua3Q1dnhzc2J3In0.2rcqD0u3Td9cUe2FWKGfrQ', {
        attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors, <a href="https://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
        maxZoom: 18,
        id: 'mapbox/streets-v11',
        tileSize: 512,
        zoomOffset: -1,
        accessToken: 'sk.eyJ1IjoiZGVtbzAwNCIsImEiOiJjazc0cHJncnUwNjh3M3Fua3Q1dnhzc2J3In0.2rcqD0u3Td9cUe2FWKGfrQ'
    }).addTo(mymap);

    var url = '<?php echo Html::img('@web/images/015-delivered.png', ['alt'=>'Delivered', 'class'=>'delivered']);?>'
    console.log(url);

    var deliveredIcon = L.icon({
        iconUrl: '/images/015-delivered.png',
        iconSize:     [50, 50], // size of the icon
        iconAnchor:   [51.508, -0.11], // point of the icon which will correspond to marker's location
        popupAnchor:  [-3, -76] // point from which the popup should open relative to the iconAnchor
    });

    var onRouteIcon = L.icon({
        iconUrl: '/images/028-express-delivery.png',
        iconSize:     [50, 50], // size of the icon
        iconAnchor:   [51.608, -0.51], // point of the icon which will correspond to marker's location
        popupAnchor:  [-3, -76] // point from which the popup should open relative to the iconAnchor
    });

    var failedDeliveryIcon = L.icon({
        iconUrl: '/images/016-delivery-failed.png',
        iconSize:     [50, 50], // size of the icon
        iconAnchor:   [51.608, -0.51], // point of the icon which will correspond to marker's location
        popupAnchor:  [-3, -76] // point from which the popup should open relative to the iconAnchor
    });

    var pendingIcon = L.icon({
        iconUrl: '/images/010-compass.png',
        iconSize:     [50, 50], // size of the icon
        iconAnchor:   [51.608, -0.51], // point of the icon which will correspond to marker's location
        popupAnchor:  [-3, -76] // point from which the popup should open relative to the iconAnchor
    });

    var assignedIcon = L.icon({
        iconUrl: '/images/005-calendar.png',
        iconSize:     [50, 50], // size of the icon
        iconAnchor:   [51.608, -0.51], // point of the icon which will correspond to marker's location
        popupAnchor:  [-3, -76] // point from which the popup should open relative to the iconAnchor
    });

    
    

    
    
    L.marker([51.5, -0.09], {icon: deliveredIcon}).addTo(mymap);
    L.marker([51.509, -0.08], {icon: onRouteIcon}).addTo(mymap);
    L.marker([51.51, -0.047], {icon: failedDeliveryIcon}).addTo(mymap);

    L.marker([51.503, -0.06], {icon: pendingIcon}).addTo(mymap);
    L.marker([51.51, -0.047], {icon: assignedIcon}).addTo(mymap);
    var marker = L.marker([51.5, -0.09]).addTo(mymap);

    // var circle = L.circle([51.508, -0.11], {
    //     color: 'red',
    //     fillColor: '#f03',
    //     fillOpacity: 0.5,
    //     radius: 500
    // }).addTo(mymap);

    // var polygon = L.polygon([
    //     [51.509, -0.08],
    //     [51.503, -0.06],
    //     [51.51, -0.047]
    // ]).addTo(mymap);

    // marker.bindPopup("<b>Hello world!</b><br>I am a popup.").openPopup();
    circle.bindPopup("I am a circle.");
    polygon.bindPopup("I am a polygon.");

    var popup = L.popup();

    function onMapClick(e) {
        popup
            .setLatLng(e.latlng)
            .setContent("You clicked the map at " + e.latlng.toString())
            .openOn(mymap);
    }

    mymap.on('click', onMapClick);

</script>


