require.config({
    paths: {
        jquery: 'vendor/jquery-1.9.0.min',
        underscore: 'vendor/underscore-min',
        backbone: 'vendor/backbone',
        handlebars: 'vendor/handlebars',
        text: 'vendor/text'
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
        }
    }
});

require([
    'routers/' + window.controller
], function(Module){
    Module.initialize();
});