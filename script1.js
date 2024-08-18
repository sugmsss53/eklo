
document.getElementById('logout-link').addEventListener('click', function(e) {
    if (!confirm('Are you sure you want to log out?')) {
        e.preventDefault();
    }
});
