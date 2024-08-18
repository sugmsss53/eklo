
document.addEventListener('DOMContentLoaded', () => {
    const form = document.querySelector('form');
    
    form.addEventListener('submit', (e) => {
        e.preventDefault();
        
        const formData = new FormData(form);
        const loader = document.createElement('div');
        loader.className = 'submit-loader';
        loader.innerHTML = '<img src="loader.gif" alt="Loading...">';
        document.body.appendChild(loader);
        loader.style.display = 'block';
        
        fetch('createpost.php', {
            method: 'POST',
            body: formData
        }).then(response => response.text())
          .then(data => {
              loader.style.display = 'none';
              // Handle response or redirect
              window.location.href = 'home.php';
          }).catch(error => {
              loader.style.display = 'none';
              console.error('Error:', error);
          });
    });
});
