<template>

    <div>

        <input-cover
            :src.sync="options.src"
            :type.sync="options.type">
        </input-cover>

        <div class="uk-form-row">
            <label class="uk-form-label">{{ 'Custom class' | trans }}</label>
            <div class="uk-form-controls">
                <input type="text" class="uk-form-width-large" v-model="options.custom" lazy>
            </div>
        </div>

    </div>

</template>

<script>

    import InputCover from "./input-cover.vue";

    module.exports = {

        extends: require('./component.js'),

        components: {
            InputCover
        }
    }

    window.$components['v-hero'] = module.exports;

</script>