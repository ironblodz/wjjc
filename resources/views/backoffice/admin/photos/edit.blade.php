@extends('layouts.backoffice')

@section('title', 'Editar Evento')

@section('content')
<div class="w-full max-w-6xl mx-auto space-y-8">
    <!-- Header -->
    <div class="bg-white rounded-2xl shadow-lg border border-gray-100 p-8">
        <div class="flex items-center">
            <a href="{{ route('backoffice.admin.photos.index') }}"
               class="mr-6 p-3 text-gray-400 hover:text-gray-600 transition-all duration-300 hover:bg-gray-100 rounded-xl">
                <i class="fas fa-arrow-left text-2xl"></i>
            </a>
            <div>
                <h2 class="text-3xl font-bold text-gray-900 mb-2">
                    <i class="fas fa-edit mr-3 text-blue-500"></i>
                    Editar Evento
                </h2>
                <p class="text-lg text-gray-600">Atualize as informações do evento "{{ $photo->title }}"</p>
            </div>
        </div>
    </div>

    <!-- Form Card -->
    <div class="bg-white rounded-2xl shadow-lg border border-gray-100 overflow-hidden">
        <div class="px-8 py-6 border-b border-gray-100 bg-gradient-to-r from-gray-50 to-gray-100">
            <h3 class="text-2xl font-bold text-gray-900">
                <i class="fas fa-cog mr-3 text-blue-500"></i>
                Informações do Evento
            </h3>
        </div>

        <form action="{{ route('backoffice.admin.photos.update', $photo) }}" method="POST" enctype="multipart/form-data" class="p-8" id="photo-form">
            @csrf
            @method('PUT')

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                <!-- Left Column -->
                <div class="space-y-8">
                    <!-- Category Field -->
                    <div class="bg-gradient-to-r from-purple-50 to-pink-50 rounded-2xl p-6 border border-purple-100">
                        <label for="category_id" class="block text-lg font-semibold text-gray-900 mb-4">
                            <i class="fas fa-tags mr-3 text-purple-500"></i>
                            Categoria
                        </label>
                        <select class="w-full px-6 py-4 text-lg border-2 @error('category_id') border-red-500 @else border-gray-300 @enderror rounded-xl focus:ring-4 focus:ring-purple-500 focus:border-purple-500 transition-all duration-300 shadow-sm"
                                id="category_id" name="category_id" required aria-invalid="@error('category_id')true@enderror" aria-describedby="category-error">
                            <option value="">Selecione uma categoria</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}" {{ old('category_id', $photo->category_id) == $category->id ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('category_id')
                            <p class="mt-3 text-sm text-red-600 flex items-center" id="category-error">
                                <i class="fas fa-exclamation-circle mr-2"></i>
                                {{ $message }}
                            </p>
                        @enderror
                    </div>

                    <!-- Title Field -->
                    <div class="bg-gradient-to-r from-blue-50 to-indigo-50 rounded-2xl p-6 border border-blue-100">
                        <label for="title" class="block text-lg font-semibold text-gray-900 mb-4">
                            <i class="fas fa-heading mr-3 text-blue-500"></i>
                            Título do Evento
                        </label>
                        <input type="text"
                               class="w-full px-6 py-4 text-lg border-2 @error('title') border-red-500 @else border-gray-300 @enderror rounded-xl focus:ring-4 focus:ring-blue-500 focus:border-blue-500 transition-all duration-300 shadow-sm"
                               id="title" name="title" value="{{ old('title', $photo->title) }}"
                               placeholder="Ex: Casamento João e Maria"
                               required aria-invalid="@error('title')true@enderror" aria-describedby="title-error">
                        @error('title')
                            <p class="mt-3 text-sm text-red-600 flex items-center" id="title-error">
                                <i class="fas fa-exclamation-circle mr-2"></i>
                                {{ $message }}
                            </p>
                        @enderror
                    </div>

                    <!-- Event Name Field -->
                    <div class="bg-gradient-to-r from-green-50 to-emerald-50 rounded-2xl p-6 border border-green-100">
                        <label for="event_name" class="block text-lg font-semibold text-gray-900 mb-4">
                            <i class="fas fa-calendar mr-3 text-green-500"></i>
                            Nome do Evento
                        </label>
                        <input type="text"
                               class="w-full px-6 py-4 text-lg border-2 @error('event_name') border-red-500 @else border-gray-300 @enderror rounded-xl focus:ring-4 focus:ring-green-500 focus:border-green-500 transition-all duration-300 shadow-sm"
                               id="event_name" name="event_name" value="{{ old('event_name', $photo->event_name) }}"
                               placeholder="Ex: Casamento"
                               required aria-invalid="@error('event_name')true@enderror" aria-describedby="event-name-error">
                        @error('event_name')
                            <p class="mt-3 text-sm text-red-600 flex items-center" id="event-name-error">
                                <i class="fas fa-exclamation-circle mr-2"></i>
                                {{ $message }}
                            </p>
                        @enderror
                    </div>

                    <!-- Description Field -->
                    <div class="bg-gradient-to-r from-orange-50 to-yellow-50 rounded-2xl p-6 border border-orange-100">
                        <label for="description" class="block text-lg font-semibold text-gray-900 mb-4">
                            <i class="fas fa-align-left mr-3 text-orange-500"></i>
                            Descrição
                        </label>
                        <textarea class="w-full px-6 py-4 text-lg border-2 @error('description') border-red-500 @else border-gray-300 @enderror rounded-xl focus:ring-4 focus:ring-orange-500 focus:border-orange-500 transition-all duration-300 shadow-sm resize-none"
                                  id="description" name="description" rows="4"
                                  placeholder="Descreva o evento..." aria-invalid="@error('description')true@enderror" aria-describedby="description-error">{{ old('description', $photo->description) }}</textarea>
                        @error('description')
                            <p class="mt-3 text-sm text-red-600 flex items-center" id="description-error">
                                <i class="fas fa-exclamation-circle mr-2"></i>
                                {{ $message }}
                            </p>
                        @enderror
                    </div>
                </div>

                <!-- Right Column -->
                <div class="space-y-8">
                    <!-- Cover Image Field -->
                    <div class="bg-gradient-to-r from-red-50 to-pink-50 rounded-2xl p-6 border border-red-100">
                        <label for="image" class="block text-lg font-semibold text-gray-900 mb-4">
                            <i class="fas fa-image mr-3 text-red-500"></i>
                            Imagem de Capa
                        </label>
                        <div class="border-2 border-dashed @error('image') border-red-500 @else border-gray-300 @enderror rounded-xl p-8 text-center hover:border-gray-400 transition-all duration-300 bg-white">
                            <input type="file" class="hidden" id="image" name="image" accept="image/*">
                            <label for="image" class="cursor-pointer">
                                <i class="fas fa-cloud-upload-alt text-5xl text-gray-400 mb-4"></i>
                                <p class="text-lg text-gray-600 mb-2" id="image-label">Clique para selecionar uma nova imagem de capa</p>
                                <p class="text-sm text-gray-500">PNG, JPG, JPEG, GIF, WEBP até 5MB</p>
                            </label>
                            @if($photo->image_path)
                                <div class="mt-6 image-preview">
                                    <img src="{{ asset('storage/' . $photo->image_path) }}" alt="Capa atual" class="rounded-xl shadow-lg max-w-full h-auto">
                                    <p class="text-sm text-gray-500 mt-2">Capa atual</p>
                                </div>
                            @endif
                        </div>
                        @error('image')
                            <p class="mt-3 text-sm text-red-600 flex items-center">
                                <i class="fas fa-exclamation-circle mr-2"></i>
                                {{ $message }}
                            </p>
                        @enderror
                    </div>

                    <!-- Gallery Images Field -->
                    <div class="bg-gradient-to-r from-indigo-50 to-purple-50 rounded-2xl p-6 border border-indigo-100">
                        <label for="gallery_images" class="block text-lg font-semibold text-gray-900 mb-4">
                            <i class="fas fa-images mr-3 text-indigo-500"></i>
                            Galeria de Fotos
                        </label>
                        <div class="border-2 border-dashed @error('gallery_images.*') border-red-500 @else border-gray-300 @enderror rounded-xl p-8 text-center hover:border-gray-400 transition-all duration-300 bg-white">
                            <input type="file" class="hidden" id="gallery_images" name="gallery_images[]" accept="image/*" multiple>
                            <label for="gallery_images" class="cursor-pointer">
                                <i class="fas fa-images text-5xl text-gray-400 mb-4"></i>
                                <p class="text-lg text-gray-600 mb-2" id="gallery-label">Clique para adicionar novas fotos à galeria</p>
                                <p class="text-sm text-gray-500">Você pode selecionar múltiplas imagens</p>
                            </label>
                        </div>
                        <p class="mt-3 text-sm text-gray-600 flex items-center">
                            <i class="fas fa-info-circle mr-2 text-blue-500"></i>
                            As imagens já existentes estão listadas abaixo. As novas serão adicionadas.
                        </p>
                        @error('gallery_images.*')
                            <p class="mt-3 text-sm text-red-600 flex items-center">
                                <i class="fas fa-exclamation-circle mr-2"></i>
                                {{ $message }}
                            </p>
                        @enderror
                    </div>

                    <!-- Existing Gallery -->
                    <div class="bg-gradient-to-r from-gray-50 to-blue-50 rounded-2xl p-6 border border-gray-200">
                        <h4 class="text-xl font-bold text-gray-900 mb-6">
                            <i class="fas fa-photo-film mr-3 text-gray-500"></i>
                            Galeria Atual
                        </h4>
                        <div class="grid grid-cols-2 md:grid-cols-3 gap-4">
                            @foreach ($photo->images as $image)
                                <div class="relative group image-preview">
                                    <img src="{{ asset('storage/' . $image->image_path) }}" alt="Gallery image" class="h-32 w-full object-cover rounded-xl shadow-md">
                                    <div class="absolute inset-0 bg-black bg-opacity-50 opacity-0 group-hover:opacity-100 flex items-center justify-center transition-all duration-300 rounded-xl">
                                        <button type="button" class="text-white bg-red-500 p-3 rounded-full delete-image hover:bg-red-600 transition-all duration-300 transform hover:scale-110" data-image-id="{{ $image->id }}" onclick="event.stopPropagation(); deleteImage(this); return false;">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>

            <!-- Actions -->
            <div class="flex flex-col sm:flex-row items-center justify-end space-y-4 sm:space-y-0 sm:space-x-6 pt-8 border-t border-gray-200 mt-8">
                <a href="{{ route('backoffice.admin.photos.index') }}"
                   class="w-full sm:w-auto px-8 py-4 bg-gray-100 text-gray-700 rounded-xl hover:bg-gray-200 transition-all duration-300 border border-gray-200 text-center font-semibold">
                    <i class="fas fa-times mr-2"></i>
                    Cancelar
                </a>
                <button type="submit" id="submit-btn"
                        class="w-full sm:w-auto btn-primary px-8 py-4 text-white rounded-xl hover:shadow-xl transition-all duration-300 transform hover:scale-105 flex items-center justify-center font-semibold">
                    <span id="btn-text">
                        <i class="fas fa-save mr-3 text-lg"></i>
                        Atualizar Evento
                    </span>
                    <span id="btn-loading" class="hidden">
                        <i class="fas fa-spinner fa-spin mr-3 text-lg"></i>
                        Salvando...
                    </span>
                </button>
            </div>
        </form>
    </div>
