document.addEventListener('DOMContentLoaded', (event) => {
    console.log('DOM fully loaded and parsed');

    // Add event listener for the login form
    const loginForm = document.getElementById('loginForm');
    if (loginForm) {
        loginForm.addEventListener('submit', function(event) {
            let username = document.getElementById('username').value;
            let password = document.getElementById('password').value;

            if (username === '' || password === '') {
                alert('All fields are required.');
                event.preventDefault();
            }
        });
    }

    // Add event listener for the upload button
    const uploadButton = document.getElementById('uploadButton');
    if (uploadButton) {
        uploadButton.addEventListener('click', uploadImage);
    }
});

function uploadImage() {
    console.log('Upload button clicked');
    const imageInput = document.getElementById('image');
    const imageFile = imageInput.files[0];

    if (!imageFile) {
        alert('Please select an image.');
        return;
    }

    console.log('Image selected:', imageFile);

    const formData = new FormData();
    formData.append('image', imageFile);

    fetch('upload.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.text())
    .then(data => {
        console.log(data);
        alert(data);
        // Reload the page to display the uploaded image
        location.reload();
    })
    .catch(error => {
        console.error('Error:', error);
    });
}
