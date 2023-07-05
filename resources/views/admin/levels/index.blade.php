@extends('admin.layouts.layout')
@section('content')
@if (session('success'))
<div class="alert alert-danger alert-styled-left alert-arrow-left alert-bordered">
    <button type="button" class="close" data-dismiss="alert"><span>×</span><span class="sr-only">Close</span></button>
    <span class="text-semibold">{{ session('success')  }}</span> 
</div>
@endif
<table class="table table-bordered table-striped table-hover">
    <thead>
        <tr class="bg-teal-400">
            <th>#</th>
            <th>nom du niveaux</th>
            <th>nombre de classes</th>
            <th>nombre de Matériaux</th>
            <th>action</th>
        </tr>
    </thead>
    <tbody>
        @forelse ($levels as $level)
            <tr>
                <td>{{ $level->id }}</td>
                <td>{{ $level->name }}</td>
                <td>{{ $level->sections->count() }}</td>
                <td>{{ $level->subjects->count() }}</td>
                <td>
                    <ul class="icons-list">
                        <li class="text-primary-600"><a href={{ route('levels.edit',$level->id) }}><i class="icon-pencil7"></i></a></li>
                        <li class="text-danger-600">
                            <form action={{ route('levels.destroy',$level->id) }} method="post">
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
                                <li><a href={{ route('sections.sectionsfind',$level->name) }}><i class=" icon-stack"></i> classes</a></li>
                                <li><a href={{ route('subjects.subjectsfind',$level->name) }}><i class="icon-bookmark"></i> Matériaux</a></li>
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