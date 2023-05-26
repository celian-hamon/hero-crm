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
        <i class="material-icons">
            error
        </i>
    </div>


</template>
<style lang="scss">
div.incident-card {
    border-radius: 8px;
    padding: 10px;
    margin: 5px 10px;

    h3 {
        font-weight: 700;
    }
}
</style>
