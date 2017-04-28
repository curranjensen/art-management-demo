<template>
    <button v-on:click="onClick" class='btn btn-primary'><span v-if="isDefault" class="glyphicon glyphicon-check"></span> {{ label }}</button>
</template>

<script>

    export default {
        props: {
            url: {
                type: String,
                required: true
            },
            isDefault: {
                type: Boolean,
                required: true
            }
        },
        computed: {
            label() {
                if(this.isDefault) {
                    return 'Default Image';
                }
                return 'Set As Default Image';
            }
        },
        methods: {
            onClick() {
                if(this.isDefault) {
                    this.removeDefault();
                } else {
                    this.makeDefault();
                }
            },
            makeDefault() {
                this.$http.post(this.url).then((response) => {
                    this.isDefault = response.body.is_default;
                }, (response) => {
                    console.log('error loading ajax')
                });
            },
            removeDefault() {
                this.$http.delete(this.url).then((response) => {
                    this.isDefault = response.body.is_default;
                }, (response) => {
                    console.log('error loading ajax')
                });
            }
        }
    }
</script>