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
            <div class="icon-object border-success text-success"><i class="icon-plus3"></i></div>
            <h5 class="content-group-lg">Créer compte</h5>
        </div>
        <form action="{{ route('users.store') }}" method="post">
            @csrf
            <div class="row" id="exist" style="margin: 20px 0;display:none;">
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
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group has-feedback">
                        <input type="text" name="name" value="{{ old('name') }}" class="form-control" placeholder="Choisissez Nom d'utilisateur">
                        <div class="form-control-feedback">
                            <i class="icon-user-plus text-muted"></i>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="form-group has-feedback">
                        <input type="password" name="password" value="{{ old('password') }}"  class="form-control" placeholder="Créer un mot de passe">
                        <div class="form-control-feedback">
                            <i class="icon-user-lock text-muted"></i>
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group has-feedback">
                        <input type="password" value="{{ old('password') }}"  name="password_confirmation" class="form-control" placeholder="Répéter le mot de passe">
                        <div class="form-control-feedback">
                            <i class="icon-user-lock text-muted"></i>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="form-group has-feedback">
                        <input type="email" name="email" value="{{ old('email') }}"  class="form-control" placeholder="Votre email">
                        <div class="form-control-feedback">
                            <i class="icon-mention text-muted"></i>
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group has-feedback">
                        <input type="text" name="phone" value="{{ old('phone') }}"  class="form-control" placeholder="téléphone">
                        <div class="form-control-feedback">
                            <i class="icon-phone text-muted"></i>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <select name="role" id="level_id" class="form-control" required>
                        <option style="padding: 20px 0" value="admin">Directeur</option>
                        <option style="padding: 20px 0" value="teacher">MAÎTRE</option>
                        <option style="padding: 20px 0" value="student">Élève</option>
                    </select>
                </div>
            </div>
            <div class="text-right">
                <button type="submit" class="btn bg-teal-400 btn-labeled btn-labeled-right ml-10"><b><i class="icon-plus3"></i></b> Créer le compte</button>
            </div>
        </form>
    </div>
</div>
<script>
    let level_id =  document.querySelector("#level_id")
    let exist =  document.querySelector("#exist")
    level_id.addEventListener('change',()=>{
        console.log(level_id.value);
        if(level_id.value == 'student'){
            exist.style.display = 'block'
        }
    })
</script>
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