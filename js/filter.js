// filter.js
// This script handles the store filtering based on store names

// Function to filter and display markers based on store name
function filterStoresByName(searchTerm) {
    map.eachLayer(function (layer) {
        if (layer instanceof L.Marker) {
            var storeName = layer.options.storeName.toLowerCase();
            if (storeName.includes(searchTerm.toLowerCase())) {
                layer.addTo(map);
            } else {
                map.removeLayer(layer);
            }
        }
    });
}

// Get reference to the store search input element
var storeSearchInput = document.getElementById('storeSearch');

// Event listener for store search input
storeSearchInput.addEventListener('input', function () {
    var searchTerm = storeSearchInput.value;
    filterStoresByName(searchTerm);
});

// Clear Filter Button
var clearFilterButton = document.getElementById('clearFilter');
clearFilterButton.addEventListener('click', function () {
    // Clear the search input
    storeSearchInput.value = '';
    // Clear any applied filters
    map.eachLayer(function (layer) {
        if (layer instanceof L.Marker) {
            map.addLayer(layer);
        }
    });
});
