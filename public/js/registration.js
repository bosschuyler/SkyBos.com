$(document).on('click', '#start-registration, #registration-link', setupRegistration);

function validateForm() {
    var errors = 0;
    errors += validatePassword();
}

function removeError(element) {
    element.removeClass('text-danger').addClass('text-success');
}

function addError(element) {
    element.addClass('text-danger').removeClass('text-success');
}

function validatePassword() {
    errorCount = 0;

    var charMinimum = 8;
    var element = $('#password');
    var password = element.val();

    if(password.length >= charMinimum) {
        removeError($('#charMin'));
    } else {
        addError($('#charMin'));
        errorCount++;
    }

    if(/\d/.test(password)) {
        removeError($('#charNum'));
    } else {
        addError($('#charNum'));
        errorCount++;
    }

    if(/[!@#$%^&*]/.test(password)) {
        removeError($('#charSpecial'));
    } else {
        addError($('#charSpecial'));
        errorCount++;
    }

    if(errorCount > 0) {
        $('#password').parent('div').addClass('has-error');
    } else {
        $('#password').parent('div').removeClass('has-error');
    }

    return errorCount;
}

function setupRegistration(e) {
    e.preventDefault();

    $('#registration-form').validate({
        rules: {
            email: {
                required: true,
                email: true
            },
            password: {
                required: true,
                minlength: 8,
                hasSpecial: '[!@#$%^&*]',
                hasNumber: true
            },
            "confirm-password": {
                equalTo: '#password',
                required: true
            }
        },
        messages: {
            "confirm-password": {
                equalTo: 'Password must match'
            }
        },
        errorClass: "text-danger",
        onkeyup: false,
        submitHandler: function() {
            $('#registration-modal').modal('hide');
            $('#loading-modal').modal('show');

            setTimeout(successfulRegistration, 2000);
        }
    });
    

    $(document).on('keyup', '#registration-form input', validateForm);

    $('#registration-modal').modal('show');
}

function successfulRegistration() {
    $('#loading-modal').modal('hide');

    $('#banner').addClass('hidden');
    $('#registration-link').addClass('hidden');
    $('#success-banner').removeClass('hidden');
}