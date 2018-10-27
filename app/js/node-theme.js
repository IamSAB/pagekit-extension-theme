module.exports = {

    extends: require('../components/ui.vue'),

    section: {
        label: 'Theme',
        priority: 90
    },

    props: {
        node: {
            type: Object,
            required: true
        }
    },

    created () {
        this.configPath = 'node.theme';
    }
}

window.Site.components['node-theme'] = module.exports;
