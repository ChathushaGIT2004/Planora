// Form validation and submission
function validateForm(formId) {
    const form = document.getElementById(formId);
    if (!form) return;

    form.addEventListener('submit', function(e) {
        e.preventDefault();
        
        // Get form values
        const formData = new FormData(form);
        const formValues = Object.fromEntries(formData.entries());

        // Basic validation
        if (formValues.password && formValues.confirmPassword) {
            if (formValues.password !== formValues.confirmPassword) {
                alert('Passwords do not match!');
                return;
            }
        }

        // Here you would typically send the data to your server
        // For now, we'll just show a success message
        alert('Form submitted successfully!');
        form.reset();
    });
}

// Social login buttons
function initSocialLogin() {
    document.querySelectorAll('.social-button').forEach(button => {
        button.addEventListener('click', function() {
            const platform = this.querySelector('i').classList[1].split('-')[1];
            alert(`Login with ${platform} coming soon!`);
        });
    });
}

// Initialize all common functionality
document.addEventListener('DOMContentLoaded', function() {
    // Initialize form validation
    validateForm('loginForm');
    validateForm('registrationForm');

    // Initialize social login buttons
    initSocialLogin();
}); 