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
        </tr>
    </thead>
    <tbody>
        @forelse ($exams  as $exam)
            @if ($exam->status == 'active')
                @if ($exam->type == 'exam')
                    <tr>
                        <td>{{ $exam->id }}</td>
                        <td><a href="{{ route('learn.exams',$exam->id) }}">{{ $exam->title }}</a></td>
                    </tr>
                @else

                @endif
                
            @else
                
            @endif
        @empty
            <tr><h4>vide</h4></tr>
        @endforelse

    </tbody>

</table>

@endsection