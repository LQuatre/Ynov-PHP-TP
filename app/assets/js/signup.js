document.getElementById('signup-form').addEventListener('submit', function(event) {
    event.preventDefault();
    const formData = new FormData(this);
    const data = {
        email: formData.get('email'),
        username: formData.get('username'),
        password: formData.get('password')
    };

    fetch('/api/signup',
        {
            method: 'POST',
            headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify(data)
    }).then(response => response.json())
        .then(data => {
            if (data.success) {
            // Handle success (e.g., redirect to login page)
            } else {
                // Handle error (e.g., display error message)
            }
        })
        .catch(error => {
        console.log(error);
    });
});