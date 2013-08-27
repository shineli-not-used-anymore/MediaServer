define([
    'jquery',
    'underscore',
    'backbone',
    'handlebars',
    'controllers/media_files'
], function($, _, Backbone, Handlebars, MediaFilesController){

    var AppRouter = Backbone.Router.extend({
        routes: {
            "*path" : "openPath"
        }
    });

    var initialize = function(){

        var appRouter = new AppRouter();
        var mediaFilesController = new MediaFilesController();

        appRouter.on('route:openPath', function (path) {
            mediaFilesController.openPath(path);
        });

        Backbone.history.start({pushState:true, root: '/media_files/index', silent: true});

        $(document).on('click', 'a:not([data-bypass])', function (evt) {

            var href = $(this).attr('href');
            var protocol = this.protocol + '//';

            if (href.slice(protocol.length) !== protocol) {
                evt.preventDefault();
                appRouter.navigate(href, true);
            }
        });
    }

    return {
        initialize: initialize
    };
});
