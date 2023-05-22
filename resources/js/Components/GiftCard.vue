<template>
    <div class="gift-card">
        <h2>
            {{ giftcard.name }}
        </h2>
        <p>
            {{ giftcard.description }}
        </p>
        <p>
            {{ giftcard.price }}
        </p>
    </div>
</template>

<script>
export default {
    props: ['giftcard'],
}
</script>
