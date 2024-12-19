@props(['value', 'field', 'link', 'options'])

<div class="hover-container w-full flex flex-row gap-2"  x-data="editableSelect('{{ $value }}', '{{ $field }}', '{{ $link }}', {{ $options }}, $dispatch)">

    <div class="inline-block gap-2 flex-1 flex">
        <select x-model="value" @change="save()" class="p-1 pr-8 flex-1 text-sm border-none border-bottom border-gray-400 focus:border-gray-400 focus:ring-0">
            <option value="">Please select</option>
                <template x-for="{label, key} in options">
                    <option :value="key" x-text="label" x-bind:selected="key == value" ></option>
                </template>
        </select>
    </div>

    <button x-show="isDirty" class="flex-0">
        <i class="fa-solid fa-worm text-red-400"></i>
    </button>
    <button x-show="inProgress" class="flex-0">
        <i class="fa-solid fa-spinner text-grey-500"></i>
    </button>
</div>

<script>


    function editableSelect(initialValue, field, link, options, dispatch) {

        return {
            isEditing: false,
            isDirty: false,
            inProgress: false,
            value: initialValue,
            originalValue: initialValue,
            options: options,
            edit() {
                this.isEditing = true;
                this.originalValue = this.value;
            },
            save() {
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
