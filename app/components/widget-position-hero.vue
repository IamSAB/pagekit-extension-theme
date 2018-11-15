<template>

    <div class="uk-form-horizontal">

        <div class="uk-form-row">
            <label class="uk-form-label">{{ 'Position' | trans }}</label>
            <div class="uk-form-controls">
                <select-class
                    :classes.sync="options.classes"
                    :options="positions"
                    prefix="uk-position-">
                </select-class>
            </div>
        </div>

        <div class="uk-form-row">
            <label class="uk-form-label">{{ 'Modifier' | trans }}</label>
            <div class="uk-form-controls">
                <select-class
                    :classes.sync="options.classes"
                    :options="modifiers"
                    prefix="uk-position-">
                </select-class>
            </div>
        </div>

        <div class="uk-form-row">
            <label class="uk-form-label">{{ 'Overlay' | trans }}</label>
            <div class="uk-form-controls">
                <select-class
                    :classes.sync="options.classes"
                    :options="overlays"
                    prefix="uk-overlay-">
                </select-class>
            </div>
        </div>

        <div class="uk-form-row">
            <label class="uk-form-label">{{ 'Text alignment' | trans }}</label>
            <div class="uk-form-controls">
                <select-class-responsive
                    :classes.sync="options.classes"
                    :options="textAlignment"
                    prefix="uk-text-">
                </select-class-responsive>
            </div>
        </div>

        <div class="uk-form-row">
            <label class="uk-form-label">{{ 'Width' | trans }}</label>
            <div class="uk-form-controls uk-grid-uk-grid-small">
                <select-class-responsive
                    :classes.sync="options.classes"
                    :options="widths"
                    prefix="uk-width-"
                    :unselected="{index: 0, label: 'Inherit'}">
                </select-class-responsive>
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

        props: {
            options: {
                type: Object,
                required: true
            }
        },

        data: () => ({
            positions: {
                top: 'Top',
                left: 'Left',
                right: 'Right',
                bottom: 'Bottom',
                topLeft: 'Top Left',
                topCenter: 'Top Center',
                topRight: 'Top Right',
                centerLeft: 'Center Left',
                center: 'Center',
                centerRight: 'Center Right',
                bottomLeft: 'Bottom Left',
                bottomCenter: 'Bottom Center',
                bottomRight: 'Bottom Right',
            },
            modifiers: {
                small: 'Small',
                medium: 'Medium',
                large: 'Large'
            },
            overlays: {
                default: 'Default',
                primary: 'Primary'
            },
            textAlignment: {
                left: 'Left',
                right: 'Right',
                center: 'Center',
                justify: 'Justify'
            },
            itemOrder: {
                first: 'First',
                last: 'Last'
            },
            widths: {
                auto: 'Auto',
                '5-6':'5/6 83%',
                '4-5':'4/5 80%',
                '3-4':'3/4 75%',
                '2-3':'2/3 66%',
                '3-5':'3/5 60%',
                '1-2':'1/2 50%',
                '2-5':'2/5 40%',
                '1-3':'1/3 33%',
                '1-4':'1/4 25%',
                '1-5':'1/5 20%',
                '1-6':'1/6 17%',
            }
        })
    }

    window.$components['v-hero'] = module.exports;

</script>
