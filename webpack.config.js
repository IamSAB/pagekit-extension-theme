var path = require('path');

module.exports = [

    {
        entry: {
            "site-theme": "./app/js/site-theme",
            "node-theme": "./app/js/node-theme",
            "widget-theme": "./app/js/widget-theme",
        },
        output: {
            filename: "./app/bundle/[name].js"
        },
        module: {
            loaders: [
                { test: /\.vue$/, loader: "vue" }
            ]
        }
    },

    {
        entry: {
            "segment": "./app/components/setting-segment.vue",
            "grid": "./app/components/setting-grid.vue",
            "widget": "./app/components/setting-widget.vue",
            "heading": "./app/components/setting-heading.vue",
            "navbar": "./app/components/setting-navbar.vue",
            "nav": "./app/components/setting-nav.vue",
            "navbarnav": "./app/components/setting-navbarnav.vue",
            "subnav": "./app/components/setting-subnav.vue",
            "card": "./app/components/setting-card.vue",
            "tile": "./app/components/setting-tile.vue"
        },
        output: {
            filename: "./app/bundle/settings/[name].js"
        },
        module: {
            loaders: [
                { test: /\.vue$/, loader: "vue" }
            ]
        }
    }

];