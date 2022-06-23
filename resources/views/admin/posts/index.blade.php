@extends('layouts.admin')

@section('content')
<div class="container">

    <div class="d-flex justify-content-between py-4">

        <h1>
            Tutti i Posts
        </h1>

        <div>
            <a href="{{route('admin.posts.create')}}" class="btn btn-primary">
                Aggiungi Post
            </a>
        </div>
        
    </div>

    @if (session('message'))
    <div class="alert alert-success">
        {{ session('message') }}
    </div>
    @endif


    <table class="table table-striped table-inverse table-responsive">

        <thead class="thead-inverse">

            <tr class="text-center">
                <th>ID</th>
                <th>Titolo</th>
                <th>Slug</th>
                <th>Immagine</th>
                <th>Azioni</th>
            </tr>

        </thead>

        <tbody>

            @forelse($posts as $post)
            <tr>
                <td scope="row">
                    {{$post->id}}
                </td>

                <td>
                    {{$post->title}}
                </td>

                <td>
                    {{$post->slug}}
                </td>

                <td>
                    <img width="70" src="{{$post->cover}}" alt="Cover image {{$post->title}}">
                </td>

                <td class="d-flex flex-column justify-content-center align-items-center" >

                    <a class="btn btn-primary text-white btn-sm w-100" href="{{route('admin.posts.show', $post->slug)}}" >
                        Visualizza
                    </a>

                    <a class="btn btn-secondary text-white btn-sm w-100 my-2" href="{{route('admin.posts.edit', $post->slug)}}" >
                        Edita
                    </a>

                    <!-- Button trigger modal -->
                    <button type="button" class="btn btn-danger btn-sm w-100"  data-bs-toggle="modal" data-bs-target="#delete-post-{{$post->id}}">
                        Rimuovi
                    </button>

                    <!-- Modal -->
                    <div class="modal fade" id="delete-post-{{$post->id}}" tabindex="-1" role="dialog" aria-labelledby="modelTitle-{{$post->id}}" aria-hidden="true">

                        <div class="modal-dialog" role="document">

                            <div class="modal-content">

                                <div class="modal-header">

                                    <h5 class="modal-title">
                                        Rimuovi
                                    </h5>

                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>

                                <div class="modal-body">
                                    Sei sicuro di voler rimuovere questo post?
                                </div>

                                <div class="modal-footer">

                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                        Close
                                    </button>


                                    <form action="{{route('admin.posts.destroy', $post->slug)}}" method="post">

                                        @csrf
                                        @method('DELETE')

                                        <button type="submit" class="btn btn-danger">
                                            Conferma
                                        </button>

                                    </form>

                                </div>

                            </div>

                        </div>

                    </div>

                </td>

            </tr>

            @empty
            <tr>
                <td scope="row">
                    Non ci sono post. Crea il tuo primo post! 

                    <a href="#">
                        Crea post
                    </a>

                </td>

            </tr>
            @endforelse

        </tbody>

    </table>

</div>
@endsection