<template>
    <div class="wrapper">
        <div class="content">
            <HeaderComponent/>
            <nuxt/>
        </div>
        <div class="footer">
            <FooterComponent/>
        </div>
    </div>
</template>

<script>
    import HeaderComponent from "../components/HeaderComponent";
    import FooterComponent from "../components/FooterComponent";

    export default {
        components: {
            HeaderComponent,
            FooterComponent
        }
    }
</script>

<style>

</style>
