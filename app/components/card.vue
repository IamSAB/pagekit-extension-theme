<template>

    <div class="uk-form-row">

        <div class="uk-form-row">
            <label class="uk-form-label">{{ 'Style' | trans }}</label>
            <div class="uk-form-controls">
                <select-class
                    :classes.sync="options.classes"
                    :options="styles"
                    prefix="uk-card-">
                </select-class>
            </div>
        </div>

        <div class="uk-form-row">
            <label class="uk-form-label">{{ 'Size' | trans }}</label>
            <div class="uk-form-controls">
                <select-class
                    :classes.sync="options.classes"
                    :options="sizes"
                    prefix="uk-card-">
                </select-class>
            </div>
        </div>

        <div class="uk-form-row">
            <label class="uk-form-label">{{ 'Hover effect' | trans }}</label>
            <div class="uk-form-controls">
                <checkbox-class
                    :classes.sync="options.classes"
                    value="uk-card-hover">
                </checkbox-class>
            </div>
        </div>

        <div class="uk-form-row">
            <label class="uk-form-label">{{ 'Header' | trans }}</label>
            <div class="uk-form-controls">
                <v-editor :value.sync="options.header" :options="{height:250}"></v-editor>
            </div>
        </div>

        <div class="uk-form-row">
            <label class="uk-form-label">{{ 'Footer' | trans }}</label>
            <div class="uk-form-controls">
                <v-editor :value.sync="options.footer" :options="{height:250}"></v-editor>
            </div>
        </div>

    </div>

</template>

<script>

    module.exports = {

        extends: require('./update.js'),

        data: () => ({
            styles: {
                default: 'Default',
                primary: 'Primary',
                secondary: 'Secondary'
            },
            sizes: {
                small: 'Small',
                large: 'Large'
            }
        })
    }

</script>
