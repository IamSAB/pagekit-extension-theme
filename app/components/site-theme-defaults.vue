<template>
    <div>
        DEFAULTS
    </div>
</template>

<script>

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

        components: window.$components
    }

    window.Widgets.components['theme-layout'] = module.exports;

</script>
