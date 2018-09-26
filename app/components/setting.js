module.exports = {

    props: {
        setting: {
            type: Object,
            required: true
        }
    },

    watch: {
        setting: {
            handler: function() {
                this.$dispatch('update', this.$options.name, this.setting);
            },
            deep: true
        }
    }
}