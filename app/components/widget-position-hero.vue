<template>

    <div>

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
            }
        })
    }

    window.$positions['v-hero'] = module.exports;

</script>
