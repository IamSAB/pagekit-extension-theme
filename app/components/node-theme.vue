<template>

    <div class="uk-grid pk-grid-large pk-width-sidebar-large uk-form-stacked" data-uk-grid-margin>

        <div class="pk-width-content">
            <div class="uk-flex uk-flex-middle uk-flex-space-between uk-flex-wrap uk-margin">
                <div class="uk-search">
                    <input class="uk-search-field uk-form-width-large" type="text" placeholder="Search ..." v-model="search" debounce="1000">
                </div>
                <ul class="uk-subnav pk-subnav-icon uk-visible-large">
                    <li :class="{'uk-active': view == 'list'}">
                        <a class="pk-icon-table pk-icon-hover" :title="'List View' | trans" data-uk-tooltip="{delay: 500}" @click.prevent="view = 'list'"></a>
                    </li>
                    <li class="{'uk-active': view == 'grid'}">
                        <a class="pk-icon-thumbnails pk-icon-hover" :title="'Grid View' | trans" data-uk-tooltip="{delay: 500}" @click.prevent="view = 'grid'"></a>
                    </li>
                </ul>
            </div>
            <div class="uk-flex uk-flex-middle uk-flex-space-between uk-flex-wrap uk-margin">
                <ul class="uk-subnav uk-subnav-pill uk-margin-remove">
                    <li v-for="(name, count) in types" class="uk-margin-remove" :class="{'uk-active': name == type}">
                        <a @click="type = name">{{ name }} [{{ count }}]</a>
                    </li>
                </ul>
                <div class="uk-text-muted uk-margin-bottom">{{ active.length }} {{ 'of' | trans }} {{ ui.length}} {{'elements' | trans }}</div>
            </div>
            <div>
                <div class="uk-form" :class="{'uk-form-horizontal': view == 'list', 'uk-form-stacked': view == 'grid'}">
                    <ul  v-if="active.length" class="uk-grid uk-grid-small" :class="{'uk-grid-width-large-1-2': view == 'grid'}" data-uk-grid-margin>
                        <li v-for="item in active" :class="{'uk-width-1-1': view == 'list'}">
                            <div class="uk-panel uk-panel-box uk-panel-box-secondary">
                                <h3 class="uk-panel-title uk-margin-remove">{{ item.title }}</h3>
                                <p v-if="item.description" class="uk-text-muted uk-text-small">{{ item.description }}</p>
                                <div class="uk-panel-badge">
                                    <label class="uk-form-condensed uk-text-muted">
                                        <input type="checkbox" v-model="node.theme[item.component][item.element].default">
                                        {{ 'Use defaults' | trans }}
                                    </label>
                                </div>
                                <div class="uk-margin" v-if="!node.theme[item.component][item.element].default">
                                    <component :is="'v-'+item.component"  :options="node.theme[item.component][item.element]" :update="item.component+'.'+item.element"></component>
                                </div>
                                <ul class="uk-breadcrumb uk-margin-remove uk-text-small">
                                    <li><span>{{ item.type }}</span></li>
                                    <li class="uk-active"><span>{{ item.component }}</span></li>
                                    <li><span>{{ item.element }}</span></li>
                                </ul>
                            </div>
                        </li>
                    </ul>
                    <h3 class="uk-h1 uk-text-muted uk-text-center" v-else>{{ 'Navigate to see more settings' | trans }}</h3>
                </div>
            </div>
        </div>

        <div class="pk-width-sidebar">

            <div class="uk-panel uk-panel-box uk-panel-box-secondary">
                <h3 class="uk-panel-title">{{ 'Heading' | trans }}</h3>
                <heading :options="node.theme.heading" update="heading"></heading>
            </div>

            <div class="uk-panel uk-panel-box uk-panel-box-secondary">

                <h3 class="uk-panel-title">{{ 'Menu' | trans }}</h3>

                <div class="uk-form-row">
                    <label class="uk-form-label">{{ 'Subtitle' | trans }}</label>
                    <div class="uk-form-controls">
                        <input type="text" class="uk-width-1-1" v-model="node.theme.menu.subtitle">
                    </div>
                </div>

                <div class="uk-form-row">
                    <label class="uk-form-label">{{ 'Icon' | trans }}</label>
                    <div class="uk-form-controls">
                        <input type="text" class="uk-width-1-1" v-model="node.theme.menu.icon">
                    </div>
                </div>

                <div class="uk-form-row">
                    <label class="uk-form-label">{{ 'Header' | trans }}</label>
                    <div class="uk-form-controls">
                        <input type="text" class="uk-width-1-1" v-model="node.theme.menu.header">
                    </div>
                </div>

                <div class="uk-form-row">
                    <label class="uk-form-label">{{ 'Divider' | trans }}</label>
                    <div class="uk-form-controls">
                        <label>
                            <input type="checkbox" v-model="node.theme.menu.divider"> {{ 'Add divider after menu item' | trans }}
                        </label>
                    </div>
                </div>

            </div>

        </div>

    </div>

</template>

<script>

    module.exports = {

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

        data: () => ({
            search: '',
            type: 'Position',
            view: 'grid',
            ui: window.$ui,
            type: 'Position'
        }),

        computed: {

            types () {
                let items = {};
                _.each(this.ui, (item) => {
                    if (_.has(items, item.type)) {
                        items[item.type]++;
                    }
                    else {
                        items[item.type] = 1;
                    }
                });
                return items;
            },

            active () {
                let items = [];
                if (this.search.length > 2) { // filter by search
                    items = _.filter(this.ui, (item) => {
                        return _.values(item).join(' ').search(this.search);
                    });
                }
                else {
                    items = _.filter(this.ui, (item) => {
                        return item.type == this.type;
                    });
                }

                return _.sortByOrder(items,['component','title'],['asc','asc']);
            }

        },

        events: {
            update (value, update) {
                this.$set('node.theme.'+update, value);
            }
        },

        components: window.$components
    }

    window.Site.components['node-theme'] = module.exports;

    Vue.component('select-class', require('./select-class.vue'));
    Vue.component('select-class-responsive', require('./select-class-responsive.vue'));
    Vue.component('select-javascript-options', require('./select-javascript-options.vue'));
    Vue.component('checkbox-javascript-options', require('./checkbox-javascript-options.vue'));
    Vue.component('checkbox-class', require('./checkbox-class.vue'));
    Vue.component('heading', require('./heading.vue'));
    Vue.component('card', require('./card.vue'));

</script>
