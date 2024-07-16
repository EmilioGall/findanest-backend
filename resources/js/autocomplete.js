const apiKey = 'oqhAPvi5e4AQAL3zAV2MAL0rP9SlonP0';
const addressInput = document.getElementById('address');
const suggestionsList = document.getElementById('suggestions-list');

addressInput.addEventListener('input', function () {
    const query = addressInput.value;
    if (query.length > 2) {
        fetch(`https://api.tomtom.com/search/2/search/${encodeURIComponent(query)}.json?key=oqhAPvi5e4AQAL3zAV2MAL0rP9SlonP0&limit=5&language=it-IT`)
            .then(response => response.json())
            .then(data => {
                console.log(data);
                suggestionsList.innerHTML = '';
                const suggestions = data.results;
                // console.log(suggestions);
                suggestions.forEach(suggestion => {
                    const listItem = document.createElement('li');
                    listItem.textContent = suggestion.address.freeformAddress;
                    listItem.classList.add('list-group-item');
                    listItem.addEventListener('click', () => {
                        addressInput.value = suggestion.address.freeformAddress;
                        suggestionsList.innerHTML = '';
                    });
                    suggestionsList.appendChild(listItem);
                });
            })
        // .catch(error => console.error('Error fetching autocomplete suggestions:', error));
    } else {
        suggestionsList.innerHTML = '';
    }
});

