<section class="space-y-8">
    <div class="bg-gradient-to-r from-red-50 to-pink-50 rounded-2xl p-8 border border-red-200">
        <div class="flex items-start">
            <div class="w-12 h-12 bg-red-500 rounded-full flex items-center justify-center mr-4 mt-1">
                <i class="fas fa-exclamation-triangle text-white text-xl"></i>
            </div>
            <div>
                <h4 class="text-xl font-bold text-gray-900 mb-2">Excluir Conta</h4>
                <p class="text-gray-700 leading-relaxed">
                    Uma vez que sua conta for excluída, todos os seus recursos e dados serão permanentemente removidos.
                    Antes de excluir sua conta, faça o download de quaisquer dados ou informações que você deseja manter.
                </p>
            </div>
        </div>
    </div>

    <div class="bg-gradient-to-r from-yellow-50 to-orange-50 rounded-2xl p-8 border border-yellow-200">
        <h4 class="text-lg font-bold text-gray-900 mb-4">
            <i class="fas fa-shield-alt mr-3 text-yellow-500"></i>
            Importante
        </h4>
        <div class="space-y-3">
            <div class="flex items-start">
                <div class="w-6 h-6 bg-yellow-500 rounded-full flex items-center justify-center mr-3 mt-1">
                    <i class="fas fa-times text-white text-xs"></i>
                </div>
                <p class="text-sm text-gray-700">Esta ação não pode ser desfeita</p>
            </div>
            <div class="flex items-start">
                <div class="w-6 h-6 bg-yellow-500 rounded-full flex items-center justify-center mr-3 mt-1">
                    <i class="fas fa-times text-white text-xs"></i>
                </div>
                <p class="text-sm text-gray-700">Todos os seus dados serão perdidos permanentemente</p>
            </div>
            <div class="flex items-start">
                <div class="w-6 h-6 bg-yellow-500 rounded-full flex items-center justify-center mr-3 mt-1">
                    <i class="fas fa-times text-white text-xs"></i>
                </div>
                <p class="text-sm text-gray-700">Você não poderá acessar sua conta novamente</p>
            </div>
        </div>
    </div>

    <button type="button"
            x-data=""
            x-on:click.prevent="$dispatch('open-modal', 'confirm-user-deletion')"
            class="w-full sm:w-auto px-8 py-4 bg-red-500 text-white rounded-xl hover:bg-red-600 transition-all duration-300 transform hover:scale-105 flex items-center justify-center font-semibold">
        <i class="fas fa-trash mr-3 text-lg"></i>
        Excluir Conta
    </button>

    <x-modal name="confirm-user-deletion" :show="$errors->userDeletion->isNotEmpty()" focusable>
        <form method="post" action="{{ route('profile.destroy') }}" class="p-8">
            @csrf
            @method('delete')

            <div class="text-center mb-8">
                <div class="w-16 h-16 bg-red-500 rounded-full flex items-center justify-center mx-auto mb-4">
                    <i class="fas fa-exclamation-triangle text-white text-2xl"></i>
                </div>
                <h2 class="text-2xl font-bold text-gray-900 mb-4">
                    Tem certeza que deseja excluir sua conta?
                </h2>
                <p class="text-gray-600 leading-relaxed">
                    Uma vez que sua conta for excluída, todos os seus recursos e dados serão permanentemente removidos.
                    Por favor, digite sua senha para confirmar que você deseja excluir permanentemente sua conta.
                </p>
            </div>

            <div class="bg-gradient-to-r from-red-50 to-pink-50 rounded-2xl p-6 border border-red-200 mb-8">
                <label for="password" class="block text-lg font-semibold text-gray-900 mb-4">
                    <i class="fas fa-key mr-3 text-red-500"></i>
                    Digite sua senha para confirmar
                </label>
                <input type="password"
                       id="password"
                       name="password"
                       class="w-full px-6 py-4 text-lg border-2 @if($errors->userDeletion->has('password')) border-red-500 @else border-gray-300 @endif rounded-xl focus:ring-4 focus:ring-red-500 focus:border-red-500 transition-all duration-300 shadow-sm"
                       placeholder="Sua senha atual">
                @if($errors->userDeletion->has('password'))
                    <p class="mt-3 text-sm text-red-600 flex items-center">
                        <i class="fas fa-exclamation-circle mr-2"></i>
                        {{ $errors->userDeletion->first('password') }}
                    </p>
                @endif
            </div>

            <div class="flex flex-col sm:flex-row items-center justify-end space-y-4 sm:space-y-0 sm:space-x-6">
                <button type="button"
                        x-on:click="$dispatch('close')"
                        class="w-full sm:w-auto px-8 py-4 bg-gray-100 text-gray-700 rounded-xl hover:bg-gray-200 transition-all duration-300 border border-gray-200 text-center font-semibold">
                    <i class="fas fa-times mr-2"></i>
                    Cancelar
                </button>
                <button type="submit"
                        class="w-full sm:w-auto px-8 py-4 bg-red-500 text-white rounded-xl hover:bg-red-600 transition-all duration-300 transform hover:scale-105 flex items-center justify-center font-semibold">
                    <i class="fas fa-trash mr-3 text-lg"></i>
                    Excluir Conta Permanentemente
                </button>
            </div>
        </form>
    </x-modal>
</section>
