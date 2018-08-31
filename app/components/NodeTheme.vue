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
                        <a @click="navigate(item.path)">{{ item.title }}</a>
                    </li>
                </ul>
                <span v-if="!navigation.length" class="uk-margin-small-left uk-text-muted uk">{{'No children' | trans }}</span>
            </div>
            <span class="uk-text-muted uk-text-large uk-margin-bottom">{{ components.length }} of {{ settings.length }} {{'settings shown' | trans }}</span>
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
                <ul  v-if="components.length" class="uk-grid uk-grid-small" :class="{'uk-grid-width-medium-1-2 uk-grid-width-large-1-3': view == 'grid'}" data-uk-grid-margin>
                    <li v-for="item in components" :key="item.path" :class="{'uk-width-1-1': view == 'list'}">
                        <div class="uk-panel uk-panel-box uk-panel-box-secondary">
                            <div class="uk-panel-badge uk-badge">{{ item.path.split('.').join(' / ') }}</div>
                            <h2 class="uk-panel-title">{{ item.title }}</h2>
                            <component :is="item.component"  :setting="theme[item.component]"></component>
                        </div>
                    </li>
                </ul>
                <h3 class="uk-h1 uk-text-muted uk-text-center" v-else>{{ 'Navigate to see more settings' | trans }}</h3>
            </form>
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
            filter: '',
            path: '',
            view: 'grid',
            active: [],
            settings: [],
            sorting: ['Head','Top','Main','Bottom','Foot'],
            theme: []
        }),

        created () {
            _.forIn(this.$options.components, (component, name) => {
                const options = component.options || {};
                if (options.path) {
                    this.settings.push({
                        path: options.path,
                        component: name
                    });
                }
            });
            this.theme = this.node.theme;
        },

        events: {
            'setting.update': function (name, value) {
                this.node.theme[name] = value;
            }
        },

        watch: {
            view () {
                $(window).trigger("resize");
            }
        },

        computed: {

            filtered () {
                let filtered = this.settings,
                    sort = ['Head','Top','Main','Bottom','Foot'],
                    regex = new RegExp('[^.]*');
                if (this.filter) {
                    filtered = _.filter(this.settings, (setting) => {
                        return setting.path.match(new RegExp(this.filter,'i'));
                    });
                }
                let aMatch, bMatch;

                return filtered.sort((a,b) => {
                    aMatch = a.path.match(regex)[0];
                    bMatch = b.path.match(regex)[0];
                    if ( aMatch == bMatch) {
                        return a.path - b.path;
                    }
                    else {
                        return sort.indexOf(aMatch) - sort.indexOf(bMatch);
                    }
                });
            },

            navigation () {
                let match,
                    items = [],
                    path = _.escapeRegExp(this.path),
                    reg = this.path ? new RegExp('(?<=' + path + '\\.).*?(?=\\.)','i') : new RegExp('^[^.]*','i');
                _.each(this.settings, (setting) => {
                    match = setting.path.match(reg);
                    if (match && !_.find(items,{title: match})) {
                        items.push({
                            title: match,
                            component: setting.component,
                            path: ((this.path ? this.path +'.' : '') + match)
                        })
                    }
                });
                return this.sort(items);
            },

            components () {
                let items = [], match, reg;
                if (this.search) {
                    const search = _.escapeRegExp(this.search);
                    reg = new RegExp(search,'i');
                }
                else {
                    const path = _.escapeRegExp(this.path);
                    reg = (this.path ? new RegExp('(?<=^' + path + '\\.)[^.]*$', 'i') : new RegExp('^[^.]*$', 'i'));
                }
                _.each(this.settings, (setting) => {
                    match = setting.path.match(reg);
                    if (match) {
                        items.push({
                            title: match,
                            component: setting.component,
                            path: setting.path
                        })
                    }
                })
                return this.sort(items);
            },

            breadcrumbs () {
                let crumbs = [];
                if (this.path) {
                    let parts = this.path.split('.');
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
                const reg = new RegExp('[^.]*');
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
            }

        }
    }

    Vue.component('SelectClass', require('./SelectClass.vue'));
    Vue.component('SelectClassResponsive', require('./SelectClassResponsive.vue'));
    Vue.component('SelectJsOpts', require('./SelectJsOpts.vue'));
    Vue.component('CheckboxClass', require('./CheckboxClass.vue'));

</script>
