// Initialize map centered on user's location
var map = L.map('map'); // No need to set the initial view here

L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
    attribution: '© OpenStreetMap contributors'
}).addTo(map);

// Function to add markers and popups
function addMarkersAndPopups(data) {
    data.forEach(function(store) {
        var marker = L.marker([store.lat, store.lon], { storeName: store.name }).addTo(map);
        console.log("Adding marker at", store.lat, store.lon); // Debug: Check marker coordinates
        marker.bindPopup('<div><h2>' + store.name + '</h2><p>' + store.offer + '</p></div>');
    });
}

// Fetch active offers using AJAX
var xhr = new XMLHttpRequest();
xhr.open("GET", "../includes/get_active_offers.php", true);
xhr.onreadystatechange = function() {
    if (xhr.readyState === 4 && xhr.status === 200) {
        try {
            var activeOffers = JSON.parse(xhr.responseText);
            console.log(activeOffers); // Debug: Check if offers data is correctly fetched
            addMarkersAndPopups(activeOffers);
        } catch (error) {
            console.error("Error parsing JSON:", error);
        }   
    }
};
xhr.send();

// Get user's location using geolocation service
if ("geolocation" in navigator) {
    navigator.geolocation.getCurrentPosition(function(position) {
        var userLatitude = position.coords.latitude;
        var userLongitude = position.coords.longitude;

        // Set map view to user's location
        map.setView([userLatitude, userLongitude], 12); // You can adjust the zoom level (12 in this case)
        
        // Add a marker for the user's location
        var userMarker = L.marker([userLatitude, userLongitude], { icon: L.icon({ iconUrl: 'user-icon.png', iconSize: [32, 32] }) }).addTo(map);
        userMarker.bindPopup("Your Location").openPopup();
    }, function(error) {
        console.error("Error getting user's location:", error);
    });
} else {
    console.log("Geolocation is not available.");
}
