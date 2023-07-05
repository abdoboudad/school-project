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
            <th>nom du classe</th>
            <th>nombre du cours</th>
            <th>action</th>
        </tr>
    </thead>
    <tbody>
        @forelse ($level->subjects  as $subject)
            <tr>
                <td>{{ $subject->id }}</td>
                <td>{{ $subject->name }}</td>
                <td>{{ $subject->courses->count() }}</td>
                <td>
                    <ul class="icons-list">
                        <li class="text-primary-600"><a href={{ route('subjects.edit',$subject->id) }}><i class="icon-pencil7"></i></a></li>
                        <li class="text-danger-600">
                            <form action={{ route('subjects.destroy',$subject->id) }} method="post">
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
                                <li><a href={{ route('courses.getcourses',$subject->id) }}><i class="icon-book"></i>Cours</a></li>
                                <li><a href={{ route('courses.exams',$subject->id) }}><i class="icon-file-empty2"></i> Examens</a></li>
                            </ul>
                        </li>
                    </ul>
                </td>
            </tr>
        @empty
            <tr><h4>vide</h4></tr>
        @endforelse

    </tbody>

</table>

@endsection