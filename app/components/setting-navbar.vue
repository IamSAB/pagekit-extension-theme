<template>
    <div>
        <div class="uk-form-row">
            <label class="uk-form-label">{{ 'Options' | trans }}</label>
            <div class="uk-form-controls">
                <label>
                    <input type="checkbox" v-model="setting.transparent">
                    {{ 'Transparent' }}
                </label>
                <label>
                    <input type="checkbox" v-model="setting.expand">
                    {{ 'Expand navbar' }}
                </label>
            </div>
        </div>

        <!-- Sticky javascript settings -->

        <!-- Navbar javascript settings -->

    </div>
</template>

<script>

    module.exports = {

        extend: require('./setting.js')

    }

    window.$components['navbar'] = module.exports;


</script>
