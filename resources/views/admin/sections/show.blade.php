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
            <th>action</th>
        </tr>
    </thead>
    <tbody>
        @forelse ($level->sections  as $section)
            <tr>
                <td>{{ $section->id }}</td>
                <td>{{ $section->name }}</td>
                <td>
                    <ul class="icons-list">
                        <li class="text-primary-600"><a href={{ route('sections.edit',$section->id) }}><i class="icon-pencil7"></i></a></li>
                        <li class="text-danger-600">
                            <form action={{ route('subjects.destroy',$section->id) }} method="post">
                                @csrf
                                @method('delete')
                                <button type="submit" onclick="return confirm('هل انت متأكد انك تريد الحذف  ؟');"  style="border: 0;background-color:transparent;"><i class="icon-trash"></i></button>
                            </form>
                        </li>
                        
                    </ul>
                </td>
            </tr>
        @empty
        @endforelse

    </tbody>

</table>

@endsection