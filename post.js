document.addEventListener('DOMContentLoaded', function() {
    const blogBox = document.getElementById('blog-box');
    const postButton = document.getElementById('post-button');
    const blogList = document.getElementById('blog-list');

    // Replace with the actual user ID of the logged-in user
    const userId = 1; // This should be dynamically set

    function fetchBlogs() {
        fetch('getBlogs.php')
            .then(response => response.json())
            .then(data => {
                blogList.innerHTML = '';
                data.forEach(blog => {
                    const blogItem = document.createElement('div');
                    blogItem.innerHTML = `<strong>${blog.username}</strong>: ${blog.text} <br><small>${blog.created_at}</small>`;
                    blogList.appendChild(blogItem);
                });
            });
    }

    function postBlog() {
        const blogText = blogBox.value;
        if (blogText.trim()) {
            fetch('postBlog.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({ text: blogText, user_id: userId })
            })
            .then(response => response.json())
            .then(() => {
                blogBox.value = '';
                fetchBlogs();
            });
        }
    }

    postButton.addEventListener('click', postBlog);
    fetchBlogs();
    setInterval(fetchBlogs, 5000); // Refresh blogs every 5 seconds
});
