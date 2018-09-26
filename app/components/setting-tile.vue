<template>

    <div>

        <div class="uk-form-row">
            <label class="uk-form-label">{{ 'Style' | trans }}</label>
            <div class="uk-form-controls">
                <select-class
                    :classes.sync="setting.classes"
                    :options="tileStyles"
                    prefix="uk-tile-">
                </select-class>
            </div>
        </div>

    </div>

</template>

<script>

    module.exports = {

        extends: require('./setting.js'),

        data: () => ({
            tileStyles: {
                default: 'Default',
                muted: 'Muted',
                primary: 'Primary',
                secondary: 'Secondary'
            }
        })
    }

    window.$components['tile'] = module.exports;

</script>
