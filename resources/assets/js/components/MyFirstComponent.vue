<template>
    <div>
        <h2>Привет, Степан</h2>
        <h3>Я вью-компонент, а вот и реактивность - {{ kitty }}</h3>
    </div>
</template>

<script>
    export default {
        mounted() {
            console.log('Component ready.');
        },

        data() {
            return {
                kitty: "~(=^‥^)_旦~"
            }
        }
    }
</script>
