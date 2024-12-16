<!DOCTYPE html>
<html>
<head>
    <title>Peta Fasilitas Kesehatan di Malang</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" />
    <link rel="stylesheet" href="https://unpkg.com/leaflet.markercluster/dist/MarkerCluster.css" />
    <link rel="stylesheet" href="https://unpkg.com/leaflet.markercluster/dist/MarkerCluster.Default.css" />
    <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"></script>
    <script src="https://unpkg.com/leaflet.markercluster/dist/leaflet.markercluster.js"></script>
</head>
<body>
    <div id="map" style="width: 100%; height: 600px;"></div>

    <?php
    // Data koordinat dan nama fasilitas
    $addressPoints = [
        // Apotek
        [-7.9753, 112.6324, "Apotek Kimia Farma Malang"],
        [-7.9767, 112.6281, "Apotek K24 Malang"],
        [-7.9711, 112.6313, "Apotek Century Malang"],

        // Rumah Sakit
        [-7.9735, 112.6333, "RSUD Dr. Saiful Anwar Malang"],
        [-7.9690, 112.6231, "RSU Lavalette Malang"],
        [-7.9647, 112.6322, "RS Sumber Waras Malang"],
        [-7.9901, 112.6235, "RS Hermina Malang"],

        // Puskesmas
        [-7.9793, 112.6348, "Puskesmas Blimbing"],
        [-7.9815, 112.6343, "Puskesmas Kedungkandang"],
        [-7.9641, 112.6370, "Puskesmas Malang Kota"],
        [-7.9770, 112.6314, "Puskesmas Sukun"]
    ];
    ?>

    <script>
        // Membuat peta dan menentukannya di Kota Malang
        var map = L.map('map').setView([-7.9666, 112.6326], 13); // Koordinat pusat Malang

        // Menambahkan layer tile map dari OpenStreetMap
        var basemap1 = L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: 'Map data &copy; <a href="https://www.openstreetmap.org">OpenStreetMap</a> contributors'
        });
        basemap1.addTo(map);

        var markers = L.markerClusterGroup(); // Grup untuk menambahkan marker secara kolektif

        // Data lokasi dari PHP ke JavaScript
        var addressPoints = <?php echo json_encode($addressPoints); ?>;

        // Loop untuk menambahkan marker ke peta
        for (var i = 0; i < addressPoints.length; i++) {
            var a = addressPoints[i];
            var title1 = a[2]; // Nama fasilitas
            var marker = L.marker(new L.LatLng(a[0], a[1]), {
                title: title1
            });

            // Menambahkan tooltip dan popup
            marker.bindTooltip(title1, { permanent: false, direction: "top" });
            marker.bindPopup("<b>" + title1 + "</b><br>Koordinat: " + a[0] + ", " + a[1]);

            markers.addLayer(marker); // Menambahkan marker ke grup
        }

        // Menambahkan marker cluster ke peta
        map.addLayer(markers);
    </script>
</body>
</html>
