<!-- field_type_name -->
@php
    $value = data_get($entry, $column['name']);
    $column['value'] = $value;
@endphp
<div @include('crud::inc.field_wrapper_attributes') >
    <input
        type="hidden"
        name="{{ $column['name'] }}"
        id="{{ $column['name'] }}"
        value="{{ old($column['name']) ? old($column['name']) : (isset($column['value']) ? $column['value'] : (isset($column['default']) ? $column['default'] : '' )) }}"
        @include('crud::inc.field_attributes')
    >
    <div id="{{ $column['name'] }}-map-container" style="width:100%;height:400px; ">
        <input id="pac-input" class="controls" type="text" placeholder="Search Box">
        <div id="map_canvas" style="height:400px;"></div>
    </div>
    <script>
        var marker = null;
        var map = null;
        function initialize() {
            var oldlocation = { lat: 7.028304, lng: 80.340675 };
            if(document.getElementById("{{ $column['name'] }}").value != '')
            {
                var obj = JSON.parse(document.getElementById("{{ $column['name'] }}").value);
                if(typeof obj === 'object')
                {
                    var oldlocation = { lat: obj.lat, lng: obj.lng };
                }
            }
            map = new google.maps.Map(document.getElementById('map_canvas'), {
                zoom: 9,
                center: oldlocation
            });

            var input = document.getElementById('pac-input');
            var searchBox = new google.maps.places.SearchBox(input);
            map.controls[google.maps.ControlPosition.TOP_LEFT].push(input);

            map.addListener('bounds_changed', function() {
                searchBox.setBounds(map.getBounds());
            });

            // This event listener calls addMarker() when the map is clicked.
            google.maps.event.addListener(map, 'click', function(event) {
                if (marker) {
                    marker.setMap(null);
                    marker = null;
                }
                addMarker(event.latLng, map);
            });
            // Add a marker fron the beginig
            addMarker(oldlocation, map);
        }
        // Adds a marker to the map.
        function addMarker(location, map) {
            // Add the marker at the clicked location, and add the next-available label
            // from the array of alphabetical characters.
            marker = new google.maps.Marker({
                position: location,
                map: map
            });
            var values = {
                "lat": location.lat(),
                "lng": location.lng()
            }
            console.log(values);
            document.getElementById("{{ $column['name'] }}").value = JSON.stringify(values);
        }
        google.maps.event.addDomListener(window, 'load', initialize);
    </script>

    {{-- HINT --}}
    @if (isset($column['hint']))
        <p class="help-block">{!! $column['hint'] !!}</p>
    @endif
</div>


{{-- FIELD EXTRA CSS  --}}
{{-- push things in the after_styles section --}}

@push('crud_fields_styles')
    <!-- no styles -->
@endpush

{{-- FIELD EXTRA JS --}}
{{-- push things in the after_scripts section --}}


    <!-- no scripts -->
    <script src="https://maps.googleapis.com/maps/api/js?key={{ env('GOOGLE_MAPS_API_KEY') }}&libraries=places&callback=initialize" async defer></script>


