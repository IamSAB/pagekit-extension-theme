<template>

    <form class="uk-form-horizontal">

        <div class="uk-form-row">
            <label class="uk-form-label">{{ 'Type' | trans }}</label>
            <div class="uk-form-controls">
                <select v-model="widget.theme.type">
                    <option value="panel">{{ 'Panel' |trans }}</option>
                    <option value="tile">{{ 'Tile' |trans }}</option>
                    <option value="card">{{ 'Card' |trans }}</option>
                </select>
            </div>
        </div>

        <div v-if="widget.theme.type == 'tile'" class="uk-form-row">
            <label class="uk-form-label">{{ 'Tile Style' | trans }}</label>
            <div class="uk-form-controls">
                <select-class
                    :classes.sync="widget.theme.containerClasses"
                    :options="tileStyles"
                    prefix="uk-tile-"
                    :unselected="{index: 1, label: 'Default'}">
                </select-class>
            </div>
        </div>
        <template v-if="widget.theme.type == 'card'">
            <div class="uk-form-row">
                <label class="uk-form-label">{{ 'Card Style' | trans }}</label>
                <div class="uk-form-controls">
                    <select-class
                        :classes.sync="widget.theme.containerClasses"
                        :options="cardStyles"
                        prefix="uk-card-"
                        :unselected="{index: 1, label: 'Default'}">
                    </select-class>
                </div>
            </div>

            <div class="uk-form-row">
                <label class="uk-form-label">{{ 'Card options' | trans }}</label>
                <div class="uk-form-controls">
                    <div class="uk-grid uk-grid-small uk-margin-small-top" data-uk-grid-margin>
                        <div>
                            {{ 'Size' | trans }}
                            <select-class
                                :classes.sync="widget.theme.containerClasses"
                                :options="cardSizes"
                                prefix="uk-card-"
                                :unselected="{index: 1, label: 'Default'}">
                            </select-class>
                        </div>
                        <div>
                            {{ 'Has no card header or footer' | trans }}
                            <checkbox-class
                                :classes="widget.theme.containerClasses"
                                value="uk-card-body">
                            </checkbox-class>
                        </div>
                        <div>
                            {{ 'Hover effect' | trans }}
                            <checkbox-class
                                :classes="widget.theme.containerClasses"
                                value="uk-card-hover">
                            </checkbox-class>
                        </div>
                    </div>
                </div>
            </div>
        </template>

        <div class="uk-form-row">
            <label class="uk-form-label">{{ 'Text alignment' | trans }}</label>
            <div class="uk-form-controls">
                <select-class-responsive
                    :classes.sync="widget.theme.containerClasses"
                    :options="textAlignment"
                    prefix="uk-text-">
                </select-class-responsive>
            </div>
        </div>


        <div class="uk-form-row">
            <label class="uk-form-label">{{ 'Width' | trans }}</label>
            <div class="uk-form-controls uk-grid-uk-grid-small">
                <select-class-responsive
                    :classes.sync="widget.theme.gridItemClasses"
                    :options="widths"
                    prefix="uk-width-"
                    :unselected="{index: 0, label: 'Inherit'}">
                </select-class-responsive>
            </div>
        </div>

        <div class="uk-form-row">
            <label class="uk-form-label">{{ 'Order' | trans }}</label>
            <div class="uk-form-controls">
                <select-class-responsive
                    :classes.sync="widget.theme.gridItemClasses"
                    :options="itemOrder"
                    prefix="uk-flex-">
                </select-class-responsive>
            </div>
        </div>

        <div class="uk-form-row">
            <label class="uk-form-label">{{ 'Match item height' | trans }}</label>
            <div class="uk-form-controls">
                <checkbox-class
                    :classes.sync="widget.theme.gridItemClasses"
                    value="uk-grid-item-match">
                </checkbox-class>
            </div>
        </div>

        <div class="uk-form-row">
            <label class="uk-form-label">{{ 'Heading' | trans }}</label>
            <div class="uk-form-controls">
                <select v-model="widget.theme.heading">
                    <option value="hide">{{ 'Hide' | trans }}</option>
                    <option value="">{{ 'Default' | trans }}</option>
                    <option v-for="(value, label) in headings" :key="value" :value="value">{{ label }}</option>
                </select>
            </div>
        </div>

        <div class="uk-form-row">
            <label class="uk-form-label">{{ 'HTML Tag' | trans }}</label>
            <div class="uk-form-controls">
                <select v-model="widget.theme.htag">
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
                <input type="checkbox" v-model="widget.theme.hlink">
            </div>
        </div>

        <div class="uk-form-row">
            <label class="uk-form-label">{{ 'Custom class' | trans }}</label>
            <div class="uk-form-controls">
                <input type="text" class="uk-form-width-large" v-model="widget.theme.custom" lazy>
            </div>
        </div>

    </form>

</template>

<script>

    module.exports = {

        section: {
            label: 'Theme',
            priority: 90
        },

        props: {
            widget: {
                type: Object,
                required: true
            }
        },

        data: () => ({
            cardStyles: {
                default: 'Default',
                primary: 'Primary',
                secondary: 'Secondary'
            },
            cardSizes: {
                small: 'Small',
                large: 'Large'
            },
            tileStyles: {
                default: 'Default',
                muted: 'Muted',
                primary: 'Primary',
                secondary: 'Secondary'
            },
            textAlignment: {
                left: 'Left',
                right: 'Right',
                center: 'Center',
                justify: 'Justify'
            },
            itemOrder: {
                first: 'First',
                last: 'Last'
            },
            headings: {
                primary: 'Primary',
                hero: 'Hero',
                divider: 'Divider',
                bullet: 'Bullet',
                line: 'Line',
            },
            widths: {
                auto: 'Auto',
                expand: 'Expand',
                '1-1': '1/1 100%',
                '5-6':'5/6 83%',
                '4-5':'4/5 80%',
                '3-4':'3/4 75%',
                '2-3':'2/3 66%',
                '3-5':'3/5 60%',
                '1-2':'1/2 50%',
                '2-5':'2/5 40%',
                '1-3':'1/3 33%',
                '1-4':'1/4 25%',
                '1-5':'1/5 20%',
                '1-6':'1/6 17%',
            },
        })
    }

    Vue.component('SelectClass', require('./SelectClass.vue'));
    Vue.component('SelectClassResponsive', require('./SelectClassResponsive.vue'));
    Vue.component('SelectJsOpts', require('./SelectJsOpts.vue'));
    Vue.component('CheckboxClass', require('./CheckboxClass.vue'));

</script>
