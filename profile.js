document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('update-profile-form');
    const messageDiv = document.getElementById('update-message');

    form.addEventListener('submit', function(e) {
        e.preventDefault();
        
        const formData = new FormData(form);

        fetch('update_profile.php', {
            method: 'POST',
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                messageDiv.textContent = data.message;
                messageDiv.style.color = 'green';
            } else {
                messageDiv.textContent = data.message;
                messageDiv.style.color = 'red';
            }
        })
        .catch(error => {
            messageDiv.textContent = 'Error: ' + error.message;
            messageDiv.style.color = 'red';
        });
    });
});
