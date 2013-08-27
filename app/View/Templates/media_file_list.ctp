<table class="table media-files">
    {{#each folders}}
        {{> folder}}
    {{/each}}
    {{#each files}}
        {{> file}}
    {{/each}}
</table>