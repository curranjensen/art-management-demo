<template>
    <div>
        <a :href="link"><img :src="image"></a>
        <p><strong>{{ caption }}</strong></p>
    </div>
</template>

<script>
    export default {
        props: {
            url: {
                type: String,
                required: true
            }
        },
        data() {
            return {
                link: '',
                image: '',
                caption: ''
            }
        },
        methods: {
            startTimer() {
                setInterval(this.loadFile, 5000);
            },
            loadFile() {
                this.$http.get(this.url).then((response) => {
                    var detail = response.body;
                    this.link = 'http://anne.dev/pieces/' + detail.piece.number;
                    this.image = detail.large;
                    this.caption = detail.piece.name;
                }, (response) => {
                    console.log('error loading ajax')
                });
            },
        },
        mounted() {
            this.loadFile();
            this.startTimer();
        }
    }
</script>