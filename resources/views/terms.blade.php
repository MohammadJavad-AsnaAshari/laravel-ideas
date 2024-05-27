@extends('layouts.layout', ['title' => "Terms"])

@section('content')
    <div class="container py-4">
        <div class="row">
            <div class="col-3">
                @include('shared.left-sidebar')
            </div>
            <div class="col-6">
                <h1>Terms</h1>
                <div>
                    Lorem ipsum dolor sit amet, consectetur adipisicing elit. A, adipisci alias animi consequatur culpa
                    cum
                    debitis dicta earum enim ex impedit incidunt inventore minima necessitatibus neque numquam optio
                    possimus quaerat quisquam similique tempora ullam voluptas voluptates? Accusamus corporis cumque
                    dolorum
                    maiores non provident quibusdam sit ut! Aliquam amet cum, dolore ea excepturi illum, impedit
                    incidunt
                    ipsam iure iusto laboriosam mollitia natus nihil omnis possimus quasi rem reprehenderit veniam
                    voluptas
                    voluptatibus? Dolorum quis, voluptate? Asperiores delectus eveniet labore maiores reiciendis
                    veritatis,
                    voluptatum. A adipisci animi asperiores consectetur corporis, doloremque dolorum earum, et eveniet
                    iste
                    laborum, nihil omnis quae quod similique sunt.
                </div>
            </div>
            <div class="col-3">
                @include('shared.search-bar')
                @include('shared.follow-box')
            </div>
        </div>
    </div>
@endsection
