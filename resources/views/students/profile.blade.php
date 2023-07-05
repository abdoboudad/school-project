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
<div class="panel panel-flat">
    <div class="panel-heading">
        <h2 class="panel-title" style="margin-bottom: 15px">Profil de l'utilisateur</h2>
    <div class="panel-body" style="border-top: 1px solid rgb(189, 189, 189)">
        <div class="tabbable">
            <ul class="nav nav-tabs nav-justified">
                <li class="active"><a href="#basic-justified-tab1" data-toggle="tab" aria-expanded="true">Information</a></li>
                <li class=""><a href="#basic-justified-tab2" data-toggle="tab" aria-expanded="false">Changer le mot de passe</a></li>
            </ul>
            <div class="tab-content">
                <div class="tab-pane active" id="basic-justified-tab1">
                    <table class="table  table-bordered">
                        <tbody>
                            <tr class="success">
                                <td>Avatar</td>
                                <td>
                                    <img width="100px" src="{{ asset('icons/avatar.jpg') }}" alt="">
                                </td>
                            </tr>
                            <tr>
                                <td>Nom Complete</td>
                                <td>{{ $student->name }}</td>
                            </tr>
                            <tr class="danger">
                                <td>Adresse Email</td>
                                <td>{{ $student->email }}</td>
                            </tr>
                            <tr class="secondary">
                                <td>Adresse Email</td>
                                <td>{{ $student->level }}</td>
                            </tr>
                            <tr style="background-color: rgb(230, 230, 230);">
                                <td>Adresse Email</td>
                                <td>{{ $student->sections->name }}</td>
                            </tr>
                            <tr>
                                <td>Date de création</td>
                                <td>{{ $student->created_at }}</td>
                            </tr>
                            <tr class="warning">
                                <td>Date de mise à jour</td>
                                <td>{{ $student->updated_at }}</td>
                            </tr>       
                        </tbody>
                    </table>
                </div>

                <div class="tab-pane" id="basic-justified-tab2">
                    <form action="{{ route('students.pupdate') }}" method="post">
                        @csrf
                        <div class="form-group">
                            <label class="control-label col-lg-12">ancien mot de passe</label>
                            <div class="col-lg-12">
                                <input type="password" name="oldpass" class="form-control" placeholder="ancien mot de passe" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-lg-12">nouveau mot de passe</label>
                            <div class="col-lg-12">
                                <input type="password" name="newpass" class="form-control" placeholder="nouveau mot de passe" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-lg-12">Confirmation mot de passe</label>
                            <div class="col-lg-12">
                                <input type="password" name="confirmepass" class="form-control" placeholder="Confirmation mot de passe" required>
                            </div>
                        </div>
                        <div style="text-align: end;padding:10px">
                            <button type="submit" class="plupload_button plupload_add" id="o_1h3c4nt3686i1tal1qg2f3v109gf_browse" style="position: relative; z-index: 1;">Add Files</button>
                        </div>
                      
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection