module.exports = {

    extends: require('../components/ui.vue'),

    section: {
        label: 'Theme',
        icon: 'pk-icon-large-brush',
        priority: 15
    },

    data: () => ({
        config: window.$theme
    }),

    created () {
        this.configPath = 'config';
    },

    components: window.$components,

    events: {

        save: function() {

            this.$http.post('admin/system/settings/config', {name: this.name, config: this.config}).catch(function (res) {
                this.$notify(res.data, 'danger');
            });

        }

    }
}

window.Site.components['theme'] = module.exports;