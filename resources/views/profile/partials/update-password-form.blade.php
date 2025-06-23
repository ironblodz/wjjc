<section>
    <form method="post" action="{{ route('password.update') }}" class="space-y-8">
        @csrf
        @method('put')

        <div class="space-y-8">
            <!-- Current Password Field -->
            <div class="bg-gradient-to-r from-orange-50 to-yellow-50 rounded-2xl p-6 border border-orange-100">
                <label for="update_password_current_password" class="block text-lg font-semibold text-gray-900 mb-4">
                    <i class="fas fa-key mr-3 text-orange-500"></i>
                    Senha Atual
                </label>
                <input type="password"
                       id="update_password_current_password"
                       name="current_password"
                       class="w-full px-6 py-4 text-lg border-2 @if($errors->updatePassword->has('current_password')) border-red-500 @else border-gray-300 @endif rounded-xl focus:ring-4 focus:ring-orange-500 focus:border-orange-500 transition-all duration-300 shadow-sm"
                       autocomplete="current-password">
                @if($errors->updatePassword->has('current_password'))
                    <p class="mt-3 text-sm text-red-600 flex items-center">
                        <i class="fas fa-exclamation-circle mr-2"></i>
                        {{ $errors->updatePassword->first('current_password') }}
                    </p>
                @endif
            </div>

            <!-- New Password Field -->
            <div class="bg-gradient-to-r from-green-50 to-emerald-50 rounded-2xl p-6 border border-green-100">
                <label for="update_password_password" class="block text-lg font-semibold text-gray-900 mb-4">
                    <i class="fas fa-lock mr-3 text-green-500"></i>
                    Nova Senha
                </label>
                <input type="password"
                       id="update_password_password"
                       name="password"
                       class="w-full px-6 py-4 text-lg border-2 @if($errors->updatePassword->has('password')) border-red-500 @else border-gray-300 @endif rounded-xl focus:ring-4 focus:ring-green-500 focus:border-green-500 transition-all duration-300 shadow-sm"
                       autocomplete="new-password">
                @if($errors->updatePassword->has('password'))
                    <p class="mt-3 text-sm text-red-600 flex items-center">
                        <i class="fas fa-exclamation-circle mr-2"></i>
                        {{ $errors->updatePassword->first('password') }}
                    </p>
                @endif
                <p class="mt-3 text-sm text-gray-600 flex items-center">
                    <i class="fas fa-info-circle mr-2 text-blue-500"></i>
                    Use uma senha forte com pelo menos 8 caracteres, incluindo letras, números e símbolos.
                </p>
            </div>

            <!-- Confirm Password Field -->
            <div class="bg-gradient-to-r from-blue-50 to-purple-50 rounded-2xl p-6 border border-blue-100">
                <label for="update_password_password_confirmation" class="block text-lg font-semibold text-gray-900 mb-4">
                    <i class="fas fa-check-circle mr-3 text-blue-500"></i>
                    Confirmar Nova Senha
                </label>
                <input type="password"
                       id="update_password_password_confirmation"
                       name="password_confirmation"
                       class="w-full px-6 py-4 text-lg border-2 @if($errors->updatePassword->has('password_confirmation')) border-red-500 @else border-gray-300 @endif rounded-xl focus:ring-4 focus:ring-blue-500 focus:border-blue-500 transition-all duration-300 shadow-sm"
                       autocomplete="new-password">
                @if($errors->updatePassword->has('password_confirmation'))
                    <p class="mt-3 text-sm text-red-600 flex items-center">
                        <i class="fas fa-exclamation-circle mr-2"></i>
                        {{ $errors->updatePassword->first('password_confirmation') }}
                    </p>
                @endif
            </div>

            <!-- Actions -->
            <div class="flex flex-col sm:flex-row items-center justify-end space-y-4 sm:space-y-0 sm:space-x-6 pt-8 border-t border-gray-200">
                @if (session('status') === 'password-updated')
                    <div class="flex items-center text-green-600">
                        <i class="fas fa-check-circle mr-2"></i>
                        <span class="text-sm font-medium">Senha atualizada com sucesso!</span>
                    </div>
                @endif
                <button type="submit"
                        class="w-full sm:w-auto btn-primary px-8 py-4 text-white rounded-xl hover:shadow-xl transition-all duration-300 transform hover:scale-105 flex items-center justify-center font-semibold">
                    <i class="fas fa-save mr-3 text-lg"></i>
                    Atualizar Senha
                </button>
            </div>
        </div>
    </form>
</section>
