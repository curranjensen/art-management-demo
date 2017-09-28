<template>
    <div>
        <multiselect :hide-selected="true" tag-placeholder="Add this as new tag" @tag="addTag" :taggable="true" v-model="value" id="ajax" placeholder="Type to search" open-direction="bottom" :options="options" :multiple="true" :searchable="true" :loading="isLoading" :internal-search="true" :clear-on-select="false" :close-on-select="true" :options-limit="300" :limit="3" :limit-text="limitText" :max-height="600" :show-no-results="false" @search-change="asyncFind">
            <template slot="clear" scope="props">
                <div class="multiselect__clear" v-if="value.length" @mousedown.prevent.stop="clearAll(props.search)"></div>
            </template><span slot="noResult">Oops! No elements found. Consider changing the search query.</span>
        </multiselect>
        <br>
        <button class="btn btn-primary" @click="saveTags">
            <span class="glyphicon glyphicon-floppy-disk" aria-hidden="true"></span> Save
        </button>
    </div>
</template>

<script>
    import Multiselect from 'vue-multiselect'

    export default {
        components: { Multiselect },
        props: {
            tags: {
                type: Array,
                required: false,
                default: function() {
                    return [];
                }
            },
            url: {
                type: String,
                required: true
            }
        },
        data () {
            return {
                value: this.tags ? this.tags : [],
                options: [],
                isLoading: false
            }
        },
        methods: {
            limitText (count) {
                return `and ${count} other countries`
            },
            saveTags() {
                this.$http.patch(this.url, {'tags' : this.value}).then(function (response) {
                    console.log('Success!:', response.message);
                    window.alert('The tags are saved!');
                }, function (response) {
                    console.log('Error!:', response.data);
                });
            },
            addTag (newTag) {
                this.options.push(newTag);
                this.value.push(newTag);
            },
            asyncFind (query) {
                this.isLoading = true;
                this.$http.get('/api/tags', { q:query }).then(response => {
                    this.options = response.data;
                    this.isLoading = false;
                });
            },
            clearAll () {
                this.value = [];
            }
        }
    }
</script>

<style src="vue-multiselect/dist/vue-multiselect.min.css"></style>