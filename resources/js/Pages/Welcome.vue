<script>
import GiftCard from "@/Components/GiftCard.vue";

export default {
    components: {GiftCard},

    mounted() {
        this.setAnimation()
    },
    methods: {
        setAnimation() {
            this.$anime({
                targets: '.title',
                translateY: [-100, 0],
                duration: 1200
            })
            const items = document.querySelectorAll('.gift-card')
            items.forEach((item, index) => {
                this.$anime({
                    targets: item,
                    translateY: [0, Math.random()*75],
                    backgroundColor: ['hsl('+Math.ceil(Math.random() * 255)+',50%,79%)'],
                    duration: 200,
                    delay: index * 500
                })
            })
        }
    },
    data() {
        return {
            items: [
                {
                    id: 1,
                    name: 'Incendit',
                    description: 'Coca Cola',
                    price: 10
                },
                {
                    id: 1,
                    name: 'Noyade',
                    description: 'Coca Cola',
                    price: 10
                },
                {
                    id: 1,
                    name: 'Caca zizin',
                    description: 'Coca Cola',
                    price: 10
                },
            ]
        }
    },
    name: 'IndexPage'
}
</script>

<template>
    <div class="page">
        <h1 class="title">Liste Noyel de Célian</h1>
        <div class="gift-cards">
            <GiftCard  v-for="item in items" :key="item.id" :giftcard="item" />
        </div>
    </div>
</template>


<style lang="scss">
* {
    padding: 0;
    margin: 0;
}

body {
    background-color: black;
}

div.page {
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;

    gap: 1rem;

    h1 {
        margin: 4vw 0;
        font-size: 7rem;
        width: 80%;
        text-align: center;
        color: white;
        font-family: 'Climate', serif;
    }
}


li {
    color: white;
}

.gift-cards {
    display: flex;
    width: 90%;
    flex-wrap: wrap;

    z-index: 1;

    .gift-card {
        display: flex;
        flex-direction: column;

        color: black;
        width: 25dvw;
        font-family: "Roboto Regular", serif;
        font-size: 1.5rem;
        border-radius: 8pt;
        margin: 1rem;

        padding: 1rem;
        transition: transform 0.2s ease-in-out;


        &:hover {
            transform: translateY(-5px) !important;
        }
        z-index:10;

        h2 {
            font-family: "Roboto Regular", serif;
            font-size: 1.5rem;
            padding: .5rem 0;
        }

        p {
            font-family: "Roboto Light", serif;
            font-size: 1rem;
            padding: .2rem 0;
        }

        img {
            width: 10%;
            align-self: end;
        }
    }
}
@font-face {
    font-family: 'Climate';
    font-style: normal;
    font-weight: 800;
    font-display: swap;
    src: url('~assets/fonts/ClimateCrisis-Regular-VariableFont_YEAR.ttf') format('truetype');
}

@font-face {
    font-family: 'Roboto Light';
    font-style: normal;
    font-weight: 300;
    font-display: swap;
    src: url('~assets/fonts/Roboto/Roboto-Light.ttf') format('truetype');
}

@font-face {
    font-family: 'Roboto Regular';
    font-style: normal;
    font-weight: 400;
    font-display: swap;
    src: url('~assets/fonts/Roboto/Roboto-Regular.ttf') format('truetype');
}
</style>
