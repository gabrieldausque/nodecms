<script>
    export let currentDay = new Date();

    const dayOfWeek = ['Dim.', 'Lun.', 'Mar.', 'Mer.','Jeu.','Ven.','Sam.']

</script>

<style>
    .day {
        width:20vw;
        height: 150px;
        display: flex;
        flex-direction: column;
        justify-content: flex-start;
        align-items: center;
        border: solid 1px lightgray;
    }

    .day-title {
        text-align: center;
        vertical-align: center;
        width: 100%;
    }
</style>

<div class="day">
    <div class="day-title">{`${dayOfWeek[currentDay.getDay()]} ${currentDay.getDate()}`}</div>
</div>