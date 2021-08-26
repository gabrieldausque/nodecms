<script>
    import { fade, slide } from 'svelte/transition'

    export let finalWidthInPercent;
    export let startPosition;
    export let finalPosition;

    function slideHorizontal(node, {
        delay = 0,
        duration = 300
    }) {
        return {
            delay,
            duration,
            css: t => `width: ${t * finalWidthInPercent}%`
        }
    }
</script>

<style>
    .panel {
    }

</style>

<div class="panel" transition:slideHorizontal style="width:{finalWidthInPercent}%;">
</div>