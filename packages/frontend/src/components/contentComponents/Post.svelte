<script>

    export let post

    function createHtmlContent(content) {
        const element = document.createElement('div');
        element.innerHTML = content;
        return element.outerHTML;
    }

</script>

<style>
    .post {
        display: flex;
        margin-left:15px;
    }

    .postContent {
        display: flex;
        flex-direction: column;
    }

    .postContent div {
        width: fit-content;
    }

    .author > i {
        height:50px;
        width:50px;
        display:flex;
        flex-direction: column;
        margin-right: 15px;
    }

</style>

<div class="post">
    <div class="author">
        <i class="fas fa-user-circle fa-3x"></i>
        <span>{post.author.login}</span>
    </div>
    <div class="postContent">
        <style>
            .postContent h1 {
                text-align: start;
                font-size: 25px;
            }

            .cl-content,
            .cl-actionbar {
                text-align: start;
            }

            div {
                text-align: start;
            }
        </style>
        <div>{(new Date(post.creationDate)).toLocaleDateString()} {(new Date(post.creationDate)).toLocaleTimeString()}</div>
        {@html createHtmlContent(post.content)}
    </div>
</div>