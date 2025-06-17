<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Event') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <!-- Formulário principal para atualização do evento -->
                    <form action="{{ route('backoffice.admin.photos.update', $photo) }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="mb-4">
                            <img src="{{ asset('storage/' . $photo->image_path) }}" alt="{{ $photo->title }}"
                                class="max-w-md h-auto rounded">
                        </div>

                        <div class="mb-4">
                            <label for="image" class="block text-sm font-medium text-gray-700">Image (leave empty to
                                keep current image)</label>
                            <input type="file"
                                class="mt-1 block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100"
                                id="image" name="image">
                            @error('image')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Removi o segundo formulário que estava aqui -->

                        <div class="mb-4">
                            <label for="category_id" class="block text-sm font-medium text-gray-700">Category</label>
                            <select
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                                id="category_id" name="category_id" required>
                                <option value="">Select a category</option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}"
                                        {{ old('category_id', $photo->category_id) == $category->id ? 'selected' : '' }}>
                                        {{ $category->name }}</option>
                                @endforeach
                            </select>
                            @error('category_id')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="title" class="block text-sm font-medium text-gray-700">Title</label>
                            <input type="text"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                                id="title" name="title" value="{{ old('title', $photo->title) }}" required>
                            @error('title')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="event_name" class="block text-sm font-medium text-gray-700">Event
                                Name</label>
                            <input type="text"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                                id="event_name" name="event_name" value="{{ old('event_name', $photo->event_name) }}"
                                required>
                            @error('event_name')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="description" class="block text-sm font-medium text-gray-700">Description</label>
                            <textarea class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                                id="description" name="description" rows="3">{{ old('description', $photo->description) }}</textarea>
                            @error('description')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Galeria de imagens existentes -->
                        <div class="mb-4">
                            <label class="block text-sm font-medium text-gray-700 mb-2">Current Gallery</label>
                            <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4" id="gallery-container">
                                @foreach ($photo->images as $image)
                                    <div class="relative group">
                                        <img src="{{ asset('storage/' . $image->image_path) }}" alt="Gallery image"
                                            class="h-40 w-full object-cover rounded">
                                        <div
                                            class="absolute inset-0 bg-black bg-opacity-50 opacity-0 group-hover:opacity-100 flex items-center justify-center transition-opacity">
                                            <button type="button" class="text-white bg-red-500 p-2 rounded-full delete-image"
                                                data-image-id="{{ $image->id }}"
                                                onclick="event.stopPropagation(); deleteImage(this); return false;">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5"
                                                    fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2"
                                                        d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                </svg>
                                            </button>
                                        </div>
                                    </div>
                                @endforeach
                                <!-- New images will be previewed here -->
                                <div id="image-previews"></div>
                            </div>
                        </div>

                        <!-- Upload de novas imagens -->
                        <div class="mb-4">
                            <label for="gallery_images" class="block text-sm font-medium text-gray-700">Add New
                                Images to Gallery</label>
                            <input type="file"
                                class="mt-1 block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100"
                                id="gallery_images" name="gallery_images[]" multiple onchange="previewImages(this)">
                            <input type="hidden" id="removed_images" name="removed_images" value="">
                            <p class="mt-1 text-sm text-gray-500">You can select multiple images to add to the
                                gallery</p>
                            @error('gallery_images')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                            @error('gallery_images.*')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="flex items-center space-x-4">
                            <button type="submit"
                                class="px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600">Update
                                Event</button>
                            <a href="{{ route('backoffice.admin.photos.index') }}"
                                class="px-4 py-2 bg-gray-500 text-white rounded hover:bg-gray-600">Cancel</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        function previewImages(input) {
            // Remove any previous previews that have the 'new-preview' class
            const existingPreviews = document.querySelectorAll('.new-preview');
            existingPreviews.forEach(preview => preview.remove());

            const galleryContainer = document.getElementById('gallery-container');

            if (input.files) {
                Array.from(input.files).forEach((file, index) => {
                    const reader = new FileReader();

                    reader.onload = function(e) {
                        const previewDiv = document.createElement('div');
                        previewDiv.className = 'relative group new-preview';
                        previewDiv.dataset.index = index;

                        const img = document.createElement('img');
                        img.src = e.target.result;
                        img.alt = 'New gallery image';
                        img.className = 'h-40 w-full object-cover rounded';

                        const overlayDiv = document.createElement('div');
                        overlayDiv.className =
                            'absolute inset-0 bg-black bg-opacity-50 opacity-0 group-hover:opacity-100 flex items-center justify-center transition-opacity';

                        const newLabel = document.createElement('span');
                        newLabel.className = 'text-white bg-green-500 px-2 py-1 rounded text-xs mr-2';
                        newLabel.textContent = 'New';

                        const deleteButton = document.createElement('button');
                        deleteButton.className = 'text-white bg-red-500 p-2 rounded-full ml-2';
                        deleteButton.type = 'button';
                        deleteButton.onclick = function() {
                            previewDiv.remove();
                            console.log(`Removed preview for image ${index}`);
                        };

                        // Add delete icon
                        const svgIcon = document.createElementNS('http://www.w3.org/2000/svg', 'svg');
                        svgIcon.setAttribute('xmlns', 'http://www.w3.org/2000/svg');
                        svgIcon.setAttribute('class', 'h-5 w-5');
                        svgIcon.setAttribute('fill', 'none');
                        svgIcon.setAttribute('viewBox', '0 0 24 24');
                        svgIcon.setAttribute('stroke', 'currentColor');

                        const path = document.createElementNS('http://www.w3.org/2000/svg', 'path');
                        path.setAttribute('stroke-linecap', 'round');
                        path.setAttribute('stroke-linejoin', 'round');
                        path.setAttribute('stroke-width', '2');
                        path.setAttribute('d',
                            'M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16'
                        );

                        svgIcon.appendChild(path);
                        deleteButton.appendChild(svgIcon);

                        overlayDiv.appendChild(newLabel);
                        overlayDiv.appendChild(deleteButton);
                        previewDiv.appendChild(img);
                        previewDiv.appendChild(overlayDiv);
                        galleryContainer.appendChild(previewDiv);
                    }

                    reader.readAsDataURL(file);
                });
            }
        }

        function deleteImage(button) {
            if (confirm('Are you sure you want to delete this image?')) {
                const imageId = button.dataset.imageId;
                const imageContainer = button.closest('.relative.group');

                fetch(`{{ route('backoffice.admin.photos.images.delete', '') }}/${imageId}`, {
                    method: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                        'Accept': 'application/json'
                    }
                })
                .then(response => {
                    if (response.ok) {
                        // Remove a imagem visualmente
                        imageContainer.remove();
                        // Adiciona o ID da imagem ao campo hidden de imagens removidas
                        const removedImagesInput = document.getElementById('removed_images');
                        const currentRemovedImages = removedImagesInput.value ? removedImagesInput.value.split(',') : [];
                        currentRemovedImages.push(imageId);
                        removedImagesInput.value = currentRemovedImages.join(',');
                    } else {
                        alert('Error deleting image');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('Error deleting image');
                });
            }
        }

        // Adiciona o evento de submit ao formulário principal
        document.querySelector('form').addEventListener('submit', function(e) {
            e.preventDefault();
            this.submit();
        });
    </script>
</x-app-layout>
