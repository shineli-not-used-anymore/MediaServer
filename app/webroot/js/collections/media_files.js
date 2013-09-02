define([
    'backbone',
    'models/media_file'
], function(Backbone, MediaFile){
    MediaFiles = Backbone.Collection.extend({
        url: '/media_files/index',
        model: MediaFile
    });
    return MediaFiles;
});