@extends('layouts.app', ['title' => 'Edit SP(P)BE'])

@section('content')
    <div class="container-fluid">
        <div class="page-header">
            <h4 class="page-title">Edit SP(P)BE</h4>
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
                    <a href="{{ route('sppbe.index') }}">SP(P)BE</a>
                </li>
                <li class="separator">
                    <i class="la la-angle-right"></i>
                </li>
                <li class="nav-item">
                    <a href="#">Edit</a>
                </li>
            </ul>
            <div class="ml-auto">


            </div>


        </div>
        <div class="row">
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <div id="map"></div>
                    </div>
                </div>
            </div>
            <div class="col-md-8">
                <form action="{{ route('sppbe.update', $sppbe) }}" method="POST" class="needs-validation" novalidate>
                    @csrf
                    @method('PUT')
                    <div class="card">

                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg-8">
                                    <div class="form-group form-show-validation">
                                        <label for="nama" class="required">Nama</label>
                                        <input type="text" class="form-control @error('nama') is-invalid @enderror"
                                            id="nama" name="nama" placeholder="Masukkan nama"
                                            value="{{ old('nama', $sppbe->nama) }}" required>
                                        @error('nama')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror

                                    </div>
                                </div>

                                <div class="col-lg-4">
                                    <div class="form-group form-show-validation">
                                        <label for="kode" class="required">Kode</label>
                                        <input type="text" class="form-control  @error('kode') is-invalid @enderror"
                                            id="kode" name="kode" placeholder="Masukkan kode"
                                            value="{{ old('kode', $sppbe->kode) }}" required>
                                        @error('kode')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror

                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="form-group form-show-validation">
                                        <label for="no_sh" class="required">No. SH</label>
                                        <input type="text" class="form-control @error('no_sh') is-invalid @enderror"
                                            id="no_sh" name="no_sh" placeholder="Masukkan No. SH"
                                            value="{{ old('no_sh', $sppbe->no_sh) }}" required>
                                        @error('no_sh')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror

                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="form-group form-show-validation">
                                        <label for="plant" class="required">Plant</label>
                                        <input type="text" class="form-control @error('plant') is-invalid @enderror"
                                            id="plant" name="plant" placeholder="Masukkan plant"
                                            value="{{ old('plant', $sppbe->plant) }}" required>
                                        @error('plant')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror

                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <div class="form-group form-show-validation">
                                        <label for="no_hp" class="required">No. Telepon</label>
                                        <input type="text" class="form-control @error('no_hp') is-invalid @enderror"
                                            id="no_hp" name="no_hp" placeholder="Masukkan No. telepon"
                                            value="{{ old('no_hp', $sppbe->no_hp) }}" required>
                                        @error('no_hp')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror

                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <div class="form-group form-show-validation">
                                        <label for="alamat" class="required">Alamat</label>
                                        <input type="text" class="form-control @error('alamat') is-invalid @enderror"
                                            id="alamat" name="alamat" placeholder="Masukkan alamat"
                                            value="{{ old('alamat', $sppbe->alamat) }}" required>
                                        @error('alamat')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror

                                    </div>
                                </div>
                              

                                <div class="col-lg-6">
                                    <div class="form-group form-show-validation">
                                        <label for="lat_lng" class="required">Koordinat</label>
                                        <input type="text" class="form-control @error('lat_lng') is-invalid @enderror"
                                            id="lat_lng" name="lat_lng" placeholder="-7.431391, 109.247833"
                                            value="{{ old('lat_lng', $sppbe->lat_lng) }}" required>
                                        @error('lat_lng')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                        <div class="mt-1"><a class="gmaps"
                                                href="https://www.google.com/maps/search/{{ str_replace(' ', '', $sppbe->lat_lng) }}/{{ '@'.str_replace(' ', '', $sppbe->lat_lng) }},18z"
                                                target="_blank">Buka Google Maps</a></div>
                                    </div>
                                </div>


                            </div>


                        </div>
                        <div class="card-footer">
                            <div class="text-center">
                                <button type="submit" class="btn btn-primary"><span class="btn-label"><i
                                            class="la la-save mr-1"></i></span>Simpan</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('style')
    <style>
        #map {
            height: 50vh;
        }
    </style>
@endpush


@push('script')
    <script>
        let sppbe = @json($sppbe)

        let lat_lng = sppbe.lat_lng.split(",")

        var map = L.map('map').setView(lat_lng, 13);

        L.tileLayer(
            'https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token=pk.eyJ1IjoiZmVicmlzb2V0IiwiYSI6ImNrdm0zMDFoa2RrajMzMnE2bHdmZ3Nlc2gifQ.xEhvQMKMtB_g-5QeasQ-jw', {
                attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors, <a href="https://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
                maxZoom: 20,
                id: 'mapbox/streets-v12',
                tileSize: 512,
                zoomOffset: -1,
            }).addTo(map);

        var office = L.icon({
            iconUrl: app_url + '/img/building-solid.svg',
            iconSize: [36, 36],
            iconAnchor: [36, 36],
            popupAnchor: [0, -36]
        });

        L.marker([-7.511223017989502, 109.29252259228235], {
                icon: office,
                alt: 'Kyiv'
            }).addTo(map).bindPopup('<b>PT SERAYU AGUNG LESTARI</b>')
            .bindTooltip('PT Serayu Agung Lestari', {
                permanent: true,
                direction: 'bottom',
                className: 'green-tooltip',
                offset: [-10, -10]
            });

        var marker = L.marker(lat_lng, {
            draggable: 'true'
        }).addTo(map)

        marker.on('dragend', function(e) {
            updateLatLng(marker.getLatLng().lat, marker.getLatLng().lng);
        });

        map.on('click', function(e) {
            marker.setLatLng(e.latlng);
            updateLatLng(marker.getLatLng().lat, marker.getLatLng().lng);
        });

        function updateLatLng(lat, lng, reverse) {
            if (reverse) {
                marker.setLatLng([lat, lng]);
                map.panTo([lat, lng]);
            } else {
                let new_lat_lng = marker.getLatLng().lat + ', ' + marker.getLatLng().lng;
                $('input[name=lat_lng]').val(new_lat_lng)
                map.panTo([lat, lng]);

                let url =
                    `https://www.google.com/maps/search/${new_lat_lng.replace(" ", "")}/@${new_lat_lng.replace(" ", "")},18z`
                $('.gmaps').attr('href', url);

            }
        }

        $('input[name=lat_lng]').change(function() {
            let new_lat_lng = $(this).val().split(",");
            if (new_lat_lng[1]) {
                marker.setLatLng(new_lat_lng, {
                    draggable: 'true'
                }).bindPopup(new_lat_lng).update();
                map.panTo(new_lat_lng);

                let url =
                    `https://www.google.com/maps/search/${new_lat_lng.replace(" ", "")}/@${new_lat_lng.replace(" ", "")},18z`
                $('.gmaps').attr('href', url);

            }

        });
    </script>
@endpush
