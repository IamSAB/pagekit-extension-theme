<template>

    <div class="uk-child-width-1-2 uk-form uk-form-horizontal">

        <div>

            <div class="uk-form-row">
                <label class="uk-form-label">{{ 'Heading' | trans }}</label>
                <div class="uk-form-controls">
                    <select v-model="widget.theme.h_style">
                        <option value="hide">{{ 'Hide' | trans }}</option>
                        <option value="">{{ 'Default' | trans }}</option>
                        <option v-for="(value, label) in headings" :key="value" :value="value">{{ label }}</option>
                    </select>
                </div>
            </div>

            <div class="uk-form-row">
                <label class="uk-form-label">{{ 'HTML Tag' | trans }}</label>
                <div class="uk-form-controls">
                    <select v-model="widget.theme.h_tag">
                        <option value="">{{ 'Default' | trans }}</option>
                        <option value="h1">H1</option>
                        <option value="h2">H2</option>
                        <option value="h3">H3</option>
                        <option value="h4">H4</option>
                        <option value="h5">H5</option>
                        <option value="h6">H6</option>
                    </select>
                </div>
            </div>

            <div class="uk-form-row">
                <label class="uk-form-label">{{ 'Link heading' | trans }}</label>
                <div class="uk-form-controls">
                    <input type="checkbox" v-model="widget.theme.h_link">
                </div>
            </div>

        </div>

        <div>
            <div class="uk-form-row">
                <label class="uk-form-label">{{ 'Style' | trans }}</label>
                <div class="uk-form-controls">
                    <select-class
                        :classes.sync="widget.theme.classes"
                        :options="styles"
                        prefix="uk-card-">
                    </select-class>
                </div>
            </div>

            <div class="uk-form-row">
                <label class="uk-form-label">{{ 'Size' | trans }}</label>
                <div class="uk-form-controls">
                    <select-class
                        :classes.sync="widget.theme.classes"
                        :options="sizes"
                        prefix="uk-card-">
                    </select-class>
                </div>
            </div>

            <div class="uk-form-row">
                <label class="uk-form-label">{{ 'Hover effect' | trans }}</label>
                <div class="uk-form-controls">
                    <checkbox-class
                        :classes.sync="widget.theme.classes"
                        value="uk-card-hover">
                    </checkbox-class>
                </div>
            </div>

        </div>

    </div>

</template>

<script>

    // TODO add layout template and widget.theme

    module.exports = {

        section: {
            label: 'Layout',
            priority: 90
        },

        props: {
            widget: {
                type: Object,
                required: true
            }
        },

        data: () => ({
            headings: {
                primary: 'Primary',
                hero: 'Hero',
                divider: 'Divider',
                bullet: 'Bullet',
                line: 'Line',
            },
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

    window.Widgets.components['layout'] = module.exports;

    Vue.component('select-class', require('./select-class.vue'));
    Vue.component('select-class-responsive', require('./select-class-responsive.vue'));
    Vue.component('select-javascript-options', require('./select-javascript-options.vue'));
    Vue.component('checkbox-class', require('./checkbox-class.vue'));

</script>
