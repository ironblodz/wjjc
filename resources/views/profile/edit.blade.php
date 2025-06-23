@extends('layouts.backoffice')

@section('title', 'Editar Perfil')

@section('content')
<div class="w-full space-y-8">
    <!-- Header -->
    <div class="bg-white rounded-2xl shadow-lg border border-gray-100 p-8">
        <div class="flex items-center">
            <a href="{{ url()->previous() }}"
               class="mr-6 p-3 text-gray-400 hover:text-gray-600 transition-all duration-300 hover:bg-gray-100 rounded-xl">
                <i class="fas fa-arrow-left text-2xl"></i>
            </a>
            <div>
                <h2 class="text-3xl font-bold text-gray-900 mb-2">
                    <i class="fas fa-user-edit mr-3 text-blue-500"></i>
                    Editar Perfil
                </h2>
                <p class="text-lg text-gray-600">Atualize suas informações pessoais e de acesso</p>
            </div>
        </div>
    </div>

    <!-- Profile Information Card -->
    <div class="bg-white rounded-2xl shadow-lg border border-gray-100 overflow-hidden">
        <div class="px-8 py-6 border-b border-gray-100 bg-gradient-to-r from-blue-50 to-purple-50">
            <h3 class="text-2xl font-bold text-gray-900">
                <i class="fas fa-user mr-3 text-blue-500"></i>
                Informações do Perfil
            </h3>
        </div>
        <div class="p-8">
            @include('profile.partials.update-profile-information-form')
        </div>
    </div>

    <!-- Update Password Card -->
    <div class="bg-white rounded-2xl shadow-lg border border-gray-100 overflow-hidden">
        <div class="px-8 py-6 border-b border-gray-100 bg-gradient-to-r from-green-50 to-emerald-50">
            <h3 class="text-2xl font-bold text-gray-900">
                <i class="fas fa-lock mr-3 text-green-500"></i>
                Alterar Senha
            </h3>
        </div>
        <div class="p-8">
            @include('profile.partials.update-password-form')
        </div>
    </div>

    <!-- Delete Account Card -->
    <div class="bg-white rounded-2xl shadow-lg border border-gray-100 overflow-hidden">
        <div class="px-8 py-6 border-b border-gray-100 bg-gradient-to-r from-red-50 to-pink-50">
            <h3 class="text-2xl font-bold text-gray-900">
                <i class="fas fa-exclamation-triangle mr-3 text-red-500"></i>
                Excluir Conta
            </h3>
        </div>
        <div class="p-8">
            @include('profile.partials.delete-user-form')
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Focus on first error field
    const errorField = document.querySelector('.border-red-500');
    if (errorField) {
        errorField.focus();
        errorField.scrollIntoView({ behavior: 'smooth', block: 'center' });
    }

    // Smooth animations
    const formSections = document.querySelectorAll('.bg-white.rounded-2xl');
    formSections.forEach((section, index) => {
        if (section) {
            section.style.opacity = '0';
            section.style.transform = 'translateY(20px)';
            setTimeout(() => {
                section.style.transition = 'all 0.6s ease';
                section.style.opacity = '1';
                section.style.transform = 'translateY(0)';
            }, index * 200);
        }
    });
});
</script>
@endsection
