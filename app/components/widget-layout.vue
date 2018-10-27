<template>
    <div>
        CARD Layout options
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
        }
    }

    window.Widgets.components['layout'] = module.exports;

</script>
