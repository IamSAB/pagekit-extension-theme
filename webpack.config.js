var path = require('path');

module.exports = [

    {
        entry: {
            "node-theme": "./app/js/node-theme.js",
            "site-theme-settings": "./app/js/site-theme-settings.js",
            "site-theme-defaults": "./app/components/site-theme-defaults.vue",
            "widget-layout": "./app/components/widget-layout.vue",
            "widget-position": "./app/components/widget-position.vue",
            "widget-position-grid": "./app/components/widget-position-grid.vue",
            "position-grid": "./app/components/position-grid.vue",
        },
        output: {
            filename: "./app/bundle/[name].js"
        },
        module: {
            loaders: [
                { test: /\.vue$/, loader: "vue" }
            ]
        }
    }

];