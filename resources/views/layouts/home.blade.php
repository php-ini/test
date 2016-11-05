@extends('layouts.default')

@section('content')
<div ng-app="app" ng-controller="eventsController">
<div class="row">
    @if (session('flash_message'))
    <div class="alert alert-success">
        {{ session('flash_message') }}
    </div>
    @endif
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
            <div class="x_title">
                <h2>Events Location </h2>
                <ul class="nav navbar-right panel_toolbox">
                    <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                    </li>



                </ul>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">
                <p class="text-muted font-13 m-b-30">
                    This is the Active Events around the world !
                </p>



                <div class="form-group" ng-app=''>

                    <div id="us3" style="width: 900px; height: 350px;"></div>

                </div>

                <div class="form-group {{ $errors->has('title') ? 'has-error' : ''}}">
                    {!! Form::label('title', 'Event Details', ['class' => 'col-sm-3 control-label']) !!}
                    <div class="col-sm-6 event_details">

                    </div>
                </div>






            </div>
        </div>
    </div>
</div>


    
    
</div>

<script>

    $(document).ready(function () {
//        $("#us3").css({
//            height: 1024,
//            width: 600
//        });
        var myLatLng = new google.maps.LatLng(17.74033553, 83.25067267);
        MYMAP.init('#us3', myLatLng, 11);

//  $("#showmarkers").click(function(e){
        MYMAP.placeMarkers('/event/xml');
//  });
    });

    var MYMAP = {
        map: null,
        bounds: null
    }

    MYMAP.init = function (selector, latLng, zoom) {
        var myOptions = {
            zoom: zoom,
            center: latLng,
            mapTypeId: google.maps.MapTypeId.ROADMAP
        }
        this.map = new google.maps.Map($(selector)[0], myOptions);
        this.bounds = new google.maps.LatLngBounds();
    }

    MYMAP.placeMarkers = function (filename) {
        $.get(filename, function (xml) {
            $(xml).find("marker").each(function () {
                var name = $(this).find('name').text();
                var address = $(this).find('address').text();

                // create a new LatLng point for the marker
                var id = $(this).find('id').text();
                var lat = $(this).find('lat').text();
                var lng = $(this).find('lng').text();
                var start_date = $(this).find('start_date').text();
                var end_date = $(this).find('end_date').text();
                var point = new google.maps.LatLng(parseFloat(lat), parseFloat(lng));

                // extend the bounds to include the new point
                MYMAP.bounds.extend(point);

                var marker = new google.maps.Marker({
                    position: point,
                    map: MYMAP.map
                });

                var infoWindow = new google.maps.InfoWindow();
                var html = '<strong>' + name + '</strong.><br />' + address;
                google.maps.event.addListener(marker, 'click', function () {
                    infoWindow.setContent(html);
                    infoWindow.open(MYMAP.map, marker);
                    $(".event_details").html('<b>Event Title: </b>' + name + '<br><b>Location: </b>' + address + '<br><b>Start Date: </b>' + start_date + '<br><b>End Date: </b>' + end_date + '<br><br><a href="/event/' + id + '/stands"><button class="btn btn-success">Book Your Place</button><br><br>')
                });
                MYMAP.map.fitBounds(MYMAP.bounds);
            });
        });
    }

</script>




<script>
var app = angular.module('app', []);
app.controller('eventsController', function($scope, $http) {
    $http.get("/event/xml")
    .then(function (response) {$scope.names = response.data.records;});
});
</script>
@endsection