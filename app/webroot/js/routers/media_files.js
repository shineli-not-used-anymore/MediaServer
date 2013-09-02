define([
    'backbone',
    'marionette',
    'controllers/media_files'
], function(Backbone, Marionette, MediaFilesController){

    var AppRouter = Marionette.AppRouter.extend({
        controller: new MediaFilesController(),
        appRoutes: {
            "*path" : "openPath"
        }
    });

    var initialize = function(){
        var appRouter = new AppRouter();
        return appRouter;
    }

    return {
        initialize: initialize
    };
});
