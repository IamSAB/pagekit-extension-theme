<template>

    <div class="uk-form-horizontal">

        <card :options="options.card" :update="update+'.card'"></card>

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
            <label class="uk-form-label">{{ 'Order' | trans }}</label>
            <div class="uk-form-controls">
                <select-class-responsive
                    :classes.sync="options.classes"
                    :options="itemOrder"
                    prefix="uk-flex-">
                </select-class-responsive>
            </div>
        </div>

        <div class="uk-form-row">
            <label class="uk-form-label">{{ 'Match item height' | trans }}</label>
            <div class="uk-form-controls">
                <checkbox-class
                    :classes.sync="options.classes"
                    value="uk-grid-item-match">
                </checkbox-class>
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

        extends: require('./update.js'),

        data: () => ({
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
                expand: 'Expand',
                '1-1': '1/1 100%',
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

    window.$components['v-grid'] = module.exports;

</script>
