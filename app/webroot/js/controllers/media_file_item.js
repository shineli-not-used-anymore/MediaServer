define([
    'marionette',
    'handlebars',
    'text!templates/file.html',
    'text!templates/folder.html'
], function(Mationette, HandleBars, file, folder){

    var MediaFileItemsController = Backbone.Marionette.ItemView.extend({
        tagName: 'tr',
        getTemplate: function(){

            if (this.model.get('type') == 'folder') {
                return Handlebars.compile(folder);
            }
            return Handlebars.compile(file);
        }
    });
    return MediaFileItemsController;
});