module.exports = {

    extends: require('../components/ui.vue'),

    section: {
        label: 'Theme',
        priority: 90
    },

    props: {
        widget: {
            type: Object,
            required: true
        }
    },

    created () {
        this.sorting = ['Widget','Heading', 'Card', 'Tile'];
        this.configPath = 'widget.theme';
    }
}

window.Widgets.components['theme'] = module.exports;