const form = document.querySelector('.search-form');
    form.addEventListener('submit', function(e) {
        e.preventDefault();
        const searchTerm = document.querySelector('input[name="search"]').value;
        window.location.href = `motors.php?search=${encodeURIComponent(searchTerm)}`;
});

