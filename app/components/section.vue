<template>

    <div>

        <div class="uk-form-row">
            <label class="uk-form-label">{{ 'Style' | trans }}</label>
            <div class="uk-form-controls">
                <select-class class="uk-margin-right"
                    :classes.sync="options.classes"
                    :options="styles"
                    prefix="uk-section-"
                    :unselected="{index: 0, label: 'None'}">
                </select-class>
                <label>
                    {{ 'Preserve color' | trans }}
                    <checkbox-class
                        :classes.sync="options.classes"
                        value="uk-preserve-color">
                    </checkbox-class>
                </label>
            </div>
        </div>

        <div class="uk-form-row">
            <label class="uk-form-label">{{ 'Size' | trans }}</label>
            <div class="uk-form-controls">
                <select-class
                    :classes.sync="options.classes"
                    :options="sizes"
                    prefix="uk-section-"
                    :unselected="{index: 2, label: 'Default'}">
                </select-class>
            </div>
        </div>

        <input-background
            :src.sync="options.src"
            :classes.sync="options.classes">
        </input-background>

        <div class="uk-form-row">
            <label class="uk-form-label">{{ 'Inverse' | trans }}</label>
            <div class="uk-form-controls">
                <select-class
                    :classes.sync="options.classes"
                    :options="inverse"
                    :unselected="{index: 0, label: 'Default'}">
                </select-class>
            </div>
        </div>

        <div class="uk-form-row">
            <label class="uk-form-label">{{ 'Container size' | trans }}</label>
            <div class="uk-form-controls">
                <select v-model="options.container">
                    <option value="uk-container-xsmall">{{ 'XSmall'}}</option>
                    <option value="uk-container-small">{{ 'Small'}}</option>
                    <option value="">{{ 'Default'}}</option>
                    <option value="uk-container-large">{{ 'Large'}}</option>
                    <option value="uk-container-expand">{{ 'Expand'}}</option>
                </select>
            </div>
        </div>

        <div class="uk-form-row">
            <label class="uk-form-label">{{ 'Custom class' | trans }}</label>
            <div class="uk-form-controls">
                <input type="text" class="uk-form-width-large" v-model="options.custom" lazy>
            </div>
        </div>

    </div>

</template>

<script>

    import InputBackground from "./input-background.vue";

    module.exports = {

        extends: require('./component.js'),

        data: () => ({
            styles: {
                default: 'Default',
                muted: 'Muted',
                primary: 'Primary',
                secondary: 'Secondary'
            },
            sizes: {
                xsmall: 'XSmall',
                small: 'Small',
                large: 'Large',
                xlarge: 'XLarge'
            },
            containerSizes: {
                small: 'Small',
                large: 'Large',
                expand: 'Expand'
            },
            inverse: {
                ukDark: 'Dark',
                ukLight: 'Light'
            }
        }),

        components: {
            InputBackground
        }
    }

    window.$components['v-section'] = module.exports;

</script>