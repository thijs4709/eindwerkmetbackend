<x-header></x-header>

<main>
    <section class="container-fluid">
        <div class="d-flex flex-column text-center vh-100 justify-content-center">
            <header>
                <h1>{{$customer}} we have received your order</h1>
            </header>
            <p>Go back to the home page throug this <a class="text-green" href="{{route("home_frontend")}}">link</a></p>
        </div>
    </section>
</main>

<x-footer></x-footer>
