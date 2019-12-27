<template>
    <div class="container text-center">
        <h2 class="title">{{ $t('pages.about') }}</h2>
        <div v-for="category in categories">
            <div>{{ category.name }}</div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "about",
        data() {
            return {
                categories: [],
            }
        },
        async asyncData ({ params, $axios }) {
            const {data} = await $axios.$get(`categories`);
            //this.categories = data.data;

            return {
                categories: data
            }
        },
    }
</script>

<style scoped lang="scss">
    .title {

    }
</style>
