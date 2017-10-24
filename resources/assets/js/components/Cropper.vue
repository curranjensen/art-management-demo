<template>
    <div>
        <img class="img-responsive img-thumbnail" id="image" :src="src">
    </div>
</template>

<script>
    export default {
        props: {
            src: {
                type: String,
                required: true
            }
        },
        mounted: function () {
            var image = document.getElementById('image');
            var cropper = new Cropper(image, {
                crop: function(e) {
                    document.getElementById('width').value = parseInt(e.detail.width);
                    document.getElementById('height').value = parseInt(e.detail.height);
                    document.getElementById('x').value = parseInt(e.detail.x);
                    document.getElementById('y').value = parseInt(e.detail.y);
                },
                movable: false,
                zoomable: false,
                scalable: false
            });
        }
    }
</script>