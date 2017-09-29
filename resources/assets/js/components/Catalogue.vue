<template>
    <button v-on:click="onClick" class='btn btn-primary'><span v-if="inCatalogue" class="glyphicon glyphicon-check"></span> {{ label }}</button>
</template>

<script>

    export default {
        props: {
            url: {
                type: String,
                required: true
            },
            inCatalogue: {
                type: Boolean,
                required: true
            }
        },
        computed: {
            label() {
                if(this.inCatalogue) {
                    return 'In Catalogue';
                }
                return 'Add to Catalogue';
            }
        },
        methods: {
            onClick() {
                if(this.inCatalogue) {
                    this.removeDefault();
                } else {
                    this.makeDefault();
                }
            },
            makeDefault() {
                this.$http.post(this.url).then((response) => {
                    this.inCatalogue = response.body.in_catalogue;
                }, (response) => {
                    console.log('error loading ajax')
                });
            },
            removeDefault() {
                this.$http.delete(this.url).then((response) => {
                    this.inCatalogue = response.body.in_catalogue;
                }, (response) => {
                    console.log('error loading ajax')
                });
            }
        }
    }
</script>