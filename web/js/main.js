$(function () {
  'use strict'
  localStorage.removeItem('lng');
  localStorage.removeItem('lat');
  var marker = [];
  var mymap = L.map('mapid').setView([51.505, -0.09], 13);
  showMap();

  $('[data-toggle="offcanvas"]').on('click', function () {
    $('.offcanvas-collapse').toggleClass('open')
  })
  $(".dropdown-menu li").click(function(){
	  var selText = $(this).text();
	  $(this).parents('.btn-group').find('.dropdown-toggle').html(selText+' <span class="caret"></span>');
  });

  //Write your js here

  $('.input-group.date').datepicker({
    todayBtn: true
  });

  $.fn.dataTable.ext.order['dom-select'] = function  ( settings, col )
  {
    return this.api().column( col, {order:'index'} ).nodes().map( function ( td, i ) {
      return $('select', td).val();
    });
  }

  var existingOrdertable = $('#orderTable').DataTable( {
    'processing': true,
    'language': {
        'loadingRecords': '&nbsp;',
        'processing': 'Loading...'
    },
    "ajax": "/order/datatableorders",
    "columns": [
      { "data": "first_name" },
      { "data": "last_name" },
      { "data": "scheduled_date" },
      { "data": null },
      { "data": null }
    ],
    "scrollY": "323px",
    "paging" : false,
    "scrollX": true,
    "bInfo": false,
    "lengthChange": false,
    "filter": true,
    "info": false,
    "scroller": true,
    "stripeClasses": [],
    "columnDefs": [{
      "targets": -2,
      "orderDataType": "dom-select",
      "orderable": true,
      "render": function (data, type, row) {        
        var select = `<select style=${data.status_id === 1 ? 'background-color:#a9a9a9' : data.status_id === 2 ?  'background-color:#2f7ab8' : data.status_id === 3 ? 'background-color:#f0af4d' : data.status_id === 4 ? 'background-color:#5bb95b' : 'background-color:#da5451'} _csrf=${data._csrf} order-id=${data.id} class="form-control order-select"> <option ${data.status_id === 1 ? "selected" : ""} value="1">Pending </option> <option ${data.status_id === 2 ? "selected" : ""} value="2">Assigned </option> <option ${data.status_id === 3 ? "selected" : ""} value="3">On Route </option> <option ${data.status_id === 4 ? "selected" : ""} value="4">Done </option> <option ${data.status_id === 5 ? "selected" : ""} value="5">Cancelled </option> </select>`;           
        return select;
      }
    },
    {
      "targets": -1,
      "orderable": false,
      "render": function (data, type, row) {        
        var close = `<span ${((data.status_id === 1) || (data.status_id === 2)) ?  "" : "style='opacity: .19;'" }  status-id=${data.status_id} _csrf=${data._csrf} order-id=${data.id} class="fa fa-close red deleteOrder cursor-pointer"></span>`;
        return close;
      }
    },
    { className: "cursor-pointer view-order", "targets": [ 0 ] },
    { className: "cursor-pointer view-order", "targets": [ 1 ] },
    { className: "cursor-pointer view-order", "targets": [ 2 ] }
  ]
  });

  $('#orderTable tbody').on('click', '.view-order',  function () {
    var table = $('#orderTable').DataTable();
    var data = table.row( this ).data();
    $('#detailModal').addClass('show');
    $('#detailModal').show();
    $('.bg-light').addClass('modal-open');
    $('#lightContent').addClass('modal-backdrop fade show')
    console.log(data);
      showMap(data);
      showOrderDetail(data);
  });
  $('.closeDetailModal').on('click', function () {
    $('#detailModal').removeClass('show');
    $('.bg-light').removeClass('modal-open');
    $('#lightContent').removeClass('modal-backdrop fade show')
    $('#detailModal').hide();
  })

  $('#orderTable tbody').on('change', '.order-select', function () {
    var orderId = $(this).attr('order-id');
    var csrfToken = $(this).attr('_csrf');
    var statusId =$(this).val()
    var data = {
      orderId: orderId,
      statusId: statusId,
      _csrf: csrfToken
    }
    $.ajax({
      type: "PUT",
      url: `/order/update/${orderId}`,
      data: data,
      
      success: function (response) {
        if (response === "error") {
          Swal.fire({
            icon: 'error',
            title: 'Error',
            showConfirmButton: false,
            text: "Something went wrong",
            timer: 2000
          })
        } else {
          Swal.fire({
            icon: 'success',
            title: 'Success',
            showConfirmButton: false,
            text: "Order Successfully updated",
            timer: 2000
          })

          showMap(response)
          existingOrdertable.ajax.reload();
        }
      },
      error: function (errormessage) {
          Swal.fire({
            icon: 'error',
            title: 'Error',
            showConfirmButton: false,
            text: "Something went wrong",
            timer: 1500
          })
      }
    });
  });

  $('#orderTable tbody').on('click', '.deleteOrder', function () {
    var statusId = $(this).attr('status-id');
    if (statusId == 2 || statusId == 1) {
      Swal.fire({
        title: 'Are you sure?',
        text: "You won't be able to revert this!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#7858c5',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!'
      }).then((result) => {
        if (result.value) {
          var orderId = $(this).attr('order-id');
          var csrfToken = $(this).attr('_csrf');
          var data = {
            orderId: orderId,
            _csrf: csrfToken
          }
          $.ajax({
            type: "POST",
            url: `/order/delete/${orderId}`,
            data: data,
            success: function (response) {
               //do something
                console.log(response);
                showMap();
                Swal.fire(
                  'Deleted!',
                  'Order Successfully deleted.',
                  'success'
                )
                existingOrdertable.ajax.reload()
                // var obj = jQuery.parseJSON(response);
              
            },
            error: function (errormessage) {
      
                //do something else
                console.log(errormessage);
                var obj = jQuery.parseJSON(errormessage);
                // alert("not working");
      
            }
          });
        }
      })
    }
    
  });

  function getGeoCodeinfo(city, state, country, address) {
    if (city && state && country && address) {

      $.ajax({
        type: "GET",
        url: `/order/geocoder?city=${city}&state=${state}&address=${address}&country=${country}`,
        success: function (response) {
          //do something
            var obj = jQuery.parseJSON (response);
            console.log(obj);
            if (obj === "Could not geocode address. Postal code or city required.") {
              // alert("We could not get your location, please give a right address")
              Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'We could not get your location, please change your address!',
              })
              localStorage.removeItem('lng');
              localStorage.removeItem('lat');
              showMap();
            } else {
              $('#submitButton').removeAttr("disabled");
              localStorage.setItem('lng', obj.lng);
              localStorage.setItem('lat', obj.lat);
              showMap();
            }
        },
        error: function (errormessage) {

            //do something else
            console.log(errormessage);
            // alert("not working");

        }
      });
      
    }
  }

  $('#formReset').on('click', function() {
    localStorage.removeItem('lng')
    localStorage.removeItem('lat')
    showMap()
  })

  function showOrderDetail(response) {
    var orderTypes = {
      1: "Delivery",
      2: "Servicing",
      3: "Installation"
    }
    var orderStatuses = {
      1: "Pending",
      2: "Assigned",
      3: "On Route",
      4: "Delivered",
      5: "Cancelled"
    }

    var orderCountries = {
      1: "Nigeria",
      2: "Canada",
      3: "United States",
      4: "Mexico"
    }

    const formatter = new Intl.NumberFormat('en-US', {
      style: 'currency',
      currency: 'USD',
      minimumFractionDigits: 2
    })

    var orderType = orderTypes[response.order_type_id]
    var orderStatus = orderStatuses[response.status_id]
    var orderCountry = orderCountries[response.country_id]
    $('#user1title').text(`${response.first_name} ${response.last_name}`)
    $('#orderEmail').text(response.email)
    $('#orderSchedleDate').text(response.scheduled_date)
    $('#orderAmount').text(formatter.format(response.order_value))
    $('#orderAddress').text(`${response.address} ${response.city} ${response.state}`)
    $('#orderPhone').text(response.phone_number)
    $('#orderType').text(orderType)
    $('#orderCountry').text(orderCountry)
    $('#orderStatus').text(orderStatus)
  }

  $("#previewLocation").on('click', function() {
    if (localStorage.getItem('lat') && localStorage.getItem('lng')) {
      showMap();
    } else {
      Swal.fire({
        icon: 'warning',
        title: 'Info',
        showConfirmButton: false,
        text: "Please fill the address field to view your location",
        timer: 2000
      })
    }
   
  })

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
      // getGeoCodeinfo(city, state, country, address);
    }
  });

  $("#country").on('change', function() {
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
    console.log(data);
    // $('#myForm').bootstrapValidator('resetForm', true);
    // $('#myForm').trigger("reset");
    // return;
    if (!data.first_name || !data.order_type_id || !data.phone_number || !data.scheduled_date || !data.city || !data.state || !data.country_id) {
      return;
    }
    if (data.phone_number.length < 11 || data.phone_number.length > 13) {
      $('#phoneNumber').text("Phone number must be between 11 and 13 characters")
      $('#phoneNumber').addClass("d-block")
      return;
    } else {
      $('#phoneNumber').text("Valid phone number is required.")
      $('#phoneNumber').removeClass("d-block")
    }
    data['lng'] = localStorage.getItem('lng');
    data['lat'] = localStorage.getItem('lat');
    
    $.ajax({
      type: "POST",
      url: "/order/create",
      data: data,
      success: function (response) {
         //do something
          console.log(response);
          localStorage.removeItem('lng');
          localStorage.removeItem('lat');
          
          if (response === "success") {
            // $('#myForm').reset();
            existingOrdertable.ajax.reload();
            Swal.fire({
              icon: 'success',
              title: 'Success',
              showConfirmButton: false,
              text: "Your Order has been saved Succesfully",
              timer: 2000
            })
            var form = $('#myForm')[0];
            $(form).removeClass('was-validated');
            form.reset();
            $("#submitButton").attr("disabled", true);
          } else {
            Swal.fire({
              icon: 'error',
              title: 'Error',
              showConfirmButton: false,
              text: "Something went wrong, please try again later",
              timer: 2000
            })
          }
          
          showMap();
      },
      error: function (errormessage) {
          //do something else
          console.log(errormessage);
          var obj = jQuery.parseJSON(errormessage);

      }
    });
  });

  function fetchOrders(callback) {
    $.ajax({
      type: "GET",
      url: "/order/getorders",
      // contentType: "application/json; charset=utf-8",
      // dataType: "json",
      success: function (response) {
        //do something
          
          // var obj = jQuery.parseJSON (response);
          // console.log(response);

          return callback(response);
        
      },
      error: function (errormessage) {

          //do something else
          console.log(errormessage);
          // alert("not working");

      }
    });
  }

  function showMap(viewOrder) {
    var popup = L.popup();
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
      iconUrl: '/images/057-stopwatch.png',
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

    var statuses = {
      1: pendingIcon,
      2: assignedIcon,
      3: onRouteIcon,
      4: deliveredIcon,
      5: failedDeliveryIcon
    }

    var orderStatuses = {
      1: "Pending",
      2: "Assigned",
      3: "On Route",
      4: "Delivered",
      5: "Cancelled"
    }

   fetchOrders(function (response) {
    if (response) {
      response.forEach(function(order) {
        L.marker([order.lat, order.lng], {icon: statuses[order.status_id]}).addTo(mymap).on('click', function(e) {
            popup
              .setLatLng(this.getLatLng())
              .setContent(`Order for ${order.first_name + ' ' + order.last_name} (${orderStatuses[order.status_id]})`)
              .openOn(mymap);
          $('#orderTable > tbody  > tr').each(function (key, values) {
            var table = $('#orderTable').DataTable();
            var data = table.row( this ).data();
            if (data.id === order.id) {
              $('.dataTables_scrollBody').scrollTo(values);
              $(this).addClass("focusedRow")
            } else {
              $(this).removeClass("focusedRow")
            }
          });
        });
      })
    }
     if (localStorage.getItem('lat') && localStorage.getItem('lng')) {
      mymap.setView([localStorage.getItem('lat'), localStorage.getItem('lng')], 13);
     } else if (viewOrder) {
      mymap.setView([viewOrder.lat, viewOrder.lng], 13);
      var latlng = {lat: viewOrder.lat, lng: viewOrder.lng}
      popup
          .setLatLng(latlng)
          .setContent(`Order for ${viewOrder.first_name + ' ' + viewOrder.last_name}  (${orderStatuses[viewOrder.status_id]})`)
          .openOn(mymap);
     } else if (response) {
      mymap.setView([response[0].lat, response[0].lng], 5);
     } else {
        mymap.setView([51.505, -0.09], 13);
     }
   });

   if (localStorage.getItem('lat') && localStorage.getItem('lng')) {
    marker = L.marker([localStorage.getItem('lat'), localStorage.getItem('lng')]).addTo(mymap);
    mymap.setView([localStorage.getItem('lat'), localStorage.getItem('lng')], 13);
    marker.bindPopup("This is your location based on your address.").openPopup();
   } else {
    mymap.removeLayer(marker)
   }
  }
})

