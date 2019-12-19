<template>
    <div class="container">
        <h1 class="title">{{ $t('hello') }}</h1>

        <nuxt-link
            :to="localePath({ name: 'page-about'})">
            About page
        </nuxt-link>
    </div>
</template>

<script>
    import Logo from '~/components/Logo.vue';
    import HeaderComponent from "../components/HeaderComponent";
    import FooterComponent from "../components/FooterComponent";

    export default {
        components: {
            Logo,
            HeaderComponent,
            FooterComponent
        },
        mounted() {

        }
    }
</script>

<style>

</style>
