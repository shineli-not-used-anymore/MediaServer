({
    appDir: './',
    baseUrl: './',
    dir: './dist',
    modules: [
        {
            name: 'script'
        }
    ],
    fileExclusionRegExp: /^(r|build)\.js$/,
    removeCombined: true,
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
})
