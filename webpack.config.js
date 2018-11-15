var path = require('path');

module.exports = [

    {
        entry: {
            "position-grid": "./app/components/position-grid.vue",
            "widget-position-grid": "./app/components/widget-position-grid.vue",
            "widget-position-hero": "./app/components/widget-position-hero.vue",
            "section": "./app/components/section.vue",
            "position-hero": "./app/components/position-hero.vue",
            "node-theme": "./app/components/node-theme.vue",
            "site-theme": "./app/components/site-theme.vue",
            "widget-theme": "./app/components/widget-theme.vue"
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