<template>

    <div>

        <div v-if="topBar" class="uk-margin uk-flex uk-flex-space-between uk-flex-wrap" data-uk-margin>
            <div data-uk-margin>
                <h2 class="uk-margin-remove">{{ 'Theme' | trans }}</h2>
            </div>
            <div data-uk-margin>
                <button class="uk-button uk-button-primary" type="submit">{{ 'Save' | trans }}</button>
            </div>
        </div>

        <div class="uk-flex uk-flex-middle uk-flex-space-between uk-flex-wrap">
            <div class="uk-flex uk-flex-middle uk-margin-bottom">
                <ul class="uk-subnav uk-subnav-pill uk-margin-remove">
                    <li v-for="(name, item) in navigation" class="uk-margin-remove" :class="{'uk-active': isActive(name)}">
                        <a @click="toggle(name)">{{ item.title }} #{{ item.count }}</a>
                    </li>
                </ul>
            </div>
            <span class="uk-text-muted uk-text-large uk-margin-bottom">{{ active.length }} of {{ ui.length }} {{'elements shown' | trans }}</span>
            <div class="uk-flex uk-margin-bottom">
                <div class="uk-search">
                    <input class="uk-search-field" type="text" placeholder="Search ..." v-model="search" debounce="1000">
                </div>
                <ul class="uk-subnav pk-subnav-icon">
                    <li :class="{'uk-active': view == 'list'}">
                        <a class="pk-icon-table pk-icon-hover" :title="'List View' | trans" data-uk-tooltip="{delay: 500}" @click.prevent="view = 'list'"></a>
                    </li>
                    <li class="{'uk-active': view == 'grid'}">
                        <a class="pk-icon-thumbnails pk-icon-hover" :title="'Grid View' | trans" data-uk-tooltip="{delay: 500}" @click.prevent="view = 'grid'"></a>
                    </li>
                </ul>
            </div>
        </div>
        <div>
            <div class="uk-form" :class="{'uk-form-horizontal': view == 'list', 'uk-form-stacked': view == 'grid'}">
                <ul  v-if="active.length" class="uk-grid uk-grid-small" :class="{'uk-grid-width-medium-1-2 uk-grid-width-large-1-3': view == 'grid'}" data-uk-grid-margin>
                    <li v-for="item in active" :class="{'uk-width-1-1': view == 'list'}">
                        <div class="uk-panel uk-panel-box uk-panel-box-secondary">
                            <h3 class="uk-panel-title">{{ item.title }}</h3>
                            <p v-if="item.description">{{ item.description }}</p>
                            <component :is="item.component"  :options="config[item.component][item.element]" :component="item.component" :element="item.element"></component>
                        </div>
                    </li>
                </ul>
                <h3 class="uk-h1 uk-text-muted uk-text-center" v-else>{{ 'Navigate to see more settings' | trans }}</h3>
            </div>
        </div>
    </div>

</template>

<script>

    module.exports = {

        data: () => ({
            search: '',
            tags: [],
            view: 'grid',
            ui: window.$ui,
            configPath: '',
            topBar: false
        }),

        computed: {

            config () {
                return this.$get(this.configPath);
            },

            navigation () {
                let tags = {};
                _.each(this.ui, (element) => {
                    _.each(element.tags, (tag) => {
                        if (_.has(tags, tag)) {
                            tags[tag].count++;
                        }
                        else {
                            tags[tag] = {
                                count: 1,
                                title: _.capitalize(tag)
                            };
                        }
                    });
                });
                return tags;
            },

            active () {
                let items = [];
                if (this.search.length > 2) { // filter by search
                    items = _.filter(this.ui, (item) => {
                        return item.title.search(this.search) > -1
                            || item.element.search(this.search) > -1
                            || item.component.search(this.search) > -1
                            || item.description.search(this.search) > -1
                    });
                }
                else if (!this.tags.length) {
                    items = this.ui;
                }
                else {
                    items = _.filter(this.ui, (item) => { // filter by tags
                        return _.intersection(item.tags, this.tags).length;
                    });
                }

                return _.sortByOrder(items,['component','title'],['asc','asc']);
            }

        },

        methods: {

            toggle (tag) {
                this.search = '';
                if (this.isActive(tag)) {
                    this.tags = this.tags.filter(item => item !== tag);
                }
                else {
                    this.tags.push(tag);
                }
            },

            isActive (tag) {
                return _.includes(this.tags, tag);
            }

        },

        events: {
            update (component, element, value) {
                this.$set(this.configPath+'.'+component+'.'+element, value);
            }
        },

        components: window.$components

    }

    Vue.component('select-class', require('./select-class.vue'));
    Vue.component('select-class-responsive', require('./select-class-responsive.vue'));
    Vue.component('select-javascript-options', require('./select-javascript-options.vue'));
    Vue.component('checkbox-class', require('./checkbox-class.vue'));

</script>
