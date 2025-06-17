@extends('master')

@section('title', '404')

@section('content')
    <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
                        Start 404
                    ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
    <section class="four-not-four-section bg_img" data-background="assets/images/samurai.jpg">
        <div class="container">
            <div class="row justify-content-center align-items-center">
                <div class="col-xl-6 col-lg-6 text-center">
                    <div class="four-not-four-content">
                        <h1 class="title">404</h1>
                        <h2 class="sub-title">Página não encontrada</h2>
                        <p>A página que procurou pode ter sido removida, teve o seu nome alterado ou está temporariamente
                            indisponível.
                        </p>
                        <div class="four-not-four-btn">
                            <a href="index.html" class="btn--base">Voltar à página Inicial <i
                                    class="fas fa-arrow-right ml-2"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
                        End 404
                    ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->

@endsection
