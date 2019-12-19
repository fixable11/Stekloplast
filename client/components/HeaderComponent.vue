<template>
    <div class="container">
        <div class="row">
            <div class="ml-auto col-3">
                <LangNav/>
            </div>
        </div>
    </div>
</template>

<script>
    import LangNav from "./Header/LangNav";

    export default {
        name: "HeaderComponent",
        components: { LangNav }
    }
</script>

<style scoped>


</style>
