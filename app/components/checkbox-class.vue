<template>
    <input type="checkbox" v-model="model">
</template>

<script>

    /**
        TODO: adapt component to use v-model instead of sync properties
        - Bind the value attribute to a value prop
        - On input, emit its own custom input event with the new value e.g. $emit('input', $event.target.value)
     */

    // TODO does not set inital state correctly

    module.exports = {

        props: {
            classes: {
                type: String,
                required: true
            },
            value: {
                type: String,
                required: true
            }
        },

        data: () => ({
            model: ''
        }),

        created () {
            this.model = _.includes(this.classes, this.value);
            this.$watch('model', function (checked,old) {
                if (checked) {
                    this.classes += ' '+this.value;
                }
                else if (_.includes(this.classes, this.value) && old) {
                    this.classes = _.trim(this.classes.replace(this.value, ''));
                }
            });
        }
    }

</script>