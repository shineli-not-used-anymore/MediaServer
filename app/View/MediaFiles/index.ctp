<script type="x-handlebars-template" id="media-file-list">

    <table class="table media-files">
        {{#each folders}}
            {{> folder}}
        {{/each}}
        {{#each files}}
            {{> file}}
        {{/each}}
    </table>

</script>

<script type="x-handlebars-template" id="file-template">
    <tr data-index="file.{{@index}}">
        <td>{{this}}</td>
        <td>
            <a href="<?php echo Router::url(array('controller' => 'media_files', 'action' => 'play')); ?>?mediaFilePath={{this}}" class="btn play"><?php echo __('play'); ?></a>
        </td>
    </tr>
</script>

<script type="x-handlebars-template" id="folder-template">
    <tr data-index="folder.{{@index}}">
        <td>{{this}}</td>
        <td>
            <a href="#<?php echo Router::url(array('controller' => 'media_files', 'action' => 'index')); ?>?folderPath={{this}}" class="btn open"><?php echo __('open'); ?></a>
        </td>
    </tr>
</script>

<?php $this->start('script'); ?>

<script>
    Handlebars.registerPartial("file", $("#file-template").html());
    Handlebars.registerPartial("folder", $("#folder-template").html());

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

    MediaFiles = Backbone.Collection.extend({
        url: '/media_files',
        model: MediaFile
    });

    MediaFileListView = Backbone.View.extend({
        template: Handlebars.compile($('#media-file-list').html()),
        render: function(){
            this.$el.html(this.template(this.collection.toJSON()[0]));
            return this;
        },
        initialize: function(){

            this.collection.on('reset', function(col, opts){
                this.render();
            }, this);
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


    var mediaFiles = new MediaFiles({});
    var mediaFileListView = new MediaFileListView({
        collection: mediaFiles
    });
    mediaFileListView.render().$el.appendTo('#main .container');

    var AppRouter = Backbone.Router.extend({
        routes: {
            "*path" : "openPath"
        },
        openPath: function(path) {

            if (!path || path.search('folderPath') != -1) {
                mediaFileListView.openPath(path);
            }
        }
    });

    var appRouter = new AppRouter;

    Backbone.history.start();
</script>

<?php $this->end(); ?>