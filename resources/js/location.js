window.addEventListener('load', () => {
    const latitudeInput = document.getElementById('latitude');
    const longitudeInput = document.getElementById('longitude');
    const radiusInput = document.getElementById('radius');
    latitudeInput.readOnly = true;
    longitudeInput.readOnly = true;
    if (longitudeInput.value && latitudeInput.value && radiusInput.value) {
        updateMap(Number(latitudeInput.value), Number(longitudeInput.value));
    }
    const button = document.getElementById('location-button');
    if(button){
        button.addEventListener('click', (e) => {
            e.preventDefault();
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(showPosition);
            } else {
                console.log("Geolocation is not supported by this browser.");
            }
        });
    }

    function showPosition(position) {
        const latitude = position.coords.latitude;
        const longitude = position.coords.longitude;
        latitudeInput.value = String(latitude);
        longitudeInput.value = String(longitude);
        updateMap(latitude, longitude);
    }

    function updateMap(latitude, longitude) {
        // Variables
        const radius = Number(radiusInput.value);
        const coordinates = {lat: latitude, lng: longitude};
        console.log(coordinates)
        console.log(radius)

        // Create the map.
        const map = new mapboxgl.Map({
            container: 'map',
            style: 'mapbox://styles/mapbox/streets-v11',
            center: coordinates,
            zoom: 15
        });
        // Create marker
        new mapboxgl.Marker()
            .setLngLat(coordinates)
            .addTo(map);
        const loadSource = () => {
            if (map.isStyleLoaded()) {
                addNewSources(map, coordinates, radius);
                map.off('data', loadSource);
            }
        }
        map.on('load', loadSource);
    }

    function addNewSources(map, coordinates, radius) {
        if (map.getSource("polygon")) {
            map.getSource('polygon').setData(createGeoJSONCircle(coordinates, radius).data);
        } else {
            map.addControl(new mapboxgl.FullscreenControl());
            map.addSource("polygon", createGeoJSONCircle(coordinates, radius));
            map.addLayer({
                "id": "polygon",
                "type": "fill",
                "source": "polygon",
                "layout": {},
                "paint": {
                    "fill-color": "#1ca883",
                    "fill-opacity": 0.4
                }
            });
        }
    }

    function createGeoJSONCircle(coordinates, radius) {
        let km = radius / 1000;

        const ret = [];
        const distanceX = km / (111.320 * Math.cos(coordinates.lat * Math.PI / 180));
        const distanceY = km / 110.574;

        let theta, x, y;
        for (let i = 0; i < 64; i++) {
            theta = (i / 64) * (2 * Math.PI);
            x = distanceX * Math.cos(theta);
            y = distanceY * Math.sin(theta);

            ret.push([coordinates.lng + x, coordinates.lat + y]);
        }
        ret.push(ret[0]);

        return {
            "type": "geojson",
            "data": {
                "type": "FeatureCollection",
                "features": [{
                    "type": "Feature",
                    "geometry": {
                        "type": "Polygon",
                        "coordinates": [ret]
                    }
                }]
            }
        };
    }
});
