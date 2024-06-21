@extends('master.layout')
@section('content')
    <div id="map"></div>
    <div id="popup" class="popup absolute" style="z-index: 100;"></div>


    <style>
        #map {
            height: 90vh;
            z-index: 0;
        }
    </style>
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"
        integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>

    <script>
        var modal = document.getElementById('popup');
        modal.style.display = 'none'; // Initially, hide the modal
        var map = L.map('map', {
            minZoom: 6,
            maxZoom: 9
        }).setView([{{ $province->latitude }}, {{ $province->longitude }}], 7.5);

        L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
            maxZoom: 19,
            attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
        }).addTo(map);
        var geoJsonData = @json($filteredGeojson);

        function getColor(d) {
            return d > 80 ? '#5FB4BB' :
                d > 60 ? '#B0BE71' :
                d > 40 ? '#FFC825' :
                d > 20 ? '#FF8F2B' :
                d >= 0 ? '#FF3737' : '#6d7072'
        }

        var stateToIndexMap = {
            @foreach ($city as $c)
                "{{ strtoupper($c->name) }}": {{ $c->index_result }},
            @endforeach
        };


        function getColorByState(state) {
            var indexResult = stateToIndexMap[state];
            return getColor(indexResult);
        }

        var info = L.control();
        info.setPosition('topright');
        info.onAdd = function(map) {
            this._div = L.DomUtil.create('div'); // create a div with a class "info"
            this.update();
            return this._div;
        };

        // method that we will use to update the control based on feature properties passed
        function getCorruptionLevel(indexResult, city) {
            var tableDiv = '<div class="overflow-x-auto"><table class="table table-zebra">'

            tableDiv += '<tr><th>City</th><th>' + city + '</th></tr>'
            tableDiv += '<tr><th>CPI</th><th>' + indexResult + '</th></tr>'
            tableDiv += '<tr>'
            if (indexResult >= 0 && indexResult <= 20) {
                tableDiv +=
                    '<th>Status</th><th><div style="background-color:#FF3737" class="p-1 w-auto rounded-md font-semibold text-center text-white"> Tingkat Korupsi Sangat Tinggi</div></th>';
            } else if (indexResult > 20 && indexResult <= 40) {
                tableDiv +=
                    '<th>Status</th><th><div style="background-color:#FF8F2B" class="p-1 w-auto rounded-md font-semibold text-center text-white"> Tingkat Korupsi Tinggi</div></th>';
            } else if (indexResult > 40 && indexResult <= 60) {
                tableDiv +=
                    '<th>Status</th><th><div style="background-color:#FFC825" class="p-1 w-auto rounded-md font-semibold text-center text-white"> Tingkat Korupsi Sedang</div></th>';
            } else if (indexResult > 60 && indexResult <= 80) {
                tableDiv +=
                    '<th>Status</th><th><div style="background-color:#B0BE71" class="p-1 w-auto rounded-md font-semibold text-center text-white"> Tingkat Korupsi Rendah</div></th>';
            } else if (indexResult > 80 && indexResult <= 100) {
                tableDiv +=
                    '<th>Status</th><th><div style="background-color:#5FB4BB" class="p-1 w-auto rounded-md font-semibold text-center text-white"> Sangat Korupsi Sangat Rendah</div></th>';
            }else{
                tableDiv +=
                '<th>Status</th><th><div style="background-color:#6d7072" class="p-1 w-auto rounded-md font-semibold text-center text-white">Undefined</div></th>';
            }
            tableDiv += '</tr>'


            tableDiv += '</table></div>'
            return tableDiv

        }

        info.update = function(props) {
            // this._div.innerHTML = '<h4>Indonesia CPI</h4>';
            var corruptionLevel = null
            @foreach ($city as $p)
                if ('{{ strtoupper($p->name) }}' === props) {
                    var corruptionLevel = getCorruptionLevel({{ $p->index_result }}, props);
                    modal.innerHTML =
                        corruptionLevel;
                }
            @endforeach

            // If no matching province is found
            // if (!props) {
            //     this._div.innerHTML += 'Hover over a province';
            // }
            if (corruptionLevel == null) {
                var corruptionLevel = getCorruptionLevel("undefined", props);
                    // this._div.innerHTML = corruptionLevel;
                modal.innerHTML = corruptionLevel;
            }
        };


        info.addTo(map);

        // end info

        // interaction

        var geojson;

        function highlightFeature(e) {
            var layer = e.target;
            var cursorPosition = e.originalEvent;
            layer.setStyle({
                weight: 5,
                color: '#666',
                dashArray: '',
                fillOpacity: 0.7
            });
            layer.bringToFront();
            info.update(layer.feature.properties.alt_name);
            // Show the modal
            modal.style.display = 'block';

            // Update modal position based on cursor position
            modal.style.left = cursorPosition.pageX+50 + 'px';
            modal.style.top = cursorPosition.pageY + 'px';
        }

        function resetHighlight(e) {
            geojson.resetStyle(e.target);
            info.update();
            modal.style.display = 'none';
        }

        function zoomToFeature(e) {
            map.fitBounds(e.target.getBounds());
        }

        function onEachFeature(feature, layer) {
            layer.on({
                mouseover: highlightFeature,
                mouseout: resetHighlight,
                click: zoomToFeature
            });
        }

        geojson = L.geoJson(geoJsonData, {
            style: function(e) {
                return {
                    fillColor: getColorByState(e.properties.alt_name),
                    weight: 2,
                    opacity: 1,
                    color: 'white',
                    dashArray: '3',
                    fillOpacity: 0.7
                };
            },
            onEachFeature: onEachFeature
        }).addTo(map)

        var legend = L.control({
            position: 'bottomright'
        });

        legend.onAdd = function(map) {

            var div = L.DomUtil.create('div', 'info legend rounded-md'),
                grades = [ 0, 20, 40, 60, 80, 100],
                labels = [
                    "Tingkat Korupsi Sangat Tinggi",
                    "Tingkat Korupsi Tinggi",
                    "Tingkat Korupsi Sedang",
                    "Tingkat Korupsi Rendah",
                    "Tingkat Korupsi Sangat Rendah"
                ];

            // loop through our density intervals and generate a label with a colored square for each interval
            for (var i = 0; i < grades.length - 1; i++) {
                div.innerHTML +=
                    '<div class="py-1 px-4"><i style="background:' + getColor(grades[i] + 1) + '"></i> ' +
                    grades[i] + '&ndash;' + grades[i + 1] + ' ' + labels[i] + '<br>' + "</div>";
            }

            return div;
        };

        legend.addTo(map);
    </script>

    <style>
        .info, #popup{
            padding: 3px 4px;
            font: 14px/16px Arial, Helvetica, sans-serif;
            background: white;
            background: rgba(255, 255, 255, 0.8);
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.2);
            border-radius: 5px;
        }

        #popup h4{
            margin: 0 0 5px;
            color: #777;
        }

        .legend {
            line-height: 18px;
            color: #555;
            background-color: white;
        }

        .legend i {
            width: 18px;
            height: 18px;
            float: left;
            margin-right: 8px;
            opacity: 0.7;
        }
    </style>
@endsection
