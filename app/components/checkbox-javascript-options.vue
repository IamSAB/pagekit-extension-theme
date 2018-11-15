<template>
    <input type="checkbox" v-model="model">
</template>

<script>

    /**
        TODO: adapt component to use v-model instead of sync properties
        - Bind the value attribute to a value prop
        - On input, emit its own custom input event with the new value e.g. $emit('input', $event.target.value)
     */

    module.exports = {

        props: {
            value: {
                type: String,
                required: true
            },
            key: {
                type: String,
                required: true
            }
        },

        data: () => ({
            model: false
        }),

        created () {
            const regex = new RegExp('(?<='+this.key+':).*?(?=;)');
            if (this.value.match(regex)) {
                this.model = (match == 'true' ? true : false);
            }
            this.$watch('model', function (value, old) {
                if (!this.value.match(regex)) {
                    this.value += (this.key+':'+(value ? 'true' : 'false')+';')
                }
                else { // update
                    this.value = this.value.replace(regex, (value ? 'true' : 'false'));
                }
            });
        }
    }

</script>