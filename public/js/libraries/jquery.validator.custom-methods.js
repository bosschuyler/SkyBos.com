$.validator.addMethod('hasNumber', function(value, element) {
    return this.optional(element) || /\d/.test(value);
}, 'Must contain at least 1 number');

$.validator.addMethod('hasSpecial', function(value, element, params) {
    // console.log(params);
    var regex = new RegExp(params);
    return this.optional(element) || regex.test(value);
}, 'Must contain at least 1 special character (!@#$%^&*)');
