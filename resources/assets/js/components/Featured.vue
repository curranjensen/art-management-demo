<template>
    <button v-on:click="onClick" class='btn btn-primary'><span v-if="isFeatured" class="glyphicon glyphicon-check"></span> {{ label }}</button>
</template>

<script>

    export default {
        props: {
            url: {
                type: String,
                required: true
            },
            isFeatured: {
                type: Boolean,
                required: true
            }
        },
        computed: {
            label() {
                if(this.isFeatured) {
                    return 'Is Featured';
                }
                return 'Add to Featured';
            }
        },
        methods: {
            onClick() {
                if(this.isFeatured) {
                    this.removeDefault();
                } else {
                    this.makeDefault();
                }
            },
            makeDefault() {
                this.$http.post(this.url).then((response) => {
                    this.isFeatured = response.body.is_featured;
                }, (response) => {
                    console.log('error loading ajax')
                });
            },
            removeDefault() {
                this.$http.delete(this.url).then((response) => {
                    this.isFeatured = response.body.is_featured;
                }, (response) => {
                    console.log('error loading ajax')
                });
            }
        }
    }
</script>