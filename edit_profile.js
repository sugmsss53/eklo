document.addEventListener("DOMContentLoaded", function () {
    const form = document.getElementById('edit-profile-form');
    const responseMessage = document.getElementById('response-message');

    form.addEventListener('submit', function (event) {
        event.preventDefault();

        const formData = new FormData(form);

        fetch('update_profile.php', {
            method: 'POST',
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                responseMessage.innerHTML = `<p style="color: green;">${data.message}</p>`;
            } else {
                responseMessage.innerHTML = `<p style="color: red;">${data.message}</p>`;
            }
        })
        .catch(error => {
            responseMessage.innerHTML = `<p style="color: red;">An error occurred.</p>`;
        });
    });
});
