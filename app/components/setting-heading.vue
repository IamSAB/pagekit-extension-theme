<template>

    <div>

        <div class="uk-form-row">
            <label class="uk-form-label">{{ 'Heading' | trans }}</label>
            <div class="uk-form-controls">
                <select v-model="setting.heading">
                    <option value="hide">{{ 'Hide' | trans }}</option>
                    <option value="">{{ 'Default' | trans }}</option>
                    <option v-for="(value, label) in headings" :key="value" :value="value">{{ label }}</option>
                </select>
            </div>
        </div>

        <div class="uk-form-row">
            <label class="uk-form-label">{{ 'HTML Tag' | trans }}</label>
            <div class="uk-form-controls">
                <select v-model="setting.tag">
                    <option value="">{{ 'Default' | trans }}</option>
                    <option value="h1">H1</option>
                    <option value="h2">H2</option>
                    <option value="h3">H3</option>
                    <option value="h4">H4</option>
                    <option value="h5">H5</option>
                    <option value="h6">H6</option>
                </select>
            </div>
        </div>

        <div class="uk-form-row">
            <label class="uk-form-label">{{ 'Link heading' | trans }}</label>
            <div class="uk-form-controls">
                <input type="checkbox" v-model="setting.link">
            </div>
        </div>

    </div>

</template>

<script>

    module.exports = {

        extends: require('./setting.js'),

        data: () => ({
            headings: {
                primary: 'Primary',
                hero: 'Hero',
                divider: 'Divider',
                bullet: 'Bullet',
                line: 'Line',
            },
        })
    }

    window.$components['heading'] = module.exports;


</script>
