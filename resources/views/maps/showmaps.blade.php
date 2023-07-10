@extends('layouts.home_master')

@section('title')
Admin Maps | Maps
@endsection

@section('judul')
Maps
@endsection

@section('rowHeader')
<div class="col-md-12">
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">Maps Cabang dan ATM Cat</h3>
        </div>

        <div class="card-body">
            <!-- maps -->
            <div id="map" style="height:600px;"></div>
        </div>
        <!-- /.card-body -->
        <!-- /.card-header -->
        <!-- form start -->

    </div>
</div>
@endsection

@section('pathJudul')
<li class="breadcrumb-item"><a href="/">Home</a></li>
<li class="breadcrumb-item active">Maps</li>
@endsection

@section('content')
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">

                <!-- /.card -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
</section>


@endsection

@section('javascript_bottom')

<!-- <script type="text/javascript" src="https://maps.google.com/maps/api/js?key={{ env('GOOGLE_MAP_KEY') }}"></script> -->
<!-- <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyB41DRUbKWJHPxaFjMAwdrzWzbVKartNGg&callback=initMap" defer></script> -->
<script src="https://maps.googleapis.com/maps/api/js?key=&libraries=geometry&language=en&callback=initMap" async defer></script>

<script type="text/javascript">
    async function initMap() {
        const iconBaseCabang =
            "https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200";
        const iconBaseAtm =
            "https://www.flaticon.com/free-icon/atm_57426?term=atm&page=1&position=4&origin=search&related_id=57426";
        const iconBase =
            "https://developers.google.com/maps/documentation/javascript/examples/full/images/";
        const icons = {
            cabang: {
                icon: "{{asset('img/office.png')}}",
                labelOrigin: new google.maps.Point(0, 0),
                //scaledSize: new google.maps.Size(1, 1),
                anchor: new google.maps.Point(16, 16),
                labelClass: "labels",
                color: '#00492C',

            },
            atm: {
                icon: "{{asset('img/atm-machine.png')}}",
                labelOrigin: new google.maps.Point(15, 32),
                //size: new google.maps.Size(16, 16),
                anchor: new google.maps.Point(0, 0),
                labelClass: "labels",
                color: '#008000',
            },
        };


        let myLatLng;
        myLatLng = {
            lat: -7.24917,
            lng: 112.75083
        };

        const map = new google.maps.Map(document.getElementById("map"), {
            zoom: 15,
            center: myLatLng,

        });

        var locationsCabang = [];

        <?php foreach ($datacabang as $dc) : ?>
            if ("<?= $dc[0]; ?>" != "NAMA_CABANG" || "<?= $dc[1]; ?>" != "ALAMAT" || "<?= $dc[2]; ?>" != "LATITUDE" || "<?= $dc[3]; ?>" != "LONGITUDE") {
                locationsCabang.push(
                    [<?= $dc[2]; ?>, <?= $dc[3]; ?>, "<?= $dc[0]; ?>", "<?= $dc[1]; ?>"]
                );
            }
        <?php endforeach; ?>

        var locationsAtm = [];

        <?php foreach ($dataatmcat as $dac) : ?>
            if ("<?= $dac[0]; ?>" != "ATM Cat" || "<?= $dac[1]; ?>" != "LATITUDE" || "<?= $dac[2]; ?>" != "LONGITUDE") {
                locationsAtm.push(
                    [<?= $dac[1]; ?>, <?= $dac[2]; ?>, "<?= $dac[0]; ?>"]
                );
            }
        <?php endforeach; ?>


        $.each(locationsCabang, function(key, value) {

            const marker = new google.maps.Marker({
                position: new google.maps.LatLng(value[0], value[1]),
                icon: {
                    url: icons['cabang'].icon,
                    labelOrigin: icons['cabang'].labelOrigin,
                    size: icons['cabang'].size,
                    anchor: icons['cabang'].anchor,

                },
                map: map,
                draggable: false,
                labelClass: "labels",
                label: {
                    color: 'black',
                    fontWeight: 'normal',
                    className: 'labels',
                }
            });

            const contentString =
                '<div id="content">' +
                '<div id="siteNotice">' +
                "</div>" +
                '<h4>' + value[2] + '</h4>' +
                '<div id="bodyContent">' +
                "<p>" + value[3] + "</p>" +
                "</div>" +
                "</div>";
            const infowindow = new google.maps.InfoWindow({
                content: contentString,
            });

            marker.addListener("click", () => {
                infowindow.open({
                    anchor: marker,
                    map,
                });
            });

        });

        $.each(locationsAtm, function(key, value) {

            const marker = new google.maps.Marker({
                position: new google.maps.LatLng(value[0], value[1]),
                icon: {
                    url: icons['atm'].icon,
                    labelOrigin: icons['atm'].labelOrigin,
                    size: icons['atm'].size,
                    anchor: icons['atm'].anchor,

                },
                map: map,
                draggable: false,
                labelClass: "labels",
                label: {
                    color: 'black',
                    fontWeight: 'normal',
                    className: 'labels',
                }
            });

            var totalAtmSekitar = -1;

            $.each(locationsAtm, function(k, v) {
                var d = google.maps.geometry.spherical.computeDistanceBetween(
                    marker.getPosition(),
                    new google.maps.LatLng(v[0], v[1]),

                );
                if (d * 0.001 <= 1) {
                    totalAtmSekitar += 1;
                }
            });

            const contentString =
                '<div id="content">' +
                '<div id="siteNotice">' +
                "</div>" +
                '<h4>' + value[2] + '</h4>' +
                '<div id="bodyContent">' +
                "<p>ATM CAT Sekitar 1Km: <b>" + totalAtmSekitar + "</b></p>" +
                "</div>" +
                "</div>";
            const infowindow = new google.maps.InfoWindow({
                content: contentString,
            });

            marker.addListener("click", () => {

                infowindow.open({
                    anchor: marker,
                    map,
                });
            });



        });


        // new google.maps.Marker({
        //     position: myLatLng,
        //     map,
        //     title: "Maps",
        // });
    }

    initMap();
</script>

@endsection