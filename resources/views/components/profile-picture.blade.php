


<div x-data="imageViewer()" class="flex flex-col justify-center items-center w-44">
    <div class="relative rounded-full border-2 border-white" data-image-input="true">
        <input accept=".png, .jpg, .jpeg" name="avatar" x-ref="photo" type="file" class="hidden" x-on:change="uploadImage()">
        <div class="rounded-full border-2 border-gray-500">
            <template x-if="imageUrl">
                <div class="rounded-full border-2 border-white h-24 w-24 overflow-hidden">
                    <img class="min:h-24 min:w-24 cursor-pointer" :src="imageUrl"  x-on:click.prevent="$refs.photo.click()">
                </div>
            </template>
            <template x-if="!imageUrl">
                <div class="flex items-center justify-center cursor-pointer h-5 left-0 right-0 bottom-0 bg-dark-clarity absolute">
                    <i class="fa-regular fa-plus text-white"></i>
                </div>
            </template>
        </div>
    </div>
    <span class="text-gray-700 font-normal text-xs mt-2 text-center">150x150px JPEG, PNG Image</span>
</div>

<script>

function imageViewer() {
  return {
    imageUrl: "<?php echo auth()->user()->profile_picture_url; ?>",

    isOpen: false,

    toggleOpen() {
        this.isOpen=!this.isOpen
    },

    fileChosen(event) {
      this.fileToDataUrl(event, src => this.imageUrl = src)
    },

    fileToDataUrl(event, callback) {
        if (! event.target.files.length) return
        console.log("here");
        let file = event.target.files[0],
            reader = new FileReader()

        reader.readAsDataURL(file)
        reader.onload = e => callback(e.target.result)


    },

    uploadImage() {
        console.log("uploads")
        let file = event.target.files[0];
        const formData = new FormData();
        formData.append('imageFile', file);

        axios.post('/profile/picture', formData, {
            headers: {
                'Content-Type': 'multipart/form-data'
            }
        }).then(response => {
            console.log(response.data); // Handle successful upload response
        })
        .catch(error => {
            console.error(error); // Handle upload errors
        });
    }
  }
}
</script>
