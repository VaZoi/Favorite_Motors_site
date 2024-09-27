document.addEventListener('DOMContentLoaded', function () {
    const likeButtons = document.querySelectorAll('.like-button');

    likeButtons.forEach(button => {
        button.addEventListener('click', function () {
            const motorId = this.getAttribute('data-motor-id');

            fetch(`like_motor.php`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify({ motor_id: motorId })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    this.textContent = `${data.likes}`;
                } else {
                    alert('Failed to like the motor.');
                }
            })
            .catch(error => console.error('Error:', error));
        });
    });
});
