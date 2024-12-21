@props(['value', 'field', 'link', 'label'])

<div class="hover-container w-full flex flex-row gap-2"  x-data="editableInput('{{ $value }}', '{{ $field }}', '{{ $link }}', '{{ $label }}', $dispatch)">

    <div class="inline-block gap-2 flex-1 flex justify-middle">
        <input type="checkbox" x-ref="field" x-effect="$el.checked = value != 0" @input="value = $el.checked ? '1' : '0'" class="w-5 h-5 text-gray-600 bg-gray-100 border-gray-300 rounded focus:ring-gray-500 dark:focus:ring-gray-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600" @change="save()" >
        <label for="default-checkbox" class="ms-2 text-sm text-gray-900 dark:text-gray-300">{{ $label }}</label>
    </div>

    <button x-show="isDirty" class="flex-0">
        <i class="fa-solid fa-worm text-red-400"></i>
    </button>
    <button x-show="inProgress" class="flex-0">
        <i class="fa-solid fa-spinner text-grey-500"></i>
    </button>
</div>

<script>


    function editableInput(initialValue, field, link, initialLabel, dispatch) {

        console.log('editableInput', initialValue, field, dispatch);
        return {
            isEditing: false,
            isDirty: false,
            inProgress: false,
            value: initialValue,
            originalValue: initialValue,
            label: initialLabel,
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
