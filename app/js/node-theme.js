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
        this.sorting = ['top', 'main', 'bottom', 'foot']
        this.showIf('Main.Heading', 'node.type', (type) => type == 'page');
    }
}

window.Site.components['node-theme'] = module.exports;
