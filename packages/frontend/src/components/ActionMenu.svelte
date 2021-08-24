<script lang="ts">

    import {MenuAction} from "../helpers/MenuAction";
    export let properties: { actions:MenuAction[] };

</script>

<style>

</style>

<div class="action-menu">
    <ul class="list-group">
        {#each properties.actions as action}
            <li class="list-group-item list-group-item-action {action.cssClasses}">
                <i class="fas fa-2x fa-dog"></i>
                <span>{action.label}</span>
            </li>
        {/each}
    </ul>
</div>