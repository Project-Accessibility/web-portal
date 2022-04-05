window.addEventListener('load', () => {
    const latitudeInput = document.getElementById('latitude');
    const longitudeInput = document.getElementById('longitude');
    latitudeInput.disabled = true;
    longitudeInput.disabled = true;
    const button = document.getElementById('location-button');
    button.addEventListener('click', (e) => {
        e.preventDefault();
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(showPosition);
        } else {
            console.log("Geolocation is not supported by this browser.");
        }
    });

    function showPosition(position) {
        const latitude = position.coords.latitude;
        const longitude = position.coords.longitude;
        latitudeInput.value = String(latitude);
        longitudeInput.value = String(longitude);
        updateMap(latitude, longitude);
    }

    function updateMap(latitude, longitude) {
        // Variables
        const mapContainer = document.getElementById("map");
        const radius = Number(document.getElementById('radius').value);
        const coordinates = {lat: latitude, lng: longitude};

        // Create the map.
        const map = new google.maps.Map(mapContainer, {
            center: coordinates,
            mapTypeId: "hybrid",
        });
        // Create marker
        new google.maps.Marker({
            position: coordinates,
            map: map,
            icon: {
                url: "https://maps.gstatic.com/intl/en_us/mapfiles/markers2/measle.png",
                labelOrigin: new google.maps.Point(60, 15),
                size: new google.maps.Size(7, 7),
                anchor: new google.maps.Point(4, 4)
            },
            label: {
                text: "Huidige locatie",
                color: "#C70E20",
                fontWeight: "bold"
            }
        });

        const circle = new google.maps.Circle({
            strokeColor: "#1CA883FF",
            strokeOpacity: 0.8,
            strokeWeight: 2,
            fillColor: '#1CA883FF',
            map,
            center: coordinates,
            radius: radius,
        });
        map.fitBounds(circle.getBounds());
    }
});
