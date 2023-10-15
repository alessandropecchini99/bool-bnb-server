
// Initialize TomTom SearchBox
const searchBox = new tt.plugins.SearchBox(tt.services, {
    minNumberOfCharacters: 2, // Minimum characters to trigger search
    searchOptions: {
        key: 'T6vkwG3yYAK2GWCE3TQ1JBb8zMKDk8PG', // Replace with your API key
        language: 'en-US',
        limit: 10,
    },
    autocompleteOptions: {
        key: 'T6vkwG3yYAK2GWCE3TQ1JBb8zMKDk8PG', // Replace with your API key
        language: 'en-US',
    },
    labels: {
        noResultsMessage: 'No results found.'
    },
});

// Get the input elements and add SearchBox to them
const addressWrap = document.getElementById('ms-input-wrap-address');
const streetInput = document.getElementById('street');
const cityInput = document.getElementById('city');
const zipInput = document.getElementById('zip');
const latInput = document.getElementById('latitude');
const longInput = document.getElementById('longitude');

addressWrap.insertAdjacentElement('beforeend', searchBox.getSearchBoxHTML() )

// Handle result selection
searchBox.on('tomtom.searchbox.resultselected', function (event) {
    const selectedResult = event.data.result;
    const civicNumber = selectedResult.address.streetNumber || '';
    const streetName = selectedResult.address.streetName || '';
    const coordinates = selectedResult.position;
    streetInput.value = `${streetName} ${civicNumber}`;
    cityInput.value = selectedResult.address.municipality || '';
    zipInput.value = selectedResult.address.postalCode || '';
    latInput.value = coordinates.lat;
    longInput.value = coordinates.lng;
});
