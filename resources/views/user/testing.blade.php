
@extends('components/layout')
@section('content')

<div class="flex">
    
    <div class="w-1/3 py-8 pl-8">
        <select name="" id="" class="bg-white drop-shadow-md rounded-md w-full mr-4 py-2 px-4 appearance-none">
            <option value="0">Choose Year</option>
            @foreach (App\Models\Questionnaire::all() as $questionnaire_option)
                <option value={{$questionnaire_option->id}} {{isset($questionnaire) && $questionnaire_option->id == $questionnaire->id ? "selected" : ""}} >{{$questionnaire_option->year}}</option> 
            @endforeach
        </select>
        <select name="" id="" class="mt-4 bg-white drop-shadow-md rounded-md w-full mr-4 py-2 px-4 appearance-none">
            <option value="0">Choose Province</option>
            @foreach (App\Models\Province::all() as $province_option)
                <option value={{$province_option->id}} {{isset($province) && $province_option->id == $province->id ? "selected" : ""}} >{{$province_option->name}}</option> 
            @endforeach
        </select>
        <div class="mt-4 bg-white drop-shadow-md rounded-md">
            @foreach (App\Models\Province::join("cities", "cities.id", "provinces.id")
                    ->join("responses","responses.city_id","cities.id")
                    ->whereNotNull("provinces.longitude")
                    ->groupBy("provinces.id")
                    ->orderBy("cpi_score", "desc")
                    ->select("provinces.name", "provinces.id as provinceId", "provinces.latitude", "provinces.longitude")
                    ->selectRaw("CAST(AVG(responses.corruption_index) as DECIMAL(10,0)) as cpi_score")
                    ->get() as $province)
        <div class="px-4 py-4 flex justify-between items-center">
            <div>
                <p><b>{{$province->name}}</b></p>
                <p>CPI Score: {{$province->cpi_score}}</p>
            </div>
            <div>
                <p>Rank</p>
            </div>
        </div>

        @endforeach
        </div>
    </div>
    {{-- <div class="w-100 h-full"> --}}
        <div id='myMap' class="w-full h-screen mx-8 mt-8 mb-8">

        </div>
    {{-- </div> --}}
