@extends('admin.layouts.layout')
@section('content')

    @if (session('success'))    
    <div class="alert alert-success alert-styled-left alert-arrow-left alert-bordered">
        <button type="button" class="close" data-dismiss="alert"><span>×</span><span class="sr-only">Close</span></button>
        <span class="text-semibold">{{ session('success')  }}</span> 
        </div>
    @endif
    @if (session('supprimer'))    
    <div class="alert alert-danger alert-styled-left alert-arrow-left alert-bordered">
        <button type="button" class="close" data-dismiss="alert"><span>×</span><span class="sr-only">Close</span></button>
        <span class="text-semibold">{{ session('supprimer')  }}</span> 
        </div>
    @endif
    
        






    <table class="table table-bordered table-striped table-hover">
        <thead>
            <tr class="bg-teal-400">
                <th>#</th>
                <th>nom du utilisateur</th>
                <th>role</th>
                <th>action</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($users as $user)
                <tr>
                    <td>{{ $user->id }}</td>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->role }}</td>
                    <td>
                        <ul class="icons-list">
                            <li class="text-primary-600"><a href={{ route('users.edit',$user->name) }}><i class="icon-pencil7"></i></a></li>
                            <li class="text-danger-600">
                                <form action="{{ route('users.destroy',$user->id) }}" method="post">
                                    @csrf
                                    @method('delete')
                                    <button type="submit" style="border: 0;background-color:transparent;"><i class="icon-trash"></i></button>                                
                                </form> 
                
                            </li>
                            <li class="dropdown text-teal-600">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                    <i class="icon-cog7"></i>
                                    <span class="caret"></span>
                                </a>
                                <ul class="dropdown-menu">
                                    <li><a href={{ route('profile',$user->name) }}><i class="icon-user pull-right"></i> Profil </a></li>
                                        
                                        <form action="{{ route('status', $user->id) }}" method="post">
                                            @csrf

                                            @if ($user->status === 'debloc')
                                                <li><button type="submit" style="border: 0;background-color:transparent;padding:10px 15px;width:100%;text-align:start;"><i class="icon-user-block pull-right" ></i> Bloc </button></li>
                                            @else
                                                <li><button type="submit" style="border: 0;background-color:transparent;padding:10px 15px;width:100%;text-align:start;"><i class="icon-user-check pull-right"></i> débloquer </button></li>
                                            @endif
                                        </form>                                
                                </ul>
                            </li>
                        </ul>
                        
                    </td>
                </tr>
            @empty
                
            @endforelse
    
        </tbody>
    
    </table>


@endsection