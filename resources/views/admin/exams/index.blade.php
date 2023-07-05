@extends('admin.layouts.layout')
@section('content')
@if (session('success'))
<div class="alert alert-danger alert-styled-left alert-arrow-left alert-bordered">
    <button type="button" class="close" data-dismiss="alert"><span>×</span><span class="sr-only">Close</span></button>
    <span class="text-semibold">{{ session('success')  }}</span> 
</div>
@endif
<div class="row">
    @forelse ($courses as $course)
    @if ($course->type == 'exam')
        <div class="col-lg-3 col-md-6">
            <div class="thumbnail no-padding">
                <div class="thumb">
                    <img src=" {{ asset('files/' . $course->thumbnail) }} " alt="">
                    <div class="caption-overflow">
                        <span>
                            <a href="assets/images/placeholder.jpg" class="btn bg-success-400 btn-icon btn-xs" data-popup="lightbox"><i class="icon-plus2"></i></a>
                            <a href="user_pages_profile.html" class="btn bg-success-400 btn-icon btn-xs"><i class="icon-link"></i></a>
                        </span>
                    </div>
                </div>
            
                <div class="caption text-center">
                    <h6 class="text-semibold no-margin">{{ $course->title }} <small class="display-block">{{ $course->subjects->name }}</small></h6>
                    <ul class="icons-list mt-15">
                        <li class="text-primary-600"><a href={{ route('courses.edit',$course->id) }}><i class="icon-pencil7"></i></a></li>
                            <li class="text-danger-600">
                                <form action={{ route('courses.destroy',$course->id) }} method="post">
                                    @csrf
                                    @method('delete')
                                    <button type="submit" style="border: 0;background-color:transparent;"><i class="icon-trash"></i></button>
                                </form>
                            </li>
                    </ul>
                </div>
            </div>
        </div>
    @else
    
    @endif
 
    @empty
        
    @endforelse
   

    
</div>

@endsection