module.exports = {

    props: {
        options: {
            type: Object,
            required: true
        },
        component: {
            type: String,
            required: true
        },
        element: {
            type: String,
            required: true
        }
    },

    watch: {
        options: {
            handler: function() {
                this.$dispatch('update', this.component, this.element, this.options);
            },
            deep: true
        }
    }
}