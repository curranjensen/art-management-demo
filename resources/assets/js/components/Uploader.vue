<template>
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">Upload Detail Files</h3>
        </div>
        <div class="panel-body">
            <dropzone useFontAwesome="1"
                      id="myVueDropzone"
                      :url="url"
                      v-on:vdropzone-fileAdded="handleFileAdded"
                      v-on:vdropzone-removedFile="handleRemovedFile"
                      v-on:vdropzone-success="handleSuccess"
                      v-on:vdropzone-sending="handleSending"
                      v-on:vdropzone-error="handleError"></dropzone>
            <br>
            <table class="table table-striped table-condensed" v-if="items.length > 0">
                <thead>
                <tr>
                    <th>Detail ID</th>
                    <th>Thumbnail</th>
                    <th>File Name</th>
                    <th>Original File</th>
                    <th>Width</th>
                    <th>Height</th>
                    <th>&nbsp;</th>
                </tr>
                </thead>
                <tbody>
                    <tr v-for="item in items">
                        <td>{{ item.id }}</td>
                        <td><a v-bind:href="getShowUrl(item.id)"><img class="img-thumbnail" v-bind:src="item.thumbnail"></a></td>
                        <td>{{ item.file_name }}</td>
                        <td>{{ item.original_file_name }}</td>
                        <td>{{ item.width }}</td>
                        <td>{{ item.height }}</td>
                        <td><a v-bind:href="getDeleteUrl(item.id)" class="btn btn-sm btn-danger"><span class="glyphicon glyphicon-remove"></span> Delete</a></td>
                    </tr>
                </tbody>
            </table>
            <p v-if="items.length > 0">{{ items.length }} Details.</p>
        </div>
    </div>
</template>

<script>
    import Dropzone from './Dropzone.vue';

    export default {
        components: {
            Dropzone
        },
        props: {
            url: {
                type: String,
                required: true
            },
            token: {
                type: String,
                required: true
            }
        },
        data() {
            return { items: []}
        },
        methods: {
            handleFileAdded(file) {
            },
            handleRemovedFile(file) {
            },
            handleSuccess(file, response) {
                this.items.unshift(response);
            },
            handleSending(file, xhr, formData) {
                formData.append('_token', this.token);
            },
            handleError(file, error, xhr) {
            },
            getShowUrl(item) {
                return '/details/' + item;
            },
            getDeleteUrl(item) {
                return '/details/' + item + '/confirm-delete';
            }
        },
        mounted() {
            this.$http.get(this.url).then((response) => {
                this.items = response.body;
            }, (response) => {
                console.log('error loading ajax')
            });
        }
    }
</script>