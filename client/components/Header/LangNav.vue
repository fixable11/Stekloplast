<template>
    <div class="langNav">
        <span class="langNav__title" @click="show = !show">Language</span>
        <transition name="slide">
            <ul class="langNav__items" v-if="show">
                <li>
                    <nuxt-link :to="switchLocalePath('en')">English</nuxt-link>
                </li>
                <li>
                    <nuxt-link :to="switchLocalePath('ru')">Russian</nuxt-link>
                </li>
                <li>
                    <nuxt-link :to="switchLocalePath('uk')">Ukr</nuxt-link>
                </li>
            </ul>
        </transition>
    </div>

</template>

<script>
    export default {
        name: "langNav",
        data () {
            return {
                show: false,
            }
        },
        computed: {

        }
    }
</script>

<style scoped lang="scss">
    .langNav {
        position: relative;
        &__title {
            cursor: pointer;
        }
        &__items {
            position: absolute;

            list-style-type: none;
        }
    }

    .slide-enter-active {
        transition: max-height .5s;
    }

    .slide-leave-active {
        transition: max-height .5s;
    }

    .slide-enter-to, .slide-leave {
        max-height: 100px;
        overflow: hidden;
    }

    .slide-enter, .slide-leave-to {
        overflow: hidden;
        max-height: 0;
    }
</style>
