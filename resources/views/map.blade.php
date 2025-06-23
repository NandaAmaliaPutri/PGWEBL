@extends('layout/template')

@section('styles')
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
        integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="" />

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/leaflet.draw/1.0.4/leaflet.draw.css">

    <!-- Add Font Awesome for the icons -->
    <link rel="stylesheet" href="{{ asset('all.min.css') }}">

    <!-- Leaflet Routing Machine CSS -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet-routing-machine@3.2.12/dist/leaflet-routing-machine.css" />

    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap');

        body {
            font-family: 'Inter', sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }

        #map {
            width: 100%;
            height: calc(100vh - 56px);
            border-radius: 12px;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.15);
            overflow: hidden;
            border: 3px solid rgba(255, 255, 255, 0.1);
        }

        /* Enhanced Layer Control Styling */
        .leaflet-control-layers {
            background: rgba(255, 255, 255, 0.98) !important;
            backdrop-filter: blur(20px);
            border-radius: 16px !important;
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.12) !important;
            border: 1px solid rgba(255, 255, 255, 0.2) !important;
            font-family: 'Inter', sans-serif !important;
            min-width: 200px;
        }

        .leaflet-control-layers-toggle {
            background: linear-gradient(135deg, #667eea, #764ba2) !important;
            border-radius: 12px !important;
            width: 40px !important;
            height: 40px !important;
        }

        .leaflet-control-layers-expanded {
            padding: 16px !important;
        }

        .leaflet-control-layers label {
            font-weight: 500 !important;
            color: #2d3748 !important;
            margin: 8px 0 !important;
            display: flex !important;
            align-items: center !important;
            padding: 8px 12px !important;
            border-radius: 8px !important;
            transition: all 0.2s ease !important;
        }

        .leaflet-control-layers label:hover {
            background: rgba(102, 126, 234, 0.1) !important;
            transform: translateX(4px) !important;
        }

        .leaflet-control-layers input[type="radio"],
        .leaflet-control-layers input[type="checkbox"] {
            margin-right: 12px !important;
            transform: scale(1.2) !important;
            accent-color: #667eea !important;
        }

        .leaflet-control-layers-separator {
            border-top: 2px solid rgba(102, 126, 234, 0.2) !important;
            margin: 12px 0 !important;
        }

        /* Enhanced Legend Styling */
        .legend {
            background: rgba(255, 255, 255, 0.98) !important;
            backdrop-filter: blur(20px) !important;
            padding: 20px !important;
            border-radius: 16px !important;
            box-shadow: 0 12px 40px rgba(0, 0, 0, 0.15) !important;
            border: 1px solid rgba(255, 255, 255, 0.2) !important;
            font-size: 14px !important;
            line-height: 20px !important;
            font-family: 'Inter', sans-serif !important;
            min-width: 180px !important;
        }

        .legend h4 {
            margin: 0 0 16px 0 !important;
            color: #2d3748 !important;
            font-weight: 600 !important;
            font-size: 16px !important;
            text-align: center !important;
            padding-bottom: 12px !important;
            border-bottom: 2px solid rgba(102, 126, 234, 0.2) !important;
        }

        .legend-item {
            margin: 12px 0 !important;
            display: flex !important;
            align-items: center !important;
            padding: 8px 12px !important;
            border-radius: 8px !important;
            transition: all 0.2s ease !important;
            background: rgba(102, 126, 234, 0.05) !important;
            border: 1px solid rgba(102, 126, 234, 0.1) !important;
        }

        .legend-item:hover {
            background: rgba(102, 126, 234, 0.1) !important;
            transform: translateX(4px) !important;
            box-shadow: 0 4px 12px rgba(102, 126, 234, 0.2) !important;
        }

        .legend-line {
            width: 30px !important;
            height: 4px !important;
            margin-right: 12px !important;
            border-radius: 2px !important;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1) !important;
        }

        .legend-item span {
            font-weight: 500 !important;
            color: #4a5568 !important;
        }

        /* Enhanced Draw Controls */
        .leaflet-draw-toolbar {
            background: rgba(255, 255, 255, 0.98) !important;
            backdrop-filter: blur(20px) !important;
            border-radius: 12px !important;
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.12) !important;
            border: 1px solid rgba(255, 255, 255, 0.2) !important;
        }

        .leaflet-draw-toolbar a {
            background: transparent !important;
            border-radius: 8px !important;
            margin: 4px !important;
            transition: all 0.2s ease !important;
        }

        .leaflet-draw-toolbar a:hover {
            background: rgba(102, 126, 234, 0.1) !important;
            transform: scale(1.05) !important;
        }

        /* Enhanced Zoom Controls */
        .leaflet-control-zoom {
            background: rgba(255, 255, 255, 0.98) !important;
            backdrop-filter: blur(20px) !important;
            border-radius: 12px !important;
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.12) !important;
            border: 1px solid rgba(255, 255, 255, 0.2) !important;
            overflow: hidden !important;
        }

        .leaflet-control-zoom a {
            background: transparent !important;
            color: #4a5568 !important;
            font-weight: 600 !important;
            border: none !important;
            transition: all 0.2s ease !important;
        }

        .leaflet-control-zoom a:hover {
            background: rgba(102, 126, 234, 0.1) !important;
            color: #667eea !important;
        }

        /* Geolocation Control Styling */
        .leaflet-control-locate {
            background: rgba(255, 255, 255, 0.98) !important;
            backdrop-filter: blur(20px) !important;
            border-radius: 12px !important;
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.12) !important;
            border: 1px solid rgba(255, 255, 255, 0.2) !important;
        }

        .leaflet-control-locate a {
            background: linear-gradient(135deg, #48bb78, #38a169) !important;
            color: white !important;
            border-radius: 8px !important;
            width: 34px !important;
            height: 34px !important;
            display: flex !important;
            align-items: center !important;
            justify-content: center !important;
            transition: all 0.2s ease !important;
        }

        .leaflet-control-locate a:hover {
            background: linear-gradient(135deg, #38a169, #2f855a) !important;
            transform: scale(1.05) !important;
        }

        /* Enhanced Popup Styling */
        .leaflet-popup-content-wrapper {
            background: rgba(255, 255, 255, 0.98) !important;
            backdrop-filter: blur(20px) !important;
            border-radius: 16px !important;
            box-shadow: 0 12px 40px rgba(0, 0, 0, 0.15) !important;
            border: 1px solid rgba(255, 255, 255, 0.2) !important;
        }

        .leaflet-popup-content {
            font-family: 'Inter', sans-serif !important;
            font-size: 14px !important;
            line-height: 1.6 !important;
            color: #2d3748 !important;
        }

        .leaflet-popup-tip {
            background: rgba(255, 255, 255, 0.98) !important;
            backdrop-filter: blur(20px) !important;
        }

        /* Enhanced Tooltip Styling */
        .leaflet-tooltip {
            background: rgba(45, 55, 72, 0.95) !important;
            backdrop-filter: blur(10px) !important;
            color: white !important;
            border: none !important;
            border-radius: 8px !important;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2) !important;
            font-family: 'Inter', sans-serif !important;
            font-weight: 500 !important;
            padding: 8px 12px !important;
        }

        .leaflet-tooltip:before {
            border-top-color: rgba(45, 55, 72, 0.95) !important;
        }

        /* Custom Button Styling in Popups */
        .leaflet-popup-content .btn {
            font-family: 'Inter', sans-serif !important;
            font-weight: 500 !important;
            border-radius: 8px !important;
            padding: 6px 12px !important;
            margin: 2px !important;
            transition: all 0.2s ease !important;
            border: none !important;
        }

        .leaflet-popup-content .btn-warning {
            background: linear-gradient(135deg, #f6ad55, #ed8936) !important;
            color: white !important;
        }

        .leaflet-popup-content .btn-warning:hover {
            background: linear-gradient(135deg, #ed8936, #dd6b20) !important;
            transform: translateY(-1px) !important;
            box-shadow: 0 4px 12px rgba(237, 137, 54, 0.3) !important;
        }

        .leaflet-popup-content .btn-danger {
            background: linear-gradient(135deg, #fc8181, #e53e3e) !important;
            color: white !important;
        }

        .leaflet-popup-content .btn-danger:hover {
            background: linear-gradient(135deg, #e53e3e, #c53030) !important;
            transform: translateY(-1px) !important;
            box-shadow: 0 4px 12px rgba(229, 62, 62, 0.3) !important;
        }

        .leaflet-popup-content .btn-success {
            background: linear-gradient(135deg, #68d391, #48bb78) !important;
            color: white !important;
        }

        .leaflet-popup-content .btn-success:hover {
            background: linear-gradient(135deg, #48bb78, #38a169) !important;
            transform: translateY(-1px) !important;
            box-shadow: 0 4px 12px rgba(72, 187, 120, 0.3) !important;
        }

        .leaflet-popup-content .btn-info {
            background: linear-gradient(135deg, #63b3ed, #4299e1) !important;
            color: white !important;
        }

        .leaflet-popup-content .btn-info:hover {
            background: linear-gradient(135deg, #4299e1, #3182ce) !important;
            transform: translateY(-1px) !important;
            box-shadow: 0 4px 12px rgba(66, 153, 225, 0.3) !important;
        }

        .leaflet-popup-content img {
            border-radius: 12px !important;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1) !important;
            margin: 8px 0 !important;
        }

        /* Routing Control Styling */
        .leaflet-routing-container {
            background: rgba(255, 255, 255, 0.98) !important;
            backdrop-filter: blur(20px) !important;
            border-radius: 16px !important;
            box-shadow: 0 12px 40px rgba(0, 0, 0, 0.15) !important;
            border: 1px solid rgba(255, 255, 255, 0.2) !important;
            font-family: 'Inter', sans-serif !important;
        }

        .leaflet-routing-alt {
            background: rgba(102, 126, 234, 0.05) !important;
            border-radius: 8px !important;
            margin: 4px 0 !important;
            padding: 8px !important;
        }

        .leaflet-routing-alt:hover {
            background: rgba(102, 126, 234, 0.1) !important;
        }

        /* User Location Marker Styling */
        .user-location-marker {
            background: linear-gradient(135deg, #48bb78, #38a169);
            border: 3px solid white;
            border-radius: 50%;
            box-shadow: 0 4px 12px rgba(72, 187, 120, 0.4);
        }

        /* Animation for map loading */
        @keyframes mapFadeIn {
            from {
                opacity: 0;
                transform: scale(0.95);
            }

            to {
                opacity: 1;
                transform: scale(1);
            }
        }

        #map {
            animation: mapFadeIn 0.6s ease-out;
        }

        /* Responsive adjustments */
        @media (max-width: 768px) {
            #map {
                border-radius: 8px;
                border-width: 2px;
            }

            .leaflet-control-layers {
                min-width: 160px;
            }

            .legend {
                min-width: 140px;
                padding: 16px;
            }
        }
    </style>
@endsection

@section('content')
    <div id="map"></div>

    <!-- Modal Create Point -->
    <div class="modal fade" id="CreatePointModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Create Point</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <form method="POST" action="{{ route('points.store') }}" enctype="multipart/form-data">
                    <div class="modal-body">
                        @csrf

                        <div class="mb-3">
                            <label for="name" class="form-label">Name</label>
                            <input type="text" class="form-control" id="name" name="name"
                                placeholder="Fill point name">
                        </div>

                        <div class="mb-3">
                            <label for="description" class="form-label">Description</label>
                            <textarea class="form-control" id="description" name="description" rows="3"></textarea>
                        </div>

                        <div class="mb-3">
                            <label for="geom_point" class="form-label">Geometry</label>
                            <textarea class="form-control" id="geom_point" name="geom_point" rows="3"></textarea>
                        </div>

                        <div class="mb-3">
                            <label for="image" class="form-label">Photo</label>
                            <input type="file" class="form-control" id="image_point" name="image"
                                onchange="document.getElementById('preview-image-point').src = window.URL.createObjectURL(this.files[0])">
                            <img src="" alt="" id="preview-image-point" class="img-thumbnail"
                                width="400">
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal Create Polyline -->
    <div class="modal fade" id="CreatePolylineModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Create Polyline</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <form method="POST" action="{{ route('polyline.store') }}" enctype="multipart/form-data">
                    <div class="modal-body">
                        @csrf

                        <div class="mb-3">
                            <label for="name" class="form-label">Name</label>
                            <input type="text" class="form-control" id="name" name="name"
                                placeholder="Fill point name">
                        </div>

                        <div class="mb-3">
                            <label for="description" class="form-label">Description</label>
                            <textarea class="form-control" id="description" name="description" rows="3"></textarea>
                        </div>

                        <div class="mb-3">
                            <label for="geom_polyline" class="form-label">Geometry</label>
                            <textarea class="form-control" id="geom_polyline" name="geom_polyline" rows="3"></textarea>
                        </div>

                        <div class="mb-3">
                            <label for="image" class="form-label">Photo</label>
                            <input type="file" class="form-control" id="image_polyline" name="image"
                                onchange="document.getElementById('preview-image-polyline').src = window.URL.createObjectURL(this.files[0])">
                            <img src="" alt="" id="preview-image-polyline" class="img-thumbnail"
                                width="400">
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal Create Polygon -->
    <div class="modal fade" id="CreatePolygonModal" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Create Polygon</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <form method="POST" action="{{ route('polygon.store') }}" enctype="multipart/form-data">
                    <div class="modal-body">
                        @csrf

                        <div class="mb-3">
                            <label for="name" class="form-label">Name</label>
                            <input type="text" class="form-control" id="name" name="name"
                                placeholder="Fill point name">
                        </div>

                        <div class="mb-3">
                            <label for="description" class="form-label">Description</label>
                            <textarea class="form-control" id="description" name="description" rows="3"></textarea>
                        </div>

                        <div class="mb-3">
                            <label for="geom_polygon" class="form-label">Geometry</label>
                            <textarea class="form-control" id="geom_polygon" name="geom_polygon" rows="3"></textarea>
                        </div>

                        <div class="mb-3">
                            <label for="image" class="form-label">Photo</label>
                            <input type="file" class="form-control" id="image_polygon" name="image"
                                onchange="document.getElementById('preview-image-polygon').src = window.URL.createObjectURL(this.files[0])">
                            <img src="" alt="" id="preview-image-polygon" class="img-thumbnail"
                                width="400">
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"
        integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/leaflet.draw/1.0.4/leaflet.draw.js"></script>

    <!-- Leaflet Routing Machine -->
    <script src="https://unpkg.com/leaflet-routing-machine@3.2.12/dist/leaflet-routing-machine.js"></script>

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

    <script src="https://unpkg.com/@terraformer/wkt"></script>

    <script>
        // Initialize map
        var map = L.map('map').setView([-7.962552408601181, 110.60869582604685], 11);

        // Base layers
        var openStreetMap = L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
        });

        var satelliteMap = L.tileLayer(
            'https://server.arcgisonline.com/ArcGIS/rest/services/World_Imagery/MapServer/tile/{z}/{y}/{x}', {
                attribution: 'Tiles &copy; Esri &mdash; Source: Esri, i-cubed, USDA, USGS, AEX, GeoEye, Getmapping, Aerogrid, IGN, IGP, UPR-EGP, and the GIS User Community'
            });

        // Add default base layer
        openStreetMap.addTo(map);

        // Base layers object for layer control
        var baseLayers = {
            "OpenStreetMap": openStreetMap,
            "Satellite": satelliteMap
        };

        // Variables for geolocation and routing
        var userLocation = null;
        var userLocationMarker = null;
        var routingControl = null;

        // Geolocation functionality
        function locateUser() {
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(
                    function(position) {
                        var lat = position.coords.latitude;
                        var lng = position.coords.longitude;

                        userLocation = [lat, lng];

                        // Remove existing user location marker
                        if (userLocationMarker) {
                            map.removeLayer(userLocationMarker);
                        }

                        // Create custom user location marker
                        userLocationMarker = L.circleMarker(userLocation, {
                            radius: 10,
                            fillColor: '#48bb78',
                            color: '#ffffff',
                            weight: 3,
                            opacity: 1,
                            fillOpacity: 0.8,
                            className: 'user-location-marker'
                        }).addTo(map);

                        userLocationMarker.bindPopup(
                            '<strong><i class="fa-solid fa-map-marker-alt"></i> Lokasi Anda</strong><br>Lat: ' + lat
                            .toFixed(6) + '<br>Lng: ' + lng.toFixed(6));

                        // Center map on user location
                        map.setView(userLocation, 15);

                        // Show success message
                        console.log('Lokasi berhasil ditemukan:', userLocation);
                    },
                    function(error) {
                        var errorMessage = '';
                        switch (error.code) {
                            case error.PERMISSION_DENIED:
                                errorMessage = "Akses lokasi ditolak oleh pengguna.";
                                break;
                            case error.POSITION_UNAVAILABLE:
                                errorMessage = "Informasi lokasi tidak tersedia.";
                                break;
                            case error.TIMEOUT:
                                errorMessage = "Permintaan lokasi timeout.";
                                break;
                            default:
                                errorMessage = "Terjadi kesalahan yang tidak diketahui.";
                                break;
                        }
                        alert('Error: ' + errorMessage);
                    }, {
                        enableHighAccuracy: true,
                        timeout: 10000,
                        maximumAge: 60000
                    }
                );
            } else {
                alert('Geolocation tidak didukung oleh browser ini.');
            }
        }

        // Add geolocation control
        var locateControl = L.control({
            position: 'topleft'
        });
        locateControl.onAdd = function(map) {
            var div = L.DomUtil.create('div', 'leaflet-control-locate leaflet-bar leaflet-control');
            div.innerHTML = '<a href="#" title="Temukan Lokasi Saya"><i class="fa-solid fa-crosshairs"></i></a>';

            L.DomEvent.on(div, 'click', function(e) {
                L.DomEvent.stopPropagation(e);
                L.DomEvent.preventDefault(e);
                locateUser();
            });

            return div;
        };
        locateControl.addTo(map);

        // Function to get directions to a destination
        function getDirections(destinationLat, destinationLng, destinationName) {
            console.log('getDirections called with:', destinationLat, destinationLng, destinationName);
            console.log('User location:', userLocation);

            if (!userLocation) {
                alert('Silakan temukan lokasi Anda terlebih dahulu dengan mengklik tombol lokasi (🎯).');
                return;
            }

            // Remove existing routing control
            if (routingControl) {
                console.log('Removing existing routing control');
                map.removeControl(routingControl);
                routingControl = null;
            }

            try {
                console.log('Creating routing control...');

                // Create new routing control
                routingControl = L.Routing.control({
                    waypoints: [
                        L.latLng(userLocation[0], userLocation[1]),
                        L.latLng(destinationLat, destinationLng)
                    ],
                    routeWhileDragging: false,
                    addWaypoints: false,
                    createMarker: function(i, waypoint, n) {
                        console.log('Creating marker', i, waypoint.latLng);
                        if (i === 0) {
                            // Start marker (user location)
                            return L.marker(waypoint.latLng, {
                                icon: L.icon({
                                    iconUrl: 'https://cdn.jsdelivr.net/gh/pointhi/leaflet-color-markers@master/img/marker-icon-green.png',
                                    shadowUrl: 'https://cdnjs.cloudflare.com/ajax/libs/leaflet/0.7.7/images/marker-shadow.png',
                                    iconSize: [25, 41],
                                    iconAnchor: [12, 41],
                                    popupAnchor: [1, -34],
                                    shadowSize: [41, 41]
                                })
                            }).bindPopup(
                                '<strong><i class="fa-solid fa-play"></i> Titik Awal</strong><br>Lokasi Anda');
                        } else {
                            // End marker (destination)
                            return L.marker(waypoint.latLng, {
                                icon: L.icon({
                                    iconUrl: 'https://cdn.jsdelivr.net/gh/pointhi/leaflet-color-markers@master/img/marker-icon-red.png',
                                    shadowUrl: 'https://cdnjs.cloudflare.com/ajax/libs/leaflet/0.7.7/images/marker-shadow.png',
                                    iconSize: [25, 41],
                                    iconAnchor: [12, 41],
                                    popupAnchor: [1, -34],
                                    shadowSize: [41, 41]
                                })
                            }).bindPopup(
                                '<strong><i class="fa-solid fa-flag-checkered"></i> Tujuan</strong><br>' +
                                destinationName);
                        }
                    },
                    router: L.Routing.osrmv1({
                        serviceUrl: 'https://router.project-osrm.org/route/v1',
                        profile: 'driving'
                    }),
                    lineOptions: {
                        styles: [{
                            color: '#667eea',
                            weight: 6,
                            opacity: 0.8
                        }]
                    },
                    show: true,
                    collapsible: true,
                    position: 'topright'
                });

                console.log('Adding routing control to map...');
                routingControl.addTo(map);

                // Handle routing events
                routingControl.on('routesfound', function(e) {
                    console.log('Routes found:', e.routes);
                    var routes = e.routes;
                    var summary = routes[0].summary;
                    var distance = (summary.totalDistance / 1000).toFixed(2);
                    var time = Math.round(summary.totalTime / 60);

                    console.log('Route summary - Distance:', distance, 'km, Time:', time, 'minutes');

                    // Show route info in a more user-friendly way
                    setTimeout(function() {
                        alert('Rute berhasil ditemukan!\n\nJarak: ' + distance + ' km\nEstimasi waktu: ' +
                            time +
                            ' menit\n\nLihat panel routing di kanan atas untuk detail petunjuk arah.');
                    }, 500);
                });

                routingControl.on('routingerror', function(e) {
                    console.error('Routing error:', e);
                    alert('Gagal menemukan rute. Silakan coba lagi atau periksa koneksi internet Anda.');
                });

            } catch (error) {
                console.error('Error creating routing control:', error);
                alert('Terjadi kesalahan saat membuat rute. Silakan coba lagi.');
            }
        }

        // Function to open in external maps
        function openInExternalMaps(lat, lng, name) {
            var userAgent = navigator.userAgent || navigator.vendor || window.opera;

            // Check if it's mobile device
            if (/android/i.test(userAgent)) {
                // Android - try Google Maps app first, fallback to web
                window.open('geo:' + lat + ',' + lng + '?q=' + lat + ',' + lng + '(' + encodeURIComponent(name) + ')',
                    '_blank');
            } else if (/iPad|iPhone|iPod/.test(userAgent) && !window.MSStream) {
                // iOS - try Apple Maps app first, fallback to Google Maps web
                window.open('maps://maps.google.com/maps?daddr=' + lat + ',' + lng + '&ll=', '_blank');
            } else {
                // Desktop - open Google Maps in new tab
                window.open('https://www.google.com/maps/dir/?api=1&destination=' + lat + ',' + lng +
                    '&destination_place_id=' + encodeURIComponent(name), '_blank');
            }
        }

        /* Digitize Function */
        var drawnItems = new L.FeatureGroup();
        map.addLayer(drawnItems);

        var drawControl = new L.Control.Draw({
            draw: {
                position: 'topleft',
                polyline: true,
                polygon: true,
                rectangle: true,
                circle: false,
                marker: true,
                circlemarker: false
            },
            edit: false
        });

        map.addControl(drawControl);

        map.on('draw:created', function(e) {
            var type = e.layerType,
                layer = e.layer;

            console.log(type);

            var drawnJSONObject = layer.toGeoJSON();
            var objectGeometry = Terraformer.geojsonToWKT(drawnJSONObject.geometry);

            console.log(drawnJSONObject);

            if (type === 'polyline') {
                console.log("Create " + type);
                $('#geom_polyline').val(objectGeometry);
                $('#CreatePolylineModal').modal('show');

            } else if (type === 'polygon' || type === 'rectangle') {
                console.log("Create " + type);
                $('#geom_polygon').val(objectGeometry);
                $('#CreatePolygonModal').modal('show');

            } else if (type === 'marker') {
                console.log("Create " + type);
                $('#geom_point').val(objectGeometry);
                $('#CreatePointModal').modal('show');

            } else {
                console.log('_undefined_');
            }

            drawnItems.addLayer(layer);
        });

        // Define custom icons for different types of tourism spots
        var touristIcon = L.icon({
            iconUrl: 'https://cdn.jsdelivr.net/gh/pointhi/leaflet-color-markers@master/img/marker-icon-red.png',
            shadowUrl: 'https://cdnjs.cloudflare.com/ajax/libs/leaflet/0.7.7/images/marker-shadow.png',
            iconSize: [25, 41],
            iconAnchor: [12, 41],
            popupAnchor: [1, -34],
            shadowSize: [41, 41]
        });

        // GeoJSON Points with enhanced popup including navigation buttons
        var point = L.geoJson(null, {
            pointToLayer: function(feature, latlng) {
                return L.marker(latlng, {
                    icon: touristIcon
                });
            },
            onEachFeature: function(feature, layer) {
                var routedelete = "{{ route('points.destroy', ':id') }}";
                routedelete = routedelete.replace(':id', feature.properties.id);

                var routeedit = "{{ route('points.edit', ':id') }}";
                routeedit = routeedit.replace(':id', feature.properties.id);

                var coordinates = layer.getLatLng();
                var lat = coordinates.lat;
                var lng = coordinates.lng;

                var popupContent = "<div style='min-width: 250px;'>" +
                    "<strong><i class='fa-solid fa-map-marker-alt'></i> " + feature.properties.name +
                    "</strong><br>" +
                    "<p><i class='fa-solid fa-info-circle'></i> " + feature.properties.description + "</p>" +
                    "<small><i class='fa-solid fa-calendar'></i> Dibuat: " + feature.properties.created_at +
                    "</small><br>" +
                    "<img src='{{ asset('storage/images') }}/" + feature.properties.images +
                    "' width='200' alt='' style='margin: 8px 0;'><br>" +

                    "<div style='margin: 10px 0;'>" +
                    "<button onclick='getDirections(" + lat + ", " + lng + ", \"" + feature.properties.name +
                    "\")' " +
                    "class='btn btn-success btn-sm' title='Dapatkan Petunjuk Arah'>" +
                    "<i class='fa-solid fa-route'></i> Petunjuk Arah</button> " +

                    "<button onclick='openInExternalMaps(" + lat + ", " + lng + ", \"" + feature.properties
                    .name + "\")' " +
                    "class='btn btn-info btn-sm' title='Buka di Aplikasi Maps'>" +
                    "<i class='fa-solid fa-external-link-alt'></i> Buka Maps</button>" +
                    "</div>" +

                    "<div style='margin: 10px 0;'>" +
                    "<a href='" + routeedit +
                    "' class='btn btn-warning btn-sm' title='Edit'><i class='fa-solid fa-pen-to-square'></i></a> " +
                    "<form method='POST' action='" + routedelete + "' style='display: inline;'>" +
                    `@csrf @method('DELETE')` +
                    "<button type='submit' class='btn btn-sm btn-danger' title='Hapus' " +
                    "onClick=\"return confirm('Yakin akan dihapus?')\">" +
                    "<i class='fa-solid fa-trash-can'></i>" +
                    "</button>" +
                    "</form>" +
                    "</div>" +


                    "</div>";

                layer.on({
                    click: function(e) {
                        layer.bindPopup(popupContent, {
                            maxWidth: 300,
                            className: 'custom-popup'
                        }).openPopup();
                    },
                    mouseover: function(e) {
                        layer.bindTooltip(feature.properties.name, {
                            permanent: false,
                            direction: 'top'
                        });
                    },
                });
            },
        });

        // GeoJSON Polyline with enhanced popup
        var polyline = L.geoJson(null, {
            onEachFeature: function(feature, layer) {
                var routedelete = "{{ route('polyline.destroy', ':id') }}";
                routedelete = routedelete.replace(':id', feature.properties.id);

                var routeedit = "{{ route('polyline.edit', ':id') }}";
                routeedit = routeedit.replace(':id', feature.properties.id);

                // Get center point of polyline for navigation
                var bounds = layer.getBounds();
                var center = bounds.getCenter();
                var lat = center.lat;
                var lng = center.lng;

                var popupContent = "<div style='min-width: 250px;'>" +
                    "<strong><i class='fa-solid fa-route'></i> " + feature.properties.name + "</strong><br>" +
                    "<p><i class='fa-solid fa-info-circle'></i> " + feature.properties.description + "</p>" +
                    "<p><i class='fa-solid fa-ruler'></i> Panjang: " + feature.properties.length_km + " km</p>" +
                    "<small><i class='fa-solid fa-calendar'></i> Dibuat: " + feature.properties.created_at +
                    "</small><br>" +
                    "<img src='{{ asset('storage/images') }}/" + feature.properties.images +
                    "' width='200' alt='' style='margin: 8px 0;'><br>" +

                    "<div style='margin: 10px 0;'>" +
                    "<button onclick='getDirections(" + lat + ", " + lng + ", \"" + feature.properties.name +
                    "\")' " +
                    "class='btn btn-success btn-sm' title='Dapatkan Petunjuk Arah'>" +
                    "<i class='fa-solid fa-route'></i> Petunjuk Arah</button> " +

                    "<button onclick='openInExternalMaps(" + lat + ", " + lng + ", \"" + feature.properties
                    .name + "\")' " +
                    "class='btn btn-info btn-sm' title='Buka di Aplikasi Maps'>" +
                    "<i class='fa-solid fa-external-link-alt'></i> Buka Maps</button>" +
                    "</div>" +

                    "<div style='margin: 10px 0;'>" +
                    "<a href='" + routeedit +
                    "' class='btn btn-warning btn-sm' title='Edit'><i class='fa-solid fa-pen-to-square'></i></a> " +
                    "<form method='POST' action='" + routedelete + "' style='display: inline;'>" +
                    `@csrf @method('DELETE')` +
                    "<button type='submit' class='btn btn-sm btn-danger' title='Hapus' " +
                    "onClick=\"return confirm('Yakin akan dihapus?')\">" +
                    "<i class='fa-solid fa-trash-can'></i>" +
                    "</button>" +
                    "</form>" +
                    "</div>" +

                    "<small><i class='fa-solid fa-user'></i> Dibuat oleh: " + feature.properties.user_created +
                    "</small>" +
                    "</div>";

                layer.on({
                    click: function(e) {
                        layer.bindPopup(popupContent, {
                            maxWidth: 300,
                            className: 'custom-popup'
                        }).openPopup();
                    },
                    mouseover: function(e) {
                        layer.bindTooltip(feature.properties.name, {
                            permanent: false,
                            direction: 'top'
                        });
                    },
                });
            },
        });

        // GeoJSON Polygon with enhanced popup
        var polygon = L.geoJson(null, {
            onEachFeature: function(feature, layer) {
                var routedelete = "{{ route('polygon.destroy', ':id') }}";
                routedelete = routedelete.replace(':id', feature.properties.id);

                var routeedit = "{{ route('polygon.edit', ':id') }}";
                routeedit = routeedit.replace(':id', feature.properties.id);

                // Get center point of polygon for navigation
                var bounds = layer.getBounds();
                var center = bounds.getCenter();
                var lat = center.lat;
                var lng = center.lng;

                var popupContent = "<div style='min-width: 250px;'>" +
                    "<strong><i class='fa-solid fa-draw-polygon'></i> " + feature.properties.name + "</strong><br>" +
                    "<p><i class='fa-solid fa-info-circle'></i> " + feature.properties.description + "</p>" +
                    "<p><i class='fa-solid fa-expand-arrows-alt'></i> Luas: " + feature.properties.area_hektar +
                    " hektar</p>" +
                    "<small><i class='fa-solid fa-calendar'></i> Dibuat: " + feature.properties.created_at +
                    "</small><br>" +
                    "<img src='{{ asset('storage/images') }}/" + feature.properties.images +
                    "' width='200' alt='' style='margin: 8px 0;'><br>" +

                    "<div style='margin: 10px 0;'>" +
                    "<button onclick='getDirections(" + lat + ", " + lng + ", \"" + feature.properties.name +
                    "\")' " +
                    "class='btn btn-success btn-sm' title='Dapatkan Petunjuk Arah'>" +
                    "<i class='fa-solid fa-route'></i> Petunjuk Arah</button> " +

                    "<button onclick='openInExternalMaps(" + lat + ", " + lng + ", \"" + feature.properties
                    .name + "\")' " +
                    "class='btn btn-info btn-sm' title='Buka di Aplikasi Maps'>" +
                    "<i class='fa-solid fa-external-link-alt'></i> Buka Maps</button>" +
                    "</div>" +

                    "<div style='margin: 10px 0;'>" +
                    "<a href='" + routeedit +
                    "' class='btn btn-warning btn-sm' title='Edit'><i class='fa-solid fa-pen-to-square'></i></a> " +
                    "<form method='POST' action='" + routedelete + "' style='display: inline;'>" +
                    `@csrf @method('DELETE')` +
                    "<button type='submit' class='btn btn-sm btn-danger' title='Hapus' " +
                    "onClick=\"return confirm('Yakin akan dihapus?')\">" +
                    "<i class='fa-solid fa-trash-can'></i>" +
                    "</button>" +
                    "</form>" +
                    "</div>" +

                    "<small><i class='fa-solid fa-user'></i> Dibuat oleh: " + feature.properties.user_created +
                    "</small>" +
                    "</div>";

                layer.on({
                    click: function(e) {
                        layer.bindPopup(popupContent, {
                            maxWidth: 300,
                            className: 'custom-popup'
                        }).openPopup();
                    },
                    mouseover: function(e) {
                        layer.bindTooltip(feature.properties.name, {
                            permanent: false,
                            direction: 'top'
                        });
                    },
                });
            },
        });

        // Road symbolization function based on REK_TRANSP
        function getRoadStyle(rekTransp) {
            switch (rekTransp) {
                case 'Jalan Kaki':
                    return {
                        color: '#ff7800',
                            weight: 2,
                            opacity: 0.8,
                            dashArray: '5, 5'
                    };
                case 'Motor':
                    return {
                        color: '#00ff00',
                            weight: 3,
                            opacity: 0.8
                    };
                case 'Mobil':
                    return {
                        color: '#0066cc',
                            weight: 5,
                            opacity: 0.8
                    };
                case 'Jeep/Trail':
                    return {
                        color: '#cc0000',
                            weight: 4,
                            opacity: 0.8,
                            dashArray: '10, 5'
                    };
                default:
                    return {
                        color: '#808080',
                            weight: 2,
                            opacity: 0.6
                    };
            }
        }

        // Variable to hold road layer
        var roadLayer;

        // Create overlay layers object
        var overlayLayers = {};

        // Load data and populate layers
        $.getJSON("{{ route('api.points') }}", function(data) {
            point.addData(data);
            overlayLayers["Titik Wisata"] = point;
            updateLayerControl();
        });

        $.getJSON("{{ route('api.polyline') }}", function(data) {
            polyline.addData(data);
            overlayLayers["Polyline"] = polyline;
            updateLayerControl();
        });

        $.getJSON("{{ route('api.polygon') }}", function(data) {
            polygon.addData(data);
            overlayLayers["Polygon"] = polygon;
            updateLayerControl();
        });

        // Add road layer when loaded
        $.getJSON("{{ asset('geojson/jalan_2d.geojson') }}", function(data) {
            roadLayer = L.geoJSON(data, {
                style: function(feature) {
                    return getRoadStyle(feature.properties.REK_TRANSP);
                },
                onEachFeature: function(feature, layer) {
                    var popupContent = "<strong>Jalan: " + (feature.properties.NAMA || 'Unnamed') +
                        "</strong><br>" +
                        "Rekomendasi Transportasi: " + (feature.properties.REK_TRANSP ||
                            'Tidak diketahui') + "<br>";

                    if (feature.properties.PANJANG) {
                        popupContent += "Panjang: " + feature.properties.PANJANG + " meter<br>";
                    }

                    layer.bindPopup(popupContent);
                    layer.bindTooltip(feature.properties.REK_TRANSP || 'Jalan');
                }
            }).addTo(map);

            overlayLayers["Jalan"] = roadLayer;
            updateLayerControl();
        });

        // Layer control variable
        var layerControl;

        // Function to update layer control
        function updateLayerControl(collapsed = true) {
            if (layerControl) {
                map.removeControl(layerControl);
            }

            layerControl = L.control.layers(baseLayers, overlayLayers, {
                position: 'topright',
                collapsed: collapsed, // Bisa diatur true/false
                autoZIndex: true,
                hideSingleBase: false
            }).addTo(map);
        }

        // Add simple legend - cuma kotak ungu kecil
        var legend = L.control({
            position: 'bottomright'
        });

        legend.onAdd = function(map) {
            var div = L.DomUtil.create('div', 'simple-legend');

            // Create simple purple button
            var toggleBtn = L.DomUtil.create('div', 'simple-legend-btn', div);
            toggleBtn.title = 'Legenda Jalan';

            // Create content container (hidden by default)
            var content = L.DomUtil.create('div', 'simple-legend-content', div);
            content.style.display = 'none';

            // Add title
            content.innerHTML = '<div class="legend-title"><strong>Rekomendasi Transportasi</strong></div>';

            var roadTypes = [{
                    type: 'Jalan Kaki',
                    color: '#ff7800',
                    style: 'dashed'
                },
                {
                    type: 'Motor',
                    color: '#00ff00',
                    style: 'solid'
                },
                {
                    type: 'Mobil',
                    color: '#0066cc',
                    style: 'solid'
                },
                {
                    type: 'Jeep/Trail',
                    color: '#cc0000',
                    style: 'dashed'
                }
            ];

            roadTypes.forEach(function(road) {
                var item = document.createElement('div');
                item.className = 'legend-item';

                var line = document.createElement('div');
                line.className = 'legend-line';
                line.style.backgroundColor = road.color;
                line.style.border = '1px solid ' + road.color;
                if (road.style === 'dashed') {
                    line.style.borderStyle = 'dashed';
                    line.style.backgroundColor = 'transparent';
                }

                var span = document.createElement('span');
                span.textContent = road.type;

                item.appendChild(line);
                item.appendChild(span);
                content.appendChild(item);
            });

            // Click event untuk toggle
            L.DomEvent.on(toggleBtn, 'click', function(e) {
                L.DomEvent.preventDefault(e);
                L.DomEvent.stopPropagation(e);

                if (content.style.display === 'none') {
                    content.style.display = 'block';
                } else {
                    content.style.display = 'none';
                }
            });

            // Prevent map interaction
            L.DomEvent.disableClickPropagation(div);
            L.DomEvent.disableScrollPropagation(div);

            return div;
        };

        legend.addTo(map);

        // Function untuk toggle layer control
        function toggleLayerControl() {
            var isCollapsed = layerControl.options.collapsed;
            updateLayerControl(!isCollapsed);
        }

        // CSS untuk simple legend - cuma kotak ungu kecil
        var legendStyle = `
<style>
/* Simple legend - kotak ungu kecil */
.simple-legend {
    position: relative;
}

.simple-legend-btn {
    width: 30px;
    height: 30px;
    background-color: #7b68ee;
    border-radius: 4px;
    cursor: pointer;
    box-shadow: 0 1px 5px rgba(0,0,0,0.4);
    border: 2px solid rgba(0,0,0,0.2);
}

.simple-legend-btn:hover {
    background-color: #6a5acd;
}

.simple-legend-content {
    position: absolute;
    bottom: 35px;
    right: 0;
    background: white;
    border-radius: 4px;
    border: 2px solid rgba(0,0,0,0.2);
    box-shadow: 0 1px 5px rgba(0,0,0,0.4);
    padding: 8px;
    min-width: 120px;
    z-index: 1000;
}

.legend-title {
    margin-bottom: 6px;
    color: #333;
    font-size: 13px;
    font-weight: bold;
}

.legend-item {
    display: flex;
    align-items: center;
    margin-bottom: 4px;
    font-size: 12px;
    color: #333;
}

.legend-line {
    width: 16px;
    height: 3px;
    margin-right: 6px;
    flex-shrink: 0;
}

.legend-item span {
    color: #333;
    font-size: 12px;
}

/* Custom styling untuk layer control yang ada */
.leaflet-control-layers {
    border-radius: 4px;
    border: 2px solid rgba(0,0,0,0.2);
    box-shadow: 0 1px 5px rgba(0,0,0,0.4);
}

.leaflet-control-layers-toggle {
    background-color: #fff;
    border-radius: 4px;
}

.leaflet-control-layers-expanded {
    background: white;
    border-radius: 4px;
}

/* Pastikan text dalam layer control tidak putih */
.leaflet-control-layers-list,
.leaflet-control-layers-list *,
.leaflet-control-layers label,
.leaflet-control-layers label *,
.leaflet-control-layers span {
    color: #333 !important;
    font-size: 13px !important;
}
</style>
`;

        // Tambahkan CSS ke head
        document.head.insertAdjacentHTML('beforeend', legendStyle);

        // Inisialisasi layer control (collapsed by default)
        updateLayerControl(true);

        // Optional: Tambahkan event listener untuk auto-collapse layer control setelah selection
        map.on('baselayerchange overlayeradd overlayremove', function() {
            // Auto collapse setelah 3 detik
            setTimeout(function() {
                if (layerControl && !layerControl.options.collapsed) {
                    updateLayerControl(true);
                }
            }, 3000);
        });

        // Initialize with default layers
        updateLayerControl();

        // Make functions globally available
        window.getDirections = getDirections;
        window.openInExternalMaps = openInExternalMaps;

        // Debug: Check if Leaflet Routing Machine is loaded
        console.log('Leaflet Routing Machine loaded:', typeof L.Routing !== 'undefined');
        console.log('L.Routing object:', L.Routing);
    </script>
@endsection
