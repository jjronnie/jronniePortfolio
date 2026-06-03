@props([
    'name' => 'avatar',
    'label' => 'Image',
    'preview' => null,
    'maxSize' => 3,
])

<div {{ $attributes->merge(['class' => 'flex flex-col space-y-2']) }}>
    <label class="label">{{ $label }}</label>

    <div
        x-data="{
            imagePreview: '{{ $preview ?? '' }}',
            error: null,

            handleFile(event) {
                this.error = null

                const file = event.target.files[0]
                if (!file) return

                if (!file.type.startsWith('image/')) {
                    this.error = 'Only image files are allowed.'
                    event.target.value = ''
                    this.imagePreview = ''
                    return
                }

                const maxBytes = {{ $maxSize }} * 1024 * 1024
                if (file.size > maxBytes) {
                    this.error = 'Image must not exceed {{ $maxSize }}MB.'
                    event.target.value = ''
                    this.imagePreview = ''
                    return
                }

                this.imagePreview = URL.createObjectURL(file)
                this.$dispatch('image-selected', { file })
            }
        }"
        class="w-32 h-32 border border-dashed rounded-md flex flex-col items-center justify-center cursor-pointer bg-white dark:bg-gray-700 overflow-hidden {{ $preview ? 'border-indigo-400' : 'border-gray-300 dark:border-gray-600' }}"
        @click="$refs.fileInput.click()"
    >
        <template x-if="!imagePreview">
            <div class="flex flex-col items-center justify-center text-gray-500 dark:text-gray-400">
                <span class="text-3xl">+</span>
                <span>Upload</span>
            </div>
        </template>

        <template x-if="imagePreview">
            <img :src="imagePreview" class="w-full h-full object-cover" />
        </template>

        <input
            type="file"
            x-ref="fileInput"
            class="hidden"
            name="{{ $name }}"
            accept="image/*"
            @change="handleFile"
        >
    </div>

    <template x-if="error">
        <p class="text-red-500 text-sm mt-1" x-text="error"></p>
    </template>

    @error($name)
        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
    @enderror
</div>
