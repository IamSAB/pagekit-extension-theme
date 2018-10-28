<template>
    <div class="uk-form uk-form-horizontal">
        <h3 v-if="component == 'no-position'" class="uk-h1 uk-text-muted uk-text-center">{{ 'First select a widget position.' | trans }}</h3>
        <h3 v-if="component == 'no-options'" class="uk-h1 uk-text-muted uk-text-center">{{ 'No options available.' | trans }}</h3>
        <component v-if="component != 'no-position' && component != 'no-options'" :is="'v-'+component" :options="widget.theme[component]"></component>
    <div>
</template>

<script>

    module.exports = {

        section: {
            label: 'Position',
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
                if (!this.widget.position) {
                    return 'no-position';
                }
                let res = 'no-options';
                _.each(window.$ui, (elements, component) => {
                    if (_.includes(elements, this.widget.position)) {
                        res = component;
                        return false;
                    }
                });
                return res;
            }
        },

        components: window.$positions
    }

    window.Widgets.components['position'] = module.exports;

    Vue.component('select-class', require('./select-class.vue'));
    Vue.component('select-class-responsive', require('./select-class-responsive.vue'));
    Vue.component('select-javascript-options', require('./select-javascript-options.vue'));
    Vue.component('checkbox-class', require('./checkbox-class.vue'));

</script>
