<section>
    <form method="post" action="{{ route('profile.update') }}" class="space-y-8">
        @csrf
        @method('patch')

        <div class="space-y-8">
            <!-- Name Field -->
            <div class="bg-gradient-to-r from-blue-50 to-purple-50 rounded-2xl p-6 border border-blue-100">
                <label for="name" class="block text-lg font-semibold text-gray-900 mb-4">
                    <i class="fas fa-user mr-3 text-blue-500"></i>
                    Nome
                </label>
                <input type="text"
                       id="name"
                       name="name"
                       value="{{ old('name', $user->name) }}"
                       class="w-full px-6 py-4 text-lg border-2 @if($errors->has('name')) border-red-500 @else border-gray-300 @endif rounded-xl focus:ring-4 focus:ring-blue-500 focus:border-blue-500 transition-all duration-300 shadow-sm"
                       required autofocus autocomplete="name">
                @if($errors->has('name'))
                    <p class="mt-3 text-sm text-red-600 flex items-center">
                        <i class="fas fa-exclamation-circle mr-2"></i>
                        {{ $errors->first('name') }}
                    </p>
                @endif
            </div>

            <!-- Email Field -->
            <div class="bg-gradient-to-r from-green-50 to-emerald-50 rounded-2xl p-6 border border-green-100">
                <label for="email" class="block text-lg font-semibold text-gray-900 mb-4">
                    <i class="fas fa-envelope mr-3 text-green-500"></i>
                    Email
                </label>
                <input type="email"
                       id="email"
                       name="email"
                       value="{{ old('email', $user->email) }}"
                       class="w-full px-6 py-4 text-lg border-2 @if($errors->has('email')) border-red-500 @else border-gray-300 @endif rounded-xl focus:ring-4 focus:ring-green-500 focus:border-green-500 transition-all duration-300 shadow-sm"
                       required autocomplete="username">
                @if($errors->has('email'))
                    <p class="mt-3 text-sm text-red-600 flex items-center">
                        <i class="fas fa-exclamation-circle mr-2"></i>
                        {{ $errors->first('email') }}
                    </p>
                @endif

                @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                    <div class="mt-4 p-4 bg-yellow-50 border border-yellow-200 rounded-xl">
                        <p class="text-sm text-yellow-800 mb-2">
                            <i class="fas fa-exclamation-triangle mr-2"></i>
                            Seu endereço de email não foi verificado.
                        </p>
                        <form id="send-verification" method="post" action="{{ route('verification.send') }}" class="inline">
                            @csrf
                            <button type="submit" class="text-sm text-blue-600 hover:text-blue-800 underline font-medium">
                                Clique aqui para reenviar o email de verificação.
                            </button>
                        </form>
                    </div>

                    @if (session('status') === 'verification-link-sent')
                        <div class="mt-4 p-4 bg-green-50 border border-green-200 rounded-xl">
                            <p class="text-sm text-green-800 flex items-center">
                                <i class="fas fa-check-circle mr-2"></i>
                                Um novo link de verificação foi enviado para seu email.
                            </p>
                        </div>
                    @endif
                @endif
            </div>

            <!-- Actions -->
            <div class="flex flex-col sm:flex-row items-center justify-end space-y-4 sm:space-y-0 sm:space-x-6 pt-8 border-t border-gray-200">
                @if (session('status') === 'profile-updated')
                    <div class="flex items-center text-green-600">
                        <i class="fas fa-check-circle mr-2"></i>
                        <span class="text-sm font-medium">Salvo com sucesso!</span>
                    </div>
                @endif
                <button type="submit"
                        class="w-full sm:w-auto btn-primary px-8 py-4 text-white rounded-xl hover:shadow-xl transition-all duration-300 transform hover:scale-105 flex items-center justify-center font-semibold">
                    <i class="fas fa-save mr-3 text-lg"></i>
                    Salvar Alterações
                </button>
            </div>
        </div>
    </form>
</section>
