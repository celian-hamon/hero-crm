<script>
export default {
    props: ['incident'],
    data () {
        return {
            dialog: false,
        }
    },
}
</script>
<template>
    <div class="incident-card" :style="{backgroundColor: ['hsl('+Math.ceil(Math.random() * 255)+',50%,79%)']}">
        <h3>{{incident.name}}</h3>
        <div>
            <p>{{incident.accidents.length}}</p>
            <i class="material-icons">
                error
            </i>
        </div>

    </div>


</template>
<style lang="scss">
div.incident-card {
    display: flex;
    flex-direction: row;
    justify-content: space-between;
    align-items: start;
    border-radius: 8px;
    padding: 10px;
    margin: 5px 10px;

    h3 {
        font-weight: 700;
        margin-right: 10px;
    }

    div {
        display: flex;
        flex-direction: row;
        justify-content: end;
        margin-left:10px;

        p {
            margin-right: 3px;
        }
    }
}
</style>
