module.exports = {

    props: {
        options: {
            type: Object,
            required: true
        },
        update: {
            type: String,
            required: true
        }
    },

    watch: {
        options: {
            handler () {
                // TODO implement debounce
                this.$dispatch('update', this.options, this.update);
            },
            deep: true
        }
    }
}