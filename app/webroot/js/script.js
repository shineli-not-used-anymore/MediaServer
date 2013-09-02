require.config({
    paths: {
        jquery: 'vendor/jquery-1.9.0.min',
        underscore: 'vendor/underscore-min',
        backbone: 'vendor/backbone',
        handlebars: 'vendor/handlebars',
        text: 'vendor/text',
        marionette: 'vendor/backbone.marionette'
    },
    shim: {
        underscore: {
            exports: '_'
        },
        backbone: {
            deps: ["underscore", "jquery"],
            exports: "Backbone"
        },
        handlebars: {
            exports: 'Handlebars'
        },
        marionette : {
            deps : ['jquery', 'underscore', 'backbone'],
            exports : 'Marionette'
        }
    }
});

require([
    'app'
], function(App){
    App.initialize();
});