<template>

    <div>

        <div class="uk-form-row">
            <label class="uk-form-label">{{ 'Style' | trans }}</label>
            <div class="uk-form-controls">
                <select-class
                    :classes.sync="setting.classes"
                    :options="styles"
                    prefix="uk-card-">
                </select-class>
            </div>
        </div>

        <div class="uk-form-row">
            <label class="uk-form-label">{{ 'Size' | trans }}</label>
            <div class="uk-form-controls">
                <select-class
                    :classes.sync="setting.classes"
                    :options="sizes"
                    prefix="uk-card-">
                </select-class>
            </div>
        </div>

        <div class="uk-form-row">
            <label class="uk-form-label">{{ 'Hover effect' | trans }}</label>
            <div class="uk-form-controls">
                <checkbox-class
                    :classes.sync="setting.classes"
                    value="uk-card-hover">
                </checkbox-class>
            </div>
        </div>

    </div>

</template>

<script>

    module.exports = {

        extends: require('./setting.js'),

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

    window.$components['card'] = module.exports;

</script>
