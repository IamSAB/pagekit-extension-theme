<template>

    <div>

        <div class="uk-form-row">
            <label class="uk-form-label">{{ 'Style' | trans }}</label>
            <div class="uk-form-controls">
                <select v-model="options.style" class="uk-width-1-1">
                    <option value="hide">{{ 'Hide' | trans }}</option>
                    <option value="">{{ 'Default' | trans }}</option>
                    <option value="uk-heading-primary">{{ 'Primary' | trans }}</option>
                    <option value="uk-heading-hero">{{ 'Hero' | trans }}</option>
                    <option value="uk-heading-divider">{{ 'Divider' | trans }}</option>
                    <option value="uk-heading-bullet">{{ 'Bullet' | trans }}</option>
                    <option value="uk-heading-line">{{ 'Line' | trans }}</option>
                </select>
            </div>
        </div>

        <div class="uk-form-row">
            <label class="uk-form-label">{{ 'Tag' | trans }}</label>
            <div class="uk-form-controls">
                <select v-model="options.tag" class="uk-width-1-1">
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
            <label class="uk-form-label">{{ 'Link' | trans }}</label>
            <div class="uk-form-controls">
                <label>
                    <input type="checkbox" v-model="options.link"> {{ 'Create internal link' | trans }}
                </label>
            </div>
        </div>

    </div>

</template>

<script>

    // TODO add layout template and widget.theme

    module.exports = {

        extends: require('./update.js')
    }

</script>
