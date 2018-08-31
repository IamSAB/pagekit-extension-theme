module.exports = [

    {
        entry: {
            "SiteSettingTheme": "./app/components/SiteSettingTheme.vue",
            "SiteNodeTheme": "./app/components/SiteNodeTheme",
            "SiteWidgetTheme": "./app/components/SiteWidgetTheme.vue",
            "uikit": "./app/uikit.js"
        },
        output: {
            filename: "./app/bundle/[name].js"
        },
        module: {
            loaders: [
                { test: /\.vue$/, loader: "vue" }
            ]
        },
    }

];