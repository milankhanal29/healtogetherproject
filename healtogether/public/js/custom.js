// public/js/custom.js
// Get the CSRF token value from the meta tag
const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

document.addEventListener('DOMContentLoaded', function() {

document.getElementById('getClustersBtn').addEventListener('click', function () {
    fetch('/cluster-data', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),

        },
        body: JSON.stringify({
            "name": "Milan Khanal",
            "age": 23,
            "email": "milankhanal2057@gmail.com",
            "address": {
                "street": " Main Street",
                "city": "kathmandu",
                "country": "Nepal"
            },
            "hobbies": ["playing", "Gardening", "Cooking"],
            "isEmployed": true
        }),
        
    })
        .then((response) => response.json())
        .then((data) => {
            // Update the clustersContainer div with the clustering results
            const clustersContainer = document.getElementById('clustersContainer');
            clustersContainer.innerHTML = '';

            const clusters = data.clusters;
            clusters.forEach((cluster, index) => {
                clustersContainer.innerHTML += `<p>Record ${index + 1} belongs to Cluster ${cluster}</p>`;
            });
        })
        .catch((error) => {
            console.error('Error fetching clustering results:', error);
        });
});
});