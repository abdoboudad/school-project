@extends('admin.layouts.layout')
@section('content')
@if ($errors->any())
        <div class="alert alert-danger alert-styled-left alert-arrow-left alert-bordered">
            <button type="button" class="close" data-dismiss="alert"><span>×</span><span class="sr-only">Close</span></button>
            @foreach ($errors->all() as $error)
                    <p class="text-semibold">{{ $error }} </p> 
            @endforeach
        </div>
    @endif

    @if (session('success'))
        <div class="alert alert-success alert-styled-left alert-arrow-left alert-bordered">
            <button type="button" class="close" data-dismiss="alert"><span>×</span><span class="sr-only">Close</span></button>
            <span class="text-semibold">{{ session('success')}}</span> 
        </div>
    @endif
<div class="panel registration-form">
    
    <div class="panel-body">
        <div class="text-center">
            <div class="icon-object border-success text-success"><i class="icon-pencil"></i></div>
            <h5 class="content-group-lg">Modifier le niveaux</h5>
        </div>
        <form action={{ route('levels.update',$level->id) }} method="post">
            @csrf
            @method('put')          
            <div class="form-group has-feedback">
                <input type="text" name="name" value="{{ $level->name }}" class="form-control" placeholder="Choisissez Nom du niveaux">
                <div class="form-control-feedback">
                    <i class="icon-stack text-muted"></i>
                </div>
            </div>
            <div class="text-right">
                <button type="submit" class="btn bg-teal-400 btn-labeled btn-labeled-right ml-10"><b><i class="icon-pencil"></i></b> modifier le niveaux</button>
            </div>
    </form>
    </div>
</div>

@endsection