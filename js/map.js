// map.js

// Initialize the map
const map = L.map('map').setView([0, 0], 16); // Centered on user's location

// Add the OpenStreetMap tile layer
L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
  attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
}).addTo(map);

// Function to handle user location retrieval
function onLocationFound(e) {
  var radius = e.accuracy / 2;

  // Create a marker for the user's location
  L.marker(e.latlng).addTo(map)
    .bindPopup("You are within " + radius + " meters from this point").openPopup();

  // Create a circle to represent the accuracy of the location
  L.circle(e.latlng, radius).addTo(map);
}
map.on("locationfound", onLocationFound);

// Function to handle errors when retrieving user location
function onLocationError(e) {
  alert(e.message);
}

// Check if the browser supports geolocation
if ("geolocation" in navigator) {
  // Request the user's location
  navigator.geolocation.getCurrentPosition(onLocationFound, onLocationError);
  map.locate({ setView: true, maxZoom: 16, timeout: 10000 }); // Timeout για καλύτερη ακρίβεια
} else {
  alert("Geolocation is not available in this browser.");
}