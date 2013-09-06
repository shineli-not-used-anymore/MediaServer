var startApp = function($, Backbone, Marionette, Handlebars, AppRouter){
    var app = new Marionette.Application();

    var initialize = function() {
        app.addInitializer(function(options){
            var appRouter = AppRouter.initialize();
            app.appRouter = appRouter;
        });
        app.on('initialize:after', function(){
            Backbone.history.start({
                pushState: true,
                root: window.root_url,
                silent: true
            });
            $(document).on('click', 'a:not([data-bypass])', function (e) {

                var href = $(this).attr('href');
                var protocol = this.protocol + '//';

                if (href.slice(protocol.length) !== protocol) {
                    e.preventDefault();
                    app.appRouter.navigate(href, true);
                }
            });

        });
        app.addRegions({
            mainRegion: '#main > .container'
        });
        app.start();
        app.getRegion('mainRegion').show(app.appRouter.controller);

    }

    return {
        initialize: initialize
    }
};

if (window.controller == 'media_files') {
    define([
        'jquery',
        'backbone',
        'marionette',
        'handlebars',
        'routers/media_files'
    ], startApp);
}