var app = app || {};

(function(body){
    "use strict";

    app = {
        
        init: function()
        {
            $('body').on('click', '.sidebar__logo', function(e){
                e.preventDefault();

                $('#header').toggleClass('is-open');
                $('#wrapper').toggleClass('is-open');
                $('#sidebar').toggleClass('is-open');
            });

            // this.history.init();
            
            // var container = document.querySelector('.gallery');

            // container.addEventListener('click', function(e) {
            //   if (e.target != e.currentTarget) {
            //     e.preventDefault();
            //     // e.target is the image inside the link we just clicked.
            //   }
            //   e.stopPropagation();
            // }, false);

            // window.addEventListener('popstate', function(e) {
            //   // e.state is equal to the data-attribute of the last image we clicked
            // });
        }

    };

})(document.body);

// cookie.set({
//    key1: 'value1',
//    key2: 'value2'
// });

// cookie.set('key', 'value', {
//    expires: 7, // expires in one week
// });

// cookie.set({
//    key1: 'value1',
//    key2: 'value2'
// }, {
//    expires: 7
// })

// cookie.defaults.expires = 7;
// cookie.defaults.secure = true;


// cookie.expiresMultiplier = 60; // Seconds.
// cookie.expiresMultiplier = 60 * 60; // Minutes.
// cookie.expiresMultiplier = 60 * 60 * 24; // Hours.


// cookie.get('key');

// cookie.get(['key1', 'key2']);

// cookie.get('key', 'default value');
// cookie.get(['key1', 'key2'], 'default value');


// cookie.get('key');
// // is the same as
// cookie('key');

// var cookies = cookie.all();

// cookie.remove('key');
// cookie.remove('key1', 'key2');
// cookie.remove(['key1', 'key2']);

// if (cookie.enabled()) {
//    // Do stuff with cookies
// } else {
//    // Display error message or use localStorage
// }


// cookie.set('a', '1');
// cookie.setDefault({
//    a: '2',
//    b: '2'
// });

// cookie.get(['a', 'b']); // {a: "1", b: "2"}

// cookie.set('a', 'b', { path: '/somepath' });

// // This won't work
// cookie.remove('a');

// // You have to do this
// cookie.removeSpecific('a', { path: '/somepath' });

// // You can also give an array of cookie keys
// cookie.removeSpecific(['a', 'b'], { path: '/somepath' });

// cookie.empty().set('key1', 'value1').set('key2', 'value2').remove('key1');

// cookie.utils.decode = function (value) {
//    return decodeURIComponent(value).replace('+', ' ');
// };