</div>

@push('scripts')
<script>
    // Auto-generate slug from name
    document.getElementById('name').addEventListener('input', function() {
        const name = this.value;
        const slug = name.toLowerCase()
            .replace(/[^a-z0-9\s-]/g, '') // Remove special characters
            .replace(/\s+/g, '-') // Replace spaces with hyphens
            .replace(/-+/g, '-') // Replace multiple hyphens with single hyphen
            .trim('-'); // Remove leading/trailing hyphens
        document.getElementById('slug').value = slug;
    });

    // Foco automático no primeiro erro
    window.addEventListener('DOMContentLoaded', function() {
        const errorField = document.querySelector('.border-red-500');
        if (errorField) {
            errorField.focus();
            errorField.scrollIntoView({ behavior: 'smooth', block: 'center' });
        }
    });

    // Botão com loading ao enviar
    document.getElementById('photo-form').addEventListener('submit', function(e) {
        const btn = document.getElementById('submit-btn');
        btn.disabled = true;
        document.getElementById('btn-text').classList.add('hidden');
        document.getElementById('btn-loading').classList.remove('hidden');
    });

    // Animações suaves
    document.addEventListener('DOMContentLoaded', function() {
        const formSections = document.querySelectorAll('.bg-gradient-to-r');
        formSections.forEach((section, index) => {
            section.style.opacity = '0';
            section.style.transform = 'translateY(20px)';
            setTimeout(() => {
                section.style.transition = 'all 0.6s ease';
                section.style.opacity = '1';
                section.style.transform = 'translateY(0)';
            }, index * 200);
        });
    });

    // Função para deletar imagem
    function deleteImage(button) {
        if (confirm('Tem certeza que deseja excluir esta imagem?')) {
            const imageId = button.getAttribute('data-image-id');
            const form = document.createElement('form');
            form.method = 'POST';
            form.action = '{{ route("backoffice.admin.photos.images.delete", "") }}/' + imageId;

            const csrfToken = document.createElement('input');
            csrfToken.type = 'hidden';
            csrfToken.name = '_token';
            csrfToken.value = '{{ csrf_token() }}';

            const methodField = document.createElement('input');
            methodField.type = 'hidden';
            methodField.name = '_method';
            methodField.value = 'DELETE';

            form.appendChild(csrfToken);
            form.appendChild(methodField);
            document.body.appendChild(form);
            form.submit();
        }
    }
</script>
@endpush
@endsection
