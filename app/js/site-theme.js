module.exports = {

    extends: require('../components/ui.vue'),

    section: {
        label: 'Theme',
        icon: 'pk-icon-large-brush',
        priority: 14
    },

    data: () => ({
        themeName: window.$themeName,
        themeConfig: window.$themeConfig,
        topBar: true
    }),

    created () {
        this.configPath = 'themeConfig';
    },

    components: window.$components,

    events: {

        save: function() {

            this.$http.post('admin/system/settings/config', {name: this.themeName, config: this.config}).catch(function (res) {
                this.$notify(res.data, 'danger');
            });

        }

    }
}

window.Site.components['theme'] = module.exports;