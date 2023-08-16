// categoryFilter.js

const categoryFilterSelect = document.getElementById("category-filter");

categoryFilterSelect.addEventListener("change", function() {
    const selectedCategory = categoryFilterSelect.value;

    // Clear previous markers
    clearMarkers();

    // Fetch offers based on selected category using AJAX
    fetch(`../includes/get_offers_by_category.php?category=${selectedCategory}`)
        .then(response => response.json())
        .then(filteredOffers => {
            // Display filtered offers on the map
            addMarkersAndPopups(filteredOffers);
        })
        .catch(error => {
            console.error("Error fetching offers:", error);
        });
});
