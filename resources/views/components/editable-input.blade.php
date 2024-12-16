@props(['value', 'field', 'link'])

<div class="hover-container w-full flex flex-row gap-2"  x-data="editableInput('{{ $value }}', '{{ $field }}', '{{ $link }}', $dispatch)">

    <div class="inline-block gap-2 flex-1 flex">
        <input x-model="value" x-ref="field" x-bind:disabled="!isEditing" class="p-1 flex-1 text-sm border-none border-bottom border-gray-400 focus:border-gray-400 focus:ring-0" @keydown.enter="save()" @keydown.escape="cancel()">
        <button @click="save()" x-show="isEditing" class="flex-0"><i class="fa-solid fa-circle-check text-green-500"></i></button>
        <button @click="cancel()" x-show="isEditing" class="flex-0"><i class="fa-solid fa-circle-xmark text-orange-500"></i></button>
    </div>

    <button x-show="isDirty" class="flex-0">
        <i class="fa-solid fa-worm text-red-400"></i>
    </button>
    <button x-show="inProgress" class="flex-0">
        <i class="fa-solid fa-spinner text-grey-500"></i>
    </button>
    <button @click="edit()" class="flex-0 hover-item"><i class="fa-solid fa-pen-to-square"></i></button>
</div>

<script>


    function editableInput(initialValue, field, link, dispatch) {

        console.log('editableInput', initialValue, field, dispatch);
        return {
            isEditing: false,
            isDirty: false,
            inProgress: false,
            value: initialValue,
            originalValue: initialValue,
            edit() {
                this.isEditing = true;
                this.originalValue = this.value;
                // this.$nextTick(() => {
                //     console.log(this.$refs);
                //     this.$refs.input.focus();
                // });
            },
            save() {
                console.log(this.value);
                this.isEditing = false;
                this.isDirty = this.value !== this.originalValue;
                if (this.isDirty) {
                    console.log(
                        this.value, field, link
                    )

                    this.inProgress = true;

                    axios.post(link, {
                        [field]: this.value
                    }).then(response => {
                        console.log(response.data);
                        dispatch('notify', {
                            message: response.data.message,
                            type: response.data.type
                        });
                        this.inProgress = false;
                        this.isDirty = false;
                        this.originalValue = this.value;
                    }).catch(error => {
                        console.log(error.response.data);
                        dispatch('notify', {
                            message: error.response.data.message,
                            type: error.response.data.type
                        });
                        this.inProgress = false;
                    });
                }
            },
            cancel() {
                this.isEditing = false;
                this.value = this.originalValue;
            },
        };
    }
</script>
