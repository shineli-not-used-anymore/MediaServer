$(function(){
    $('.nav').on('click', '.quit a', function(e) {
        e.preventDefault();
        var $this = $(this);
        $.ajax({
            url: $this.attr('href'),
            cache: false
        });
    });
    $('.nav').on('click', '.shut-down a', function(e) {
        e.preventDefault();
        var $this = $(this);
        if (confirm('Shut down?')) {
            $.ajax({
                url: $this.attr('href'),
                cache: false
            });
        }
    });
    $('.media-files').on('click', '.play', function (e) {
        e.preventDefault();
        var $this = $(this);
        $.ajax({
            url: $this.attr('href'),
            cache: false
        });
    });    
});