</div>




    <script type='text/javascript'>
        var map;
        function loadMapScenario() {

            var indonesiaBoundingBox = Microsoft.Maps.LocationRect.fromEdges(11.08, 94.97, -10.94, 141.03);

            map = new Microsoft.Maps.Map(document.getElementById('myMap'), {
                center: new Microsoft.Maps.Location(-0.789275, 113.921327),
                mapTypeId: Microsoft.Maps.MapTypeId.Aerial,
                minZoom: 5,
                zoom: 5,
                // maxZoom: 5,
                showBoundary: false,
                showDashboard: false,
                enableSearchLogo: false,
                enableClickableLogo: false,
                labelOverlay: Microsoft.Maps.LabelOverlay.hidden,
                customMapStyle: {
                    elements: {
                        area: {
                            fillColor: '#2B8CBE',
                            // visible: function (feature) { // hide the Singapore and Malaysia areas
                            //     return !(feature.getProperty('ADMIN') === 'Singapore' || feature.getProperty('ADMIN') === 'Malaysia');
                            // }
                        },
                        water: { fillColor: '#EAF4F8' },
                        tollRoad: { fillColor: '#FFFFFF', strokeColor: '#FFFFFF' },
                        arterialRoad: { fillColor: '#FFFFFF', strokeColor: '#FFFFFF' },
                        road: { fillColor: '#FFFFFF', strokeColor: '#FFFFFF' },
                        street: { fillColor: '#FFFFFF', strokeColor: '#FFFFFF' },
                        transit: { fillColor: '#FFFFFF' }
                    },
                    settings: {
                        landColor: '#2B8CBE',
                        // visible: function (feature) { // hide the Singapore and Malaysia areas
                        //         return !(feature.getProperty('ADMIN') === 'Singapore' || feature.getProperty('ADMIN') === 'Malaysia');
                        //     }
                    }
                }
            });

            // Define the vertices that create the outline of Indonesia
            var indonesiaCoords = [
                new Microsoft.Maps.Location(-5.982440, 106.654880),
                new Microsoft.Maps.Location(-6.121490, 106.764930),
                new Microsoft.Maps.Location(-6.271370, 106.830860),
                new Microsoft.Maps.Location(-6.304100, 106.789740),
                new Microsoft.Maps.Location(-6.216540, 106.702480),
                new Microsoft.Maps.Location(-6.099970, 106.587520),
                new Microsoft.Maps.Location(-5.982440, 106.654880)
            ]


            var indonesiaPolygon = new Microsoft.Maps.Polygon(indonesiaCoords, {
                fillColor: 'rgba(0, 0, 255, 0.5)',
                strokeColor: 'black',
                strokeThickness: 2
            });

            // Add the polygon to the map
            map.entities.push(indonesiaPolygon);

            map.setView({ bounds: indonesiaBoundingBox });

            let token = $('meta[name="csrf-token"]').attr('content')

            $.ajax({
                method: 'GET',
                url: '/getProvinces',
                headers: {
                    'X-CSRF-TOKEN': token
                }
            }).done((response)=>{
                if(!response.error){
                    let provinces = response.provinces
                    provinces.forEach(p => {

                        let color = "#4EB3D3"

                        if(p.cpi_score <= 2){
                            color = "#2B8CBE"
                        }
                        else if(p.cpi_score <= 3){
                            color = "#225EA8"
                        }
                        else if(p.cpi_score <= 4){
                            color = "#084081"
                        }
                        else if(p.cpi_score <= 5){
                            color = "#081D58"
                        }

                        var location = new Microsoft.Maps.Location(p.latitude, p.longitude);

                        // Create pushpins
                        var pushpin = new Microsoft.Maps.Pushpin(location, {
                            // title: p.name,
                            text: p.cpi_score,
                            // subtitle: p.name,
                            textColor: 'black',
                            // icon: 'https://www.bingmapsportal.com/Content/images/poi_custom.png',
                            color: color
                        });

                        pushpin.setOptions({ enableHoverStyle: true, enableClickedStyle: true });

                        var infobox = new Microsoft.Maps.Infobox(location, {
                            title: p.name,
                            description: "Corruption Score: " + p.cpi_score,
                            visible: false
                        });

                        // Associate the infobox with the pushpin using the mouseover event
                        Microsoft.Maps.Events.addHandler(pushpin, 'mouseover', function () {
                            infobox.setOptions({ visible: true });
                        });

                        // Associate the infobox with the pushpin using the mouseout event
                        Microsoft.Maps.Events.addHandler(pushpin, 'mouseout', function () {
                            infobox.setOptions({ visible: false });
                        });

                        // Add the pushpin and infobox to the map
                        map.entities.push(pushpin);
                        map.entities.push(infobox);
                    });
                }
            })

            $.ajax({
                method: 'GET',
                url: '/getCitiesResult',
                headers: {
                    'X-CSRF-TOKEN': token
                }
            }).done((response)=>{
                if(!response.error){
                    let cities = response.cities
                    cities.forEach(c => {

                        let color = "#4EB3D3"

                        if(c.cpi_score <= 2){
                            color = "#2B8CBE"
                        }
                        else if(c.cpi_score <= 3){
                            color = "#225EA8"
                        }
                        else if(c.cpi_score <= 4){
                            color = "#084081"
                        }
                        else if(c.cpi_score <= 5){
                            color = "#081D58"
                        }

                        var location = new Microsoft.Maps.Location(c.latitude, c.longitude);

                        // Create pushpins
                        var pushpin = new Microsoft.Maps.Pushpin(location, {
                            // title: p.name,
                            // text: c.cpi_score,
                            // textColor: 'black',
                            // icon: 'https://www.bingmapsportal.com/Content/images/poi_custom.png',
                            color: color,
                            // iconSize: new Microsoft.Maps.Point(4, 4)
                        });

                        pushpin.setOptions({ enableHoverStyle: true, enableClickedStyle: true });

                        map.entities.push(pushpin);
                    });
                }
            })

        }


    </script>
@endsection