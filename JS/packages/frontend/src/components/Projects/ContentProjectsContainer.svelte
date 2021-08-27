<script>

    import {ProjectStore} from "../../stores/ProjectStore";
    import ProjectCard from "./ProjectCard.svelte";
    import {getBackendClient} from "@nodecms/backend-client";

    $ProjectStore;

    function displayCreateProject() {
        jQuery('#CreateProjectModal').modal('show');
    }

    async function onLabelChanged() {
        const keyInput = document.getElementById('projectKey');
        const labelInput = document.getElementById('projectLabel');
        if(!keyInput.value){
            keyInput.value = labelInput.value;
            keyInput.dispatchEvent(new Event('change'));
        }
        if(!labelInput) {
            labelInput.classList.remove('is-valid');
            labelInput.classList.add('is-invalid');
        } else {
            labelInput.classList.remove('is-invalid');
            labelInput.classList.add('is-valid');
        }
    }

    async function onKeyChanged(event) {
        const backendService = await getBackendClient();
        const keyInput = document.getElementById('projectKey');
        const labelInput = document.getElementById('projectLabel');
        if(!labelInput.value){
            labelInput.value = keyInput.value;
        }
        if(!labelInput) {
            labelInput.classList.add('is-invalid');
            labelInput.dispatchEvent(new Event('change'));
        } else {
            if(await backendService.projectsService.exists(keyInput.value)){
                keyInput.classList.remove('is-valid');
                keyInput.classList.add('is-invalid');
            } else {
                keyInput.classList.remove('is-invalid');
                keyInput.classList.add('is-valid');
            }
        }
    }

    async function validateNewProject() {
        return true;
    }

    async function createProject() {
        const errorAlertContent = document.getElementById('errorOnCreatingProjectContent');
        const errorAlert = document.getElementById('errorOnCreatingProject');
        if(await validateNewProject()) {
            try {
                const backendService = await getBackendClient();
                const data = {
                    key: document.querySelector('#projectKey').value,
                    label: document.querySelector('#projectLabel').value,
                    description: document.querySelector('#projectDescription').value
                }
                const project = await backendService.projectsService.createProject(
                    data.label,
                    data.key,
                    data.description
                );
                jQuery('#CreateProjectModal').modal('hide');
                document.querySelector('#projectKey').value = null;
                document.querySelector('#projectLabel').value = null;
                document.querySelector('#projectDescription').value = null;
                ProjectStore.update(ps => {
                    ps.push(project);
                    return ps;
                })
            }catch(error){
                console.log(error);
                errorAlertContent.innerText = error.message;
                errorAlert.classList.add('show');
            }
        } else {
            errorAlertContent.innerText = 'Impossible de créer le projet. Vérifier ses paramètres';
            errorAlert.classList.add('show');
        }
    }

</script>

<style>
    .projects-board {
        height: 100%;
        width: 100%;
        display: flex;
        flex-wrap: wrap;
        justify-content: flex-start;
        align-items: flex-start;
        overflow-y: auto;
        overflow-x: hidden;
        padding: 20px;
    }

    .project-creation-button {
        width: 250px;
        height: 250px;
        font-size: 6rem;
        color: lightgrey;
        margin: 15px;
    }

    .btn.action {
        display: flex;
        align-items: center;
    }

    .btn.action span.spinner-border {
        margin-right:5px;
        display: none;
    }

    :global(.btn.action span.spinner-border.show) {
        margin-right:5px;
        display: block;
    }

    .modal-footer-createChannel {

    }

    .modal-footer > button {
        margin-right: 0;
        margin-left: auto;
    }

    #errorOnCreatingProject {
        max-width: 325px;
    }

    .modal-title {
        margin-left: calc(68% - 15px)
    }



</style>

<main class="projects-board">

    <button type="button" class="btn btn-secondary project-creation-button" title="Créer un projet" on:click={displayCreateProject}>
        <i class="fas fa-plus"></i>
    </button>

    {#if $ProjectStore}
        {#each $ProjectStore as project}
            <ProjectCard project={project}></ProjectCard>
        {/each}
    {/if}

</main>

<div id="CreateProjectModal" class="modal fade " data-keyboard="false">
    <style>
        label {
            text-align: start;
        }
    </style>
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 id="create-channel-modal-title" class="modal-title">Créer un nouveau projet</h5>
                <button id="ErrorClose" type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="CreateProjectForm" class="">
                    <div class="mb-3">
                        <label for="projectLabel">Label</label>
                        <input on:change={onLabelChanged} class="form-control" id="projectLabel" name="projectLabel" type="text" required>
                        <div class="invalid-feedback">
                            Le label ne peut pas être vide.
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="projectKey">Clé unique du projet</label>
                        <input on:change={onKeyChanged} class="form-control" id="projectKey" name="projectKey" type="text" required>
                        <div class="invalid-feedback">
                            La clé ne peut pas être vide ou un projet avec la même clé existe déjà.
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="projectDescription">Description du projet</label>
                        <textarea class="form-control" id="projectDescription" name="projectDescription" rows="4" placeholder="Taper une description pour votre projet"></textarea>
                    </div>
                </form>
            </div>
            <div class="modal-footer modal-footer-createChannel">
                <div id="errorOnCreatingProject" class="alert alert-danger fade">
                    <div id="errorOnCreatingProjectContent"></div>
                </div>
                <button on:click={createProject} type="button" class="btn action btn-danger " ><span id="creating-project-loading" class="spinner-border"></span>Créer le projet</button>
            </div>
        </div>
    </div>
</div>