define([
    'jquery',
    'backbone'
], function($, Backbone){
    MediaFile = Backbone.Model.extend({}, {
        play: function (link) {
            $.ajax({
                url: link
            });
        },
        open: function (link, opened) {
            var that = this;

            $.ajax({
                url: link,
                success: function (data) {
                    opened.apply(that, [data]);
                },
                dataType: 'json'
            });
        }
    });
    return MediaFile;
});