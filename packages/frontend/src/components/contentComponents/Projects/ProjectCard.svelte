<script>

    export let project;

    async function displayProject(){

    }
</script>

<style>

    .project-card {
        width:250px;
        height:250px;
        margin:15px;
        color:black;
    }

    .project-card:hover {
        color:white;
    }

    .project-card .card-body {
        width: 100%;
        height: 100%;
        display: flex;
        flex-direction: column;
        align-items: flex-start;
    }

</style>

<button type="button" id="project-{project.id}" class="btn btn-secondary card project-card" on:click={displayProject}>
    <div class="card-body">
        <h5 class="card-title">{project.label}</h5>
        <p class="card-text">{project.description}</p>
    </div>
</button>