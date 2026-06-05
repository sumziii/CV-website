const form = document.getElementById('blogForm');
const clearBtn = document.getElementById('clearBtn');
const titleInput = document.getElementById('title');
const contentInput = document.getElementById('content');
const titleError = document.getElementById('titleError');
const contentError = document.getElementById('contentError');

form.addEventListener('submit', function(e) {
    let valid = true;

    if (titleInput.value.trim() === '') {
        e.preventDefault();
        titleError.style.display = 'block';
        titleInput.style.border = '2px solid #cc0000';
        valid = false;
    } else {
        titleError.style.display = 'none';
        titleInput.style.border = '1px solid #ccc';
    }

    if (contentInput.value.trim() === '') {
        e.preventDefault();
        contentError.style.display = 'block';
        contentInput.style.border = '2px solid #cc0000';
        valid = false;
    } else {
        contentError.style.display = 'none';
        contentInput.style.border = '1px solid #ccc';
    }
});

clearBtn.addEventListener('click', function() {
    const confirmed = confirm('Are you sure you want to clear the form? This cannot be undone.');
    if (confirmed) {
        titleInput.value = '';
        contentInput.value = '';
        titleError.style.display = 'none';
        contentError.style.display = 'none';
        titleInput.style.border = '1px solid #ccc';
        contentInput.style.border = '1px solid #ccc';
    }
});