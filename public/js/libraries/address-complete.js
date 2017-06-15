var AddressComplete = Object.create({});
AddressComplete.defaults = {
    selectors: {
        main: '.address-complete',
        search: '.search',
        search_container: '.search-container',
        city: '.city',
        state: '.state',
        zip: '.zip',
        address: '.address',
        country: '.country',
        address_container: '.address-container',
        search_address_button: '.search-address-button'
    },
    debug: false
};

AddressComplete.autocomplete = null;
AddressComplete.events = {};

AddressComplete.bindEvent = function(event, callback) {
    this.events[event] = callback;
}

AddressComplete.fireEvent = function(event) {
    if(this.events[event]) {
        this.events[event](this);
    }
}

AddressComplete.hideSearch = function() {
    var classList = this.getElement('search_container').classList;
    classList.add('hidden');
}

AddressComplete.showSearch = function() {
    var classList = this.getElement('search_container').classList;
    classList.remove('hidden');
}

AddressComplete.clearSearch = function() {
    this.getElement('search').value = '';
}

AddressComplete.hideAddressContainer = function() {
    var classList = this.getElement('address_container').classList;
    classList.add('hidden');
}

AddressComplete.showAddressContainer = function() {
    var classList = this.getElement('address_container').classList;
    classList.remove('hidden');
}

AddressComplete.geolocate = function () {
    if (navigator.geolocation) {
      navigator.geolocation.getCurrentPosition(function(position) {
        var geolocation = {
          lat: position.coords.latitude,
          lng: position.coords.longitude
        };
        var circle = new google.maps.Circle({
          center: geolocation,
          radius: position.coords.accuracy
        });
        autocomplete.setBounds(circle.getBounds());
      });
    }
}


AddressComplete.getElement = function(key) {
    var selector = this.getSelector(key);
    if(selector) {
        return document.querySelector(this.getFullSelector(key));
    }
    return null;
}

AddressComplete.getSelector = function(key) {
    return this.settings['selectors'][key] || null;
}

AddressComplete.getFullSelector = function(key) {
    var main = this.getSelector('main');
    var selector = this.getSelector(key);
    if(selector) {
        return main + ' ' + selector;
    }
    return null;
}

AddressComplete.create = function(options) {
    var extend = function () {
        // Variables
        var extended = {};
        var deep = false;
        var i = 0;
        var length = arguments.length;

        // Check if a deep merge
        if ( Object.prototype.toString.call( arguments[0] ) === '[object Boolean]' ) {
            deep = arguments[0];
            i++;
        }

        // Merge the object into the extended object
        var merge = function (obj) {
            for ( var prop in obj ) {
                if ( Object.prototype.hasOwnProperty.call( obj, prop ) ) {
                    // If deep merge and property is an object, merge properties
                    if ( deep && Object.prototype.toString.call(obj[prop]) === '[object Object]' ) {
                        extended[prop] = extend( true, extended[prop], obj[prop] );
                    } else {
                        extended[prop] = obj[prop];
                    }
                }
            }
        };

        // Loop through each object and conduct a merge
        for ( ; i < length; i++ ) {
            var obj = arguments[i];
            merge(obj);
        }

        return extended;
    };

    var obj = Object.create(this);
    obj.settings = extend(true, {}, obj.defaults, options)
    return obj; 
};

AddressComplete.init = function() {
    var self = this;
    // Set up the autocomplete to work on the address 1 field
    this.autocomplete = new google.maps.places.Autocomplete(
        this.getElement('search'),
        {
            types: ['geocode']
        }
    );

    // When the user selects an address from the dropdown, populate the address
    // fields in the form.
    this.autocomplete.addListener('place_changed', this.fillInAddress.bind(this));

    this.getElement('search').focus(this.geolocate);

    this.fireEvent('initialized');

    if(this.settings.debug) {
        console.log('Autocomplete Initialized.');
    }
};

AddressComplete.fillInAddress = function() {
    // Get the place details from the autocomplete object.
    var place = this.autocomplete.getPlace();

    // Let's reformat it to be more .. usable.
    for (componentKey in place.address_components) {
        var component = place.address_components[componentKey];
        // Loop through the types, and just set them inside the place object.
        for (typeKey in component.types) {
            var type = component.types[typeKey];
            // Create a new property within the place object with a name of the "type", to store the long & short names.
            place[type] = {'short_name': component.short_name, 'long_name': component.long_name};
        }
    }   

    // Fill in the form!
    this.getElement('city').value = place.locality.long_name;
    this.getElement('state').value = place.administrative_area_level_1.short_name;
    this.getElement('zip').value = place.postal_code.long_name;
    this.getElement('address').value = place.street_number.long_name + ' ' + place.route.long_name;
    this.getElement('country').value = place.country.long_name;
    
    this.fireEvent('address.selected');
};
