$(function () {
  'use strict'

  $('[data-toggle="offcanvas"]').on('click', function () {
    $('.offcanvas-collapse').toggleClass('open')
  })
  $(".dropdown-menu li").click(function(){
	  var selText = $(this).text();
	  $(this).parents('.btn-group').find('.dropdown-toggle').html(selText+' <span class="caret"></span>');
  });

  function getGeoCodeinfo(city, state, country, address) {
      $.ajax({
        type: "GET",
        url: `/order/geocoder?city=${city}&state=${state}&address=${address}&country=${country}`,
        // contentType: "application/json; charset=utf-8",
        // dataType: "json",
        success: function (response) {
          //do something
            
            var obj = jQuery.parseJSON (response);
            console.log(obj);
            localStorage.setItem('lng', obj.lng);
            localStorage.setItem('lat', obj.lat);
          
        },
        error: function (errormessage) {

            //do something else
            console.log(errormessage);
            // alert("not working");

        }
      });
  }

  $("#address").on('change', function() {
      var address = $(this).val();
      var country = $('#country option:selected').text();
      var city = $('#city').val();
      var state = $('#state').val();
      if (city && state && country && address) {
        getGeoCodeinfo(city, state, country, address);
      }
  });

  $("#city").on('change', function() {
    var city = $(this).val();
    var state = $('#state').val();
    var address = $('#address').val();
    var country = $('#country option:selected').text();
    if (city && state && country && address) {
      getGeoCodeinfo(city, state, country, address);
    }

  });

  $("#state").on('change', function() {    
    var state = $(this).val();
    var city = $('#city').val();
    var address = $('#address').val();
    var country = $('#country option:selected').text();
    if (city && state && country && address) {
      getGeoCodeinfo(city, state, country, address);
    }
  });

  $("#country").on('change', function() {
    // var country = $(this).val();
    var country = $('#country option:selected').text();
    var city = $('#city').val();
    var state = $('#state').val();
    var address = $('#address').val();
    if (city && state && country && address) {
      getGeoCodeinfo(city, state, country, address);
    }
  });

  $('#myForm').submit(function(e) {
    e.preventDefault();
    var data = {};
    $.each($(this).serializeArray(), function(i, field) {
        data[field.name] = field.value;
    });
    data['lng'] = localStorage.getItem('lng');
    data['lat'] = localStorage.getItem('lat');
    // console.log(data);
    
    $.ajax({
      type: "POST",
      url: "/order/create",
      data: data,
      success: function (response) {
         //do something
          console.log(response);
        
      },
      error: function (errormessage) {

          //do something else
          console.log(errormessage);
          // alert("not working");

      }
    });
});

  var mymap = L.map('mapid').setView([51.505, -0.09], 13);

    L.tileLayer('https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token=sk.eyJ1IjoiZGVtbzAwNCIsImEiOiJjazc0cHJncnUwNjh3M3Fua3Q1dnhzc2J3In0.2rcqD0u3Td9cUe2FWKGfrQ', {
        attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors, <a href="https://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
        maxZoom: 18,
        id: 'mapbox/streets-v11',
        tileSize: 512,
        zoomOffset: -1,
        accessToken: 'sk.eyJ1IjoiZGVtbzAwNCIsImEiOiJjazc0cHJncnUwNjh3M3Fua3Q1dnhzc2J3In0.2rcqD0u3Td9cUe2FWKGfrQ'
    }).addTo(mymap);

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
    var marker = L.marker([localStorage.getItem('lat'), localStorage.getItem('lng')]).addTo(mymap);

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
    // circle.bindPopup("I am a circle.");
    // polygon.bindPopup("I am a polygon.");

    var popup = L.popup();

    function onMapClick(e) {
        popup
            .setLatLng(e.latlng)
            .setContent("You clicked the map at " + e.latlng.toString())
            .openOn(mymap);
    }

    mymap.on('click', onMapClick);
})

