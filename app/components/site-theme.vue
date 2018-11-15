<template>

    <div>

        <div class="uk-margin uk-flex uk-flex-space-between uk-flex-wrap" data-uk-margin>
            <div data-uk-margin>
                <h2 class="uk-margin-remove">{{ 'Theme' | trans }}</h2>
            </div>
            <div data-uk-margin>
                <div class="uk-search">
                    <input class="uk-search-field" type="text" placeholder="Search ..." v-model="search" debounce="500">
                </div>
                <button class="uk-button uk-button-primary" type="submit">{{ 'Save' | trans }}</button>
            </div>
        </div>

        <div v-if="active.length">
            <div class="uk-block" v-for="item in active">
                <h3>{{ item.title }}</h3>
                <p v-if="item.description">{{ item.description }}</p>
                <component :is="'v-'+item.component"  :options="config[item.component]" :update="item.component"></component>
            </div>
        </div>

        <h3 class="uk-h1 uk-text-muted uk-text-center" v-else>{{ 'No components found.' | trans }}</h3>

    </div>

</template>

<script>

    module.exports = {

        // TODO stacked for grid view not working as parent form with class uk-form-horizontal overwrites it

        section: {
            label: 'Theme',
            icon: 'pk-icon-large-brush',
            priority: 14
        },

        data: () => ({
            themeName: window.$themeName,
            config: window.$themeConfig,
            search: ''
        }),

        computed: {

            active () {
                let items = [];
                if (this.search.length > 2) { // filter by search
                    items = _.filter(window.$ui, (item) => {
                        return item.title.search(this.search) > -1
                            || item.component.search(this.search) > -1
                            || item.description.search(this.search) > -1
                    });
                }
                else {
                    items = window.$ui;
                }

                return _.sortByOrder(items,['title'],['asc']);
            }

        },

        events: {
            update (update, value) {
                this.config[update] = value;
            }
        },

        components: window.$components,

        events: {

            save: function() {

                this.$http.post('admin/system/settings/config', {name: this.themeName, config: this.config}).catch(function (res) {
                    this.$notify(res.data, 'danger');
                });

            }

        }
    }

    Vue.component('select-class', require('./select-class.vue'));
    Vue.component('select-class-responsive', require('./select-class-responsive.vue'));
    Vue.component('select-javascript-options', require('./select-javascript-options.vue'));
    Vue.component('checkbox-class', require('./checkbox-class.vue'));

    window.Site.components['theme'] = module.exports;

</script>
