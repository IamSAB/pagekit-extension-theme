<template>

    <div class="uk-grid pk-grid-large pk-width-sidebar-large uk-form-stacked" data-uk-grid-margin>

        <div class="pk-width-content">
            <component v-if="component" :is="'v-'+component" :options="widget.theme[component]" :update="component"></component>
            <h3 class="uk-h1 uk-text-muted uk-text-center" v-else>{{ 'Select a position first.' | trans }}</h3>
        </div>

        <div class="pk-width-sidebar">
            <heading :options="widget.theme.heading" update="heading"></heading>
        </div>

    </div>

</template>

<script>

    module.exports = {

        section: {
            label: 'Theme',
            priority: 80
        },

        props: {
            widget: {
                type: Object,
                required: true
            }
        },

        computed: {
            component() {
                let res;
                _.each(window.$ui, (elements, component) => {
                    if (_.includes(elements, this.widget.position)) {
                        res = component;
                        return false;
                    }
                });
                return res;
            }
        },

        events: {
            update (value, update) {
                this.$set('widget.theme.'+update, value);
            }
        },

        components: window.$components
    }

    window.Widgets.components['widget-theme'] = module.exports;

    Vue.component('select-class', require('./select-class.vue'));
    Vue.component('select-class-responsive', require('./select-class-responsive.vue'));
    Vue.component('select-javascript-options', require('./select-javascript-options.vue'));
    Vue.component('checkbox-class', require('./checkbox-class.vue'));
    Vue.component('heading', require('./heading.vue'));
    Vue.component('card', require('./card.vue'));

</script>
