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
    <tr>
        <td>{{this}}</td>
        <td>
            <a href="<?php echo Router::url(array('controller' => 'media_files', 'action' => 'play')); ?>?mediaFilePath={{this}}" class="btn play"><?php echo __('play'); ?></a>
        </td>
    </tr>
</script>

<script type="x-handlebars-template" id="folder-template">
    <tr>
        <td>{{this}}</td>
        <td>
            <a href="<?php echo Router::url(array('controller' => 'media_files', 'action' => 'index', 'ext' => 'json')); ?>?folderPath={{this}}" class="btn open"><?php echo __('open'); ?></a>
        </td>
    </tr>
</script>


<?php $this->start('script'); ?>

<script>
    MediaFile = Backbone.Model.extend();
//    Folder = Backbone.Model.extend();

    MediaFiles = Backbone.Collection.extend({
        url: '/media_files.json',
        model: MediaFile
    });

    MediaFileListView = Backbone.View.extend({
        template: Handlebars.compile($('#media-file-list').html()),
        render: function(){
            this.$el.html(this.template(this.collection.toJSON()[0]));
            return this;
        },
        initialize: function(){
            Handlebars.registerPartial("file", $("#file-template").html());
            Handlebars.registerPartial("folder", $("#folder-template").html());

            this.collection.on('reset', function(col, opts){
                this.render();
            }, this);

            if (!this.collection.length) {
                this.collection.fetch({reset: true});
            }
        },
        events: {
            "click .play" : 'play',
            "click .open" : 'open'
        },
        play: function (e) {
            e.preventDefault();

            $.ajax({
                url: $(e.target).attr('href')
            });
        },
        open: function (e) {
            e.preventDefault();
            var that, $link;
            that = this;
            $link = $(e.target);

            $.ajax({
                url: $link.attr('href'),
                success: function (data) {
                    that.collection.reset(data);
                },
                dataType: 'json'
            });
        }
    });


    var mediaFiles = new MediaFiles(<?php echo json_encode($list); ?>);
    var mediaFileListView = new MediaFileListView({
        collection: mediaFiles
    }).render().$el.appendTo('#main .container');

</script>

<?php $this->end(); ?>