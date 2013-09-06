define([
    'jquery',
    'marionette',
    'handlebars',
    'collections/media_files',
    'text!templates/media_file_table.html',
    'controllers/media_file_item'
], function($, Marionette, Handlebars, MediaFiles, mediaFileTable, MediaFileItem){

    var MediaFileListView = Marionette.CompositeView.extend({
        itemView: MediaFileItem,
        template: Handlebars.compile(mediaFileTable),
        itemViewContainer: 'tbody',
        initialize: function(){
            this.collection = new MediaFiles(window.initialData);
        },
        events: {
            "click .play" : 'play'
        },
        openPath: function (path) {
            this.collection.fetch({
                url: this.collection.url + '/' + (path ? path : ''),
                reset: true
            });
        },
        play: function (e) {
            e.preventDefault();
            this.collection.model.play(e.target.href);
        }
    });

    return MediaFileListView;
});
