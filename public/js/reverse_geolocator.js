function getAddressFromCoordinates(latitude, longitude, addressElement) {
    const url = `https://nominatim.openstreetmap.org/reverse?format=json&lat=${latitude}&lon=${longitude}&zoom=18&addressdetails=1`;
    fetch(url)
        .then(response => response.json())
        .then(data => {
            if (data.display_name) {
                addressElement.textContent = `${data.display_name}`;
            } else {
                addressElement.textContent = 'Address not found';
            }
        })
        .catch(error => {
            console.error('Error fetching address:', error);
            addressElement.textContent = 'Error fetching address';
        });
}
