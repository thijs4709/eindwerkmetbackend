@extends('layouts.admin')
@section('content')
    <div class="d-flex justify-content-between shadow-lg p-3 mb-5 bg-body-tertiary rounded">
        <div class="d-flex">
            <p class="rounded bg-danger m-0 d-flex align-self-center p-2 text-white">{{$cards->total()}}</p>
            <h1 class="m-0">| Cards</h1>
        </div>
        <a href="{{route('cards.create')}}" class="btn btn-primary m-2 rounded-pill">Add Card</a>
    </div>
 @if (session('alert'))
        <x-alert :type="session('alert')['type']" :message="session('alert')['message']">
            <x-slot name="title">Post</x-slot>
        </x-alert>
    @endif
    <div class="overflow-hidden">
        <div class="table-responsive">
            <table class="table table-striped shadow-lg p-3 mb-5 bg-body-tertiary rounded">
                <thead>
                <tr>
                    <th>Id</th>
                    <th>Name</th>
                    <th>CardType</th>
                    <th>MonsterAttribute</th>
                    <th>level/rank/arrows</th>
                    <th>Photo</th>
                    <th>MonsterType</th>
                    <th>MonsterClass</th>
                    <th>Pendulum</th>
                    <th>MonsterSpecialType</th>
                    <th>Description</th>
                    <th>ATK</th>
                    <th>DEF</th>
                    <th>SpellType</th>
                    <th>TrapType</th>
                    <th>Price</th>
                    <th>Created</th>
                    <th>Updated</th>
                    <th>Deleted</th>
                    <th>Actions</th>
                </tr>
                </thead>
                <tbody>
                @foreach($cards as $card)
                    <tr>
                        <td>{{$card->id}}</td>
                        <td>{{$card->name}}</td>
                        <td>{{$card->cardType->name ?? '/'}}</td>
                        <td>{{$card->monsterAttribute->name ?? '/'}}</td>
                        <td>{{$card->level ?? '/'}}</td>
                        <td><img class="img-thumbnail" width="62" height="62"
                                 src="{{$card->photo->file ? asset($card->photo->file) : 'http://via.placeholder.com/62x62'}}" alt="{{$card->name}}">
                        </td>
                        <td>{{$card->monsterType->name ?? '/'}}</td>
                        <td>{{$card->monsterClass->name ?? '/'}}</td>
                        <td>@if($card->pendulum) pendulum @else / @endif</td>
                        <td>{{$card->monsterSpecialType->name ?? '/'}}</td>
                        <td>{{ Str::limit($card->description,10)}}</td>
                        <td>{{$card->atk ?? '/'}}</td>
                        <td>{{$card->def ?? '/'}}</td>
                        <td> {{ $card->spellType->name ?? '/' }}</td>
                        <td>{{$card->trapType->name ?? '/'}}</td>
                        <td>{{$card->price}}€</td>
                        <td>{{$card->created_at ? $card->created_at->diffForHumans() : ''}}</td>
                        <td>{{$card->updated_at ? $card->updated_at->diffForHumans() : ''}}</td>
                        <td>{{$card->deleted_at ? $card->deleted_at->diffForHumans() : ''}}</td>
                        <td>
                            <div class="nav-item dropdown no-arrow">
                                <a class="nav-link dropdown-toggle" href="#" id="userDropdown{{ $card->id }}" role="button"
                                   data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-three-dots-vertical" viewBox="0 0 16 16">
                                        <path d="M9.5 13a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0zm0-5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0zm0-5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0z" />
                                    </svg>
                                </a>
                                <!-- Dropdown - User Information -->
                                <div class="dropdown-menu  shadow "
                                     aria-labelledby="userDropdown{{ $card->id }}">
                                    @if($card->deleted_at == null)
                                        <a class="dropdown-item" href="{{route('cards.show', $card->slug)}}">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-eye" viewBox="0 0 16 16">
                                                <path
                                                    d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8zM1.173 8a13.133 13.133 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5c2.12 0 3.879 1.168 5.168 2.457A13.133 13.133 0 0 1 14.828 8c-.058.087-.122.183-.195.288-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5c-2.12 0-3.879-1.168-5.168-2.457A13.134 13.134 0 0 1 1.172 8z" />
                                                <path d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5zM4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0z" />
                                            </svg>
                                            Show
                                        </a>
                                        <a class="dropdown-item" href="{{route('cards.edit', $card->slug)}}">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil" viewBox="0 0 16 16">
                                                <path
                                                    d="M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168l10-10zM11.207 2.5 13.5 4.793 14.793 3.5 12.5 1.207 11.207 2.5zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293l6.5-6.5zm-9.761 5.175-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325z" />
                                            </svg>
                                            Edit
                                        </a>
                                    @endif
                                    @if($card->deleted_at != null)
                                        <form action="{{ route('admin.cardrestore', $card->id) }}" method="POST">
                                            @csrf
                                            @method('POST')
                                            <button type="submit" class="dropdown-item">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-bootstrap-reboot" viewBox="0 0 16 16">
                                                    <path d="M1.161 8a6.84 6.84 0 1 0 6.842-6.84.58.58 0 1 1 0-1.16 8 8 0 1 1-6.556 3.412l-.663-.577a.58.58 0 0 1 .227-.997l2.52-.69a.58.58 0 0 1 .728.633l-.332 2.592a.58.58 0 0 1-.956.364l-.643-.56A6.812 6.812 0 0 0 1.16 8z" />
                                                    <path d="M6.641 11.671V8.843h1.57l1.498 2.828h1.314L9.377 8.665c.897-.3 1.427-1.106 1.427-2.1 0-1.37-.943-2.246-2.456-2.246H5.5v7.352h1.141zm0-3.75V5.277h1.57c.881 0 1.416.499 1.416 1.32 0 .84-.504 1.324-1.386 1.324h-1.6z" />
                                                </svg>
                                                Restore
                                            </button>
                                        </form>
                                    @else
                                        <form action="{{ route('cards.destroy', $card->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="dropdown-item">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash2" viewBox="0 0 16 16">
                                                    <path
                                                        d="M14 3a.702.702 0 0 1-.037.225l-1.684 10.104A2 2 0 0 1 10.305 15H5.694a2 2 0 0 1-1.973-1.671L2.037 3.225A.703.703 0 0 1 2 3c0-1.105 2.686-2 6-2s6 .895 6 2zM3.215 4.207l1.493 8.957a1 1 0 0 0 .986.836h4.612a1 1 0 0 0 .986-.836l1.493-8.957C11.69 4.689 9.954 5 8 5c-1.954 0-3.69-.311-4.785-.793z" />
                                                </svg>
                                                Delete
                                            </button>
                                        </form>
                                    @endif

                                </div>
                            </div>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>

    {{ $cards->links() }}


@endsection

