define([
    'jquery',
    'underscore',
    'backbone',
    'handlebars',
    'collections/media_files',
    'text!/templates/view/file',
    'text!/templates/view/folder',
    'text!/templates/view/media_file_list'
], function($, _, Backbone, Handlebars, MediaFiles, file, folder, mediaFileList){

    Handlebars.registerPartial("file", file);
    Handlebars.registerPartial("folder", folder);

    MediaFileListView = Backbone.View.extend({
        el: '#main .container',
        template: Handlebars.compile(mediaFileList),
        render: function(){
        this.$el.html(this.template(this.collection.toJSON()[0]));
        },
        initialize: function(){
            this.collection = new MediaFiles(window.initialData);
            this.collection.on('reset', function(col, opts){
                this.render();
            }, this);
            this.render();
        },
        events: {
            "click .play" : 'play'
        },
        openPath: function (path) {
            this.collection.model.open.apply(this.collection, [path, this.collection.reset]);
        },
        play: function (e) {
            e.preventDefault();
            this.collection.model.play(e.target.href);
        }
    });

    return MediaFileListView;
});
