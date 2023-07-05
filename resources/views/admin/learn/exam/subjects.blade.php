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
            <th>id</th>
            <th>nom du classe</th>
            <th>nombre du exams</th>
        </tr>
    </thead>
    <tbody>
        @forelse ($level->subjects as $subject)
            <tr>
                <td>{{ $subject->id }}</td>
                <td><a href="{{ route('learn.exams',$subject->id) }}">{{ $subject->name }}</a></td>
                <?php $array = []  ?>
                @forelse ($subject->courses as $course)
                    @if ($course->type == 'exam' && $course->status == 'active')
                        <?php $array[] = $course ?>
                    @endif
                @empty
                @endforelse
                <td>{{ count($array) }}</td>
            </tr>
        @empty
            <tr><h4>vide</h4></tr>
        @endforelse

    </tbody>

</table>

@endsection