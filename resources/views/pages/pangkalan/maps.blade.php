@extends('layouts.app', ['title' => 'Peta Pangkalan'])

@section('content')
    <div class="container-fluid">
        <div class="page-header">
            <h4 class="page-title">Peta Pangkalan</h4>
            <ul class="breadcrumbs">
                <li class="nav-home">
                    <a href="{{ route('dashboard') }}">
                        <i class="la la-home"></i>
                    </a>
                </li>
                <li class="separator">
                    <i class="la la-angle-right"></i>
                </li>
                <li class="nav-item">
                    <a href="{{ route('pangkalan.index') }}">Pangkalan</a>
                </li>
                <li class="separator">
                    <i class="la la-angle-right"></i>
                </li>
                <li class="nav-item">
                    <a href="#">Peta</a>
                </li>
            </ul>
            {{-- <div class="ml-auto">
                <a href="{{ route('pangkalan.create') }}" class="btn btn-primary">
                    <span class="btn-label"><i class="la la-plus mr-1"></i></span>
                    Tambah Pangkalan
                </a>
            </div> --}}


        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <div id="map"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection


@push('script')
    <script>
        let pangkalans = @json($pangkalans)

        var map = L.map('map').setView([-7.511223017989502, 109.29252259228235], 13);

        L.tileLayer(
            'https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token=pk.eyJ1IjoiZmVicmlzb2V0IiwiYSI6ImNrdm0zMDFoa2RrajMzMnE2bHdmZ3Nlc2gifQ.xEhvQMKMtB_g-5QeasQ-jw', {
                attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors, <a href="https://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
                maxZoom: 20,
                id: 'mapbox/streets-v12',
                tileSize: 512,
                zoomOffset: -1,
            }).addTo(map);

        var office = L.icon({
            iconUrl: window.location.origin + '/img/building-solid.svg',
            iconSize: [36, 36],
            iconAnchor: [36, 36],
            popupAnchor: [0, -36]
        });

        L.marker([-7.511223017989502, 109.29252259228235], {
                icon: office,
                alt: 'Kyiv'
            }).addTo(map)
            .bindPopup('<b>PT SERAYU AGUNG LESTARI</b>').bindTooltip('PT Serayu Agung Lestari', {
                permanent: true,
                direction: 'bottom',
                className: 'green-tooltip',
                offset: [-10, -10]
            });


        pangkalans.forEach(element => {
            let lat_lng = element.lat_lng.split(",")
            L.marker(lat_lng).addTo(map).bindPopup(
                `<b><a href="${window.location.origin}/pangkalan/${element.id}/edit">${element.nama.toUpperCase()}</a></b><br>${element.alamat}`
            ).bindTooltip(element.nama, {
                permanent: true,
                direction: 'bottom',
                className: 'blue-tooltip',
                offset: [-10, 20]
            });
        });

        var lastZoom;

        map.eachLayer(function(l) {
            if (l.getTooltip) {
                var toolTip = l.getTooltip();
                if (toolTip) {
                    this.map.closeTooltip(toolTip);
                }
            }
        });


        map.on('zoomend', function() {
            var zoom = map.getZoom();
            if (zoom < 14 && (!lastZoom || lastZoom >= 14)) {
                map.eachLayer(function(l) {
                    if (l.getTooltip) {
                        var toolTip = l.getTooltip();
                        if (toolTip) {
                            this.map.closeTooltip(toolTip);
                        }
                    }
                });
            } else if (zoom >= 14 && (!lastZoom || lastZoom < 14)) {
                map.eachLayer(function(l) {
                    if (l.getTooltip) {
                        var toolTip = l.getTooltip();
                        if (toolTip) {
                            this.map.addLayer(toolTip);
                        }
                    }
                });
            }
            lastZoom = zoom;
        })
    </script>
@endpush

@push('style')
    <style>
        #map {
            height: 100vh;
        }

       
    </style>
@endpush
