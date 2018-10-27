<template>
    <div>
        <component v-if="component" :is="component" :options="widget.theme[component]"></component>
        <h3 v-else class="uk-h1 uk-text-muted uk-text-center">{{ 'First select a widget position' | trans }}</h3>
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
                    return '';
                }
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


        components: window.$positions
    }

    window.Widgets.components['position'] = module.exports;

</script>
