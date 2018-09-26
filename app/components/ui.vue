<template>

    <div>

        <div class="uk-flex uk-flex-middle uk-flex-space-between uk-flex-wrap">
            <div class="uk-flex uk-flex-middle uk-margin-bottom">
                <ul class="uk-breadcrumb uk-margin-remove">
                    <li v-for="item in breadcrumbs" :class="{'uk-active': item.active}" :key="item.path">
                        <span v-if="item.active" @click="navigate(item.path)">{{ item.title }}</span>
                        <a v-else @click="navigate(item.path)">{{ item.title }}</a>
                    </li>
                </ul>
                <i class="uk-margin-left uk-margin-small-right uk-icon-chevron-right"></i>
                <ul class="uk-subnav uk-subnav-line uk-margin-remove">
                    <li v-for="item in navigation" :key="item.path" class="uk-margin-remove">
                        <a @click="navigate(item.path)">{{ item.title }} ({{ item.children }})</a>
                    </li>
                </ul>
                <span v-if="!navigation.length" class="uk-margin-small-left uk-text-muted uk">{{'No children' | trans }}</span>
            </div>
            <span class="uk-text-muted uk-text-large uk-margin-bottom">{{ active.length }} of {{ settings.length }} {{'settings shown' | trans }}</span>
            <div class="uk-flex uk-margin-bottom">
                <div class="uk-search">
                    <input class="uk-search-field" type="text" placeholder="Search path ..." v-model="search" debounce="1000">
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
            <form class="uk-form" :class="{'uk-form-horizontal': view == 'list', 'uk-form-stacked': view == 'grid'}">
                <ul  v-if="active.length" class="uk-grid uk-grid-small" :class="{'uk-grid-width-medium-1-2 uk-grid-width-large-1-3': view == 'grid'}" data-uk-grid-margin>
                    <li v-for="item in active" :key="item.path" :class="{'uk-width-1-1': view == 'list'}">
                        <div class="uk-panel uk-panel-box uk-panel-box-secondary">
                            <h3 class="uk-panel-title">{{ item.title }} | <span class="uk-text-muted">{{ capitalize(item.component) }}</span></h3>
                            <component :is="item.component"  :setting="config[item.component][item.name]"></component>
                        </div>
                    </li>
                </ul>
                <h3 class="uk-h1 uk-text-muted uk-text-center" v-else>{{ 'Navigate to see more settings' | trans }}</h3>
            </form>
        </div>
    </div>

</template>

<script>

    console.log(window.$components);

    module.exports = {

        data: () => ({
            search: '',
            filter: '',
            path: '',
            view: 'grid',
            settings: window.$settings, // initalized settings
            configPath: '', // config path for settings
            sorting: [], // sorting for settings applied to first path subset
            showIfs: [] // showIf conditions for settings
        }),

        beforeCreate () {
            this.$options.components = window.Components;
        },

        computed: {

            config () {
                return this.$get(this.configPath);
            },

            navigation () {
                let children = [],
                    match;
                const regex = this.path ? new RegExp('(?<=^'+_.escapeRegExp(this.path)+'\/)([a-z]+)') : new RegExp('^[a-z]+');
                _.each(this.settings, (setting) => {
                    if (match = setting.path.match(regex)) {
                        children.push(match[0]);
                    }
                });

                let map = {};
                _.each(children, (child) => {
                    if (_.has(map, child)) {
                        map[child]++;
                    }
                    else {
                        map[child] = 1;
                    }
                });

                let items = [];
                _.forOwn(map, (value, key) => {
                    items.push({
                        title: _.capitalize(key),
                        path: this.path ? this.path+'/'+key : key,
                        children: value
                    });
                });

                return this.sort(items);
            },

            active () {
                return _.filter(this.settings, (setting) => {
                    return this.path == setting.path;
                });
            },

            // active () {
            //     let items = [], match, reg, showIf;
            //     if (this.search) {
            //         const search = _.escapeRegExp(this.search);
            //         reg = new RegExp(search,'i');
            //     }
            //     else {
            //         const path = _.escapeRegExp(this.path);
            //         reg = (this.path ? new RegExp('(?<=^' + path + '\\.)[^.]*$', 'i') : new RegExp('^[^.]*$', 'i'));
            //     }
            //     _.each(this.filtered, (item) => {
            //         match = item.path.match(reg);
            //         if (match) {
            //             item.title = item.path.split('.').slice(-1)[0],
            //             items.push(item);
            //         }
            //     })
            //     return this.sort(items);
            // },

            breadcrumbs () {
                let crumbs = [];
                if (this.path) {
                    let parts = this.path.split('/');
                    const l = parts.length;
                    for (let i = 0; i < l; i++) {
                        crumbs.unshift({
                            path: parts.join('.'),
                            title: parts.pop(),
                            active: i == 0
                        });
                    }
                }
                crumbs.unshift({
                    title: this.$trans('Theme'),
                    path: '',
                    active: !this.path
                });
                return crumbs;
            }

        },

        methods: {

            navigate (path) {
                this.path = path;
                this.search = '';
            },

            sort (array) {
                const reg = new RegExp('[^/]*');
                let aMatch, bMatch;
                return array.sort((a,b) => {
                    aMatch = a.path.match(reg)[0];
                    bMatch = b.path.match(reg)[0];
                    if ( aMatch == bMatch) {
                        return a.path.localeCompare(b.path);
                    }
                    else if (this.sorting.length) {
                        return this.sorting.indexOf(aMatch) - this.sorting.indexOf(bMatch);
                    }
                });
            },

            showIf (setting, dataPath, condition) {
                this.showIfs.push({
                    setting: setting,
                    dataPath: dataPath,
                    condition: condition // has to be a function
                })
            },

            capitalize (string) {
                return _.capitalize(string);
            },

        },

        events: {
            update(setting, value) {
                this.$set(this.configPath+'.'+setting, value);
            }
        },

        components: window.$components

    }

    Vue.component('SelectClass', require('./SelectClass.vue'));
    Vue.component('SelectClassResponsive', require('./SelectClassResponsive.vue'));
    Vue.component('SelectJsOpts', require('./SelectJsOpts.vue'));
    Vue.component('CheckboxClass', require('./CheckboxClass.vue'));

</script>