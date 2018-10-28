<template>

    <div>

        <div class="uk-form-row">
            <label class="uk-form-label">{{ 'Grid Width' | trans }}</label>
            <div class="uk-form-controls uk-grid-uk-grid-small">
                <select-class-responsive
                    class="uk-form-small"
                    :classes.sync="options.classes"
                    :options="childWidths"
                    prefix="uk-child-width-">
                </select-class-responsive>
            </div>
        </div>

        <div class="uk-form-row">
            <label class="uk-form-label">{{ 'Grid Gutter' | trans }}</label>
            <div class="uk-form-controls">
                <select-class
                    :classes.sync="options.classes"
                    :options="gutters"
                    prefix="uk-grid-"
                    :unselected="{index: 1, label: 'Default'}">
                </select-class>
            </div>
        </div>

        <div class="uk-form-row">
            <label class="uk-form-label">{{ 'Grid options' | trans }}</label>
            <div class="uk-form-controls uk-form-controls-text">
                <p class="uk-form-controls-condensed">
                    <label>
                        {{ 'Use divider' | trans }}
                        <checkbox-class
                            :classes.sync="options.classes"
                            value="uk-grid-divider">
                        </checkbox-class>
                    </label>
                    <label class="uk-margin-small-left">
                        {{ 'Match height' | trans }}
                        <checkbox-class
                            :classes.sync="options.classes"
                            value="uk-grid-match">
                        </checkbox-class>
                    </label>
                </p>
            </div>
        </div>

        <div class="uk-form-row">
            <label class="uk-form-label">{{ 'Horizontal align' | trans }}</label>
            <div class="uk-form-controls">
                <select-class-responsive
                    :classes.sync="options.classes"
                    :options="horizontalAlign"
                    prefix="uk-flex-">
                </select-class-responsive>
            </div>
        </div>

        <div class="uk-form-row">
            <label class="uk-form-label">{{ 'Vertical align' | trans }}</label>
            <div class="uk-form-controls">
                <select-class-responsive
                    :classes.sync="options.classes"
                    :options="verticalAlign"
                    prefix="uk-flex-">
                </select-class-responsive>
            </div>
        </div>

        <div class="uk-form-row">
            <label for="form-hero-height" class="uk-form-label">{{ 'Fixed height' | trans }}</label>
            <div class="uk-form-controls">
                <select v-model="options.height">
                    <option value="">{{ 'Disabled' }}</option>
                    <option value="viewport">{{ 'Viewport' | trans }}</option>
                    <option value="uk-height-small">{{ '150px' }}</option>
                    <option value="uk-height-medium">{{ '300px' }}</option>
                    <option value="uk-height-large">{{ '450px' }}</option>
                </select>
                <div v-if="options.height == 'viewport'" class="uk-grid uk-grid-small uk-margin-small-top" data-uk-grid-margin>
                    <div>
                        {{ 'Offset top' | trans }}
                        <select-javascript-options
                            class="uk-form-small"
                            :value.sync="options.ukHeightViewport"
                            :options="{true: 'True', false: 'False'}"
                            key="offset-top">
                        </select-javascript-options>
                    </div>
                    <div>
                        {{ 'Offset bottom' | trans }}
                        <select-javascript-options
                            class="uk-form-small"
                            :value.sync="options.ukHeightViewport"
                            :options="{true: 'True', false: 'False'}"
                            key="offset-bottom">
                        </select-javascript-options>
                    </div>
                    <div>
                        {{ 'Expand' | trans }}
                        <select-javascript-options
                            class="uk-form-small"
                            :value.sync="options.ukHeightViewport"
                            :options="{true: 'True', false: 'False'}"
                            key="expand">
                        </select-javascript-options>
                    </div>
                </div>
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

    module.exports = {

        extends: require('./component.js'),

        data: () => ({
            gutters: {
                small: 'Small',
                medium: 'Medium',
                large: 'Large',
                collapse: 'Collapse',
            },
            horizontalAlign: {
                left: 'Left',
                center: 'Center',
                right: 'Right',
                between: 'Between',
                around: 'Around'
            },
            verticalAlign: {
                top: 'Top',
                middle: 'Middle',
                bottom: 'Bottom',
                stretch: 'Stretch'
            },
            childWidths: {
                auto: 'Auto',
                expand: 'Expand',
                '1-2':'1/2 50%',
                '1-3':'1/3 33%',
                '1-4':'1/4 25%',
                '1-5':'1/5 20%',
                '1-6':'1/6 17%',
            }
        })
    }

    window.$components['v-grid'] = module.exports;

</script>