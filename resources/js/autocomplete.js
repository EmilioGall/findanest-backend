// Definizione variabile per chiave API TomTom
const apiKey = 'oqhAPvi5e4AQAL3zAV2MAL0rP9SlonP0';

// Definizione variabile per elemento di input indirizzo
const addressInput = document.getElementById('address');

// Definizione variabile per elemento di suggerimento indirizzi
const suggestionsList = document.getElementById('suggestions-list');

// Ascolto dell-evento "input" (ogni volta che viene inserito qualcosa nell'input allora...)
addressInput.addEventListener('input', function () {

    // Definizione variabile per valore inserito in input indirizzo
    const query = addressInput.value;

    if (query.length > 2) {

        // Chiamata API con parametri inline (indirizzo inserito e chiave API)
        fetch(`https://api.tomtom.com/search/2/search/${encodeURIComponent(query)}.json?key=${apiKey}&limit=5&language=it-IT`)
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


