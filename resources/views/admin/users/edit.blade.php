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
        <span class="text-semibold">{{ session('success')  }}</span> 
    </div>
@endif

<div class="panel registration-form">
    <div class="panel-body">
        <div class="text-center">
            <div class="icon-object border-success text-success"><i class="icon-pencil"></i></div>
            <h5 class="content-group-lg">Modifier compte de {{ $user->name }}</h5>
        </div>
        <form action="{{ route('users.update',$user->id) }}" method="post">
            @csrf
            @method('PUT')
           
            <div class="form-group has-feedback">
                <input type="text" name="name" value="{{ $user->name }}" class="form-control" placeholder="Choose username">
                <div class="form-control-feedback">
                    <i class="icon-user-plus text-muted"></i>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="form-group has-feedback">
                        <input type="password" name="password"  class="form-control" placeholder="Create password">
                        <div class="form-control-feedback">
                            <i class="icon-user-lock text-muted"></i>
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group has-feedback">
                        <input type="password" name="password_confirmation" class="form-control" placeholder="Repeat password">
                        <div class="form-control-feedback">
                            <i class="icon-user-lock text-muted"></i>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="form-group has-feedback">
                        <input type="email" name="email" value="{{  $user->email }}"  class="form-control" placeholder="Your email">
                        <div class="form-control-feedback">
                            <i class="icon-mention text-muted"></i>
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group has-feedback">
                        <input type="text" name="phone" value="{{  $user->phone }}"  class="form-control" placeholder="phone">
                        <div class="form-control-feedback">
                            <i class="icon-phone text-muted"></i>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <select name="role" id="level_id" class="form-control" required>
                        @if ($user->role == 'admin')
                        <option style="padding: 20px 0" value="admin">Directeur</option>
                        <option style="padding: 20px 0" value="teacher">MAÎTRE</option>
                        <option style="padding: 20px 0" value="student">Élève</option>
                        @endif
                        @if ($user->role == 'teacher')
                        <option style="padding: 20px 0" value="teacher">MAÎTRE</option>
                        <option style="padding: 20px 0" value="admin">Directeur</option>
                        <option style="padding: 20px 0" value="student">Élève</option>
                        @endif
                        @if ($user->role == 'student')
                        <option style="padding: 20px 0" value="student">Élève</option>
                        <option style="padding: 20px 0" value="admin">Directeur</option>
                        <option style="padding: 20px 0" value="teacher">MAÎTRE</option>
                        @endif
                </select>
                </div>
            </div>
            @if ($user->level)
                <div class="row" style="margin: 20px 0;">
                    <div class="col-md-6">
                        <select name="level" id="level" class="form-control">
                            <option value="opt1">Choisissez le nivaux</option>
                            @forelse ($levels as $level)
                                <option value="{{ $level->name }}">{{ $level->name }}</option>
                            @empty
                                <option value="opt2">no nivaux</option>
                            @endforelse
                        </select>
                    </div>
                    <div class="col-md-6">
                        <select name="section_id" id="section" class="form-control">
                            <option value="opt1">Choisissez la classe</option>
                        </select>
                    </div>
                </div>
            @endif
            <div class="text-right">
                <button type="submit" class="btn bg-teal-400 btn-labeled btn-labeled-right ml-10"><b><i class="icon-pencil"></i></b> Modifier le compte</button>
            </div>
    </form>
    </div>
</div>
<script>
    let level_input = document.querySelector("#level")
    let section_input = document.querySelector("#section");
    level_input.addEventListener('change',()=>{
        fetch(`https://school.takiddine.art/admin/sections/fetchdata/${level_input.value}`).then(res=>res.json()).then(data=>{
        console.log(data)
        section_input.innerHTML = ''
        document.querySelector("#level > option:nth-child(1)").style.display = 'none'
        data.forEach(content=>{
            console.log(content['name']);
            var option = document.createElement("option");
            option.value = content['id'];  
            option.textContent = content['name'];
            section_input.appendChild(option);
        });
    })
    })
</script>
@endsection