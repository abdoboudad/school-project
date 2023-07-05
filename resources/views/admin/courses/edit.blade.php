@extends('admin.layouts.layout')
@section('content')
<script src="https://cdn.tiny.cloud/1/{YOUR_API_KEY}/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
    <script>
        tinymce.init({
            selector: 'textarea',
            plugins: 'advlist autolink lists link image charmap print preview hr anchor',
            toolbar_mode: 'floating',
            height: 300 // Specify the desired height of the editor
        });
    </script>
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
            <div class="icon-object border-success text-success"><i class=" icon-pencil"></i></div>
            <h5 class="content-group-lg">modifier une cours</h5>
        </div>
        <form action={{ route('courses.update',$course->id) }} method="post" enctype="multipart/form-data">
            @csrf          
            @method('put')
            <div class="form-group">
                <select name="level" id="level_id" class="form-control" required>
                    <option style="padding: 20px 0" selected>Choisir le level</option>
                    @foreach ($levels as $level)
                        <option style="padding: 20px 0" value="{{ $level->id }}">{{ $level->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <select name="subject_id" id="subject_id" class="form-control" required>
                    <option style="padding: 20px 0" selected>Choisir la matiere</option>
                </select>
            </div>
            <div class="form-group">
                <select name="type" id="type" class="form-control" required>
                    @if ($course->type == 'cours')
                        <option style="padding: 20px 0" value="cours">Cours</option>
                        <option style="padding: 20px 0" value="exam">Examen</option>
                    @else
                        <option style="padding: 20px 0" value="cours">Examen</option>
                        <option style="padding: 20px 0" value="exam">Cours</option>
                    @endif
               
                </select>
            </div>
            <div class="form-group">
                <div style="margin: 0 5px;">
                    <label for="enabled" style="margin-right: 5px;">Activé</label>
                    <input id="enabled" name="status" value="active" type="checkbox" {{ $course->status == 'active' ? 'checked' : ''}} >
                </div>
            </div>
            <label for="">le titre</label>
            <div class="form-group has-feedback">
                <input type="text" name="title" value="{{$course->title }}" class="form-control" placeholder="Choisissez titre du cours">
                <div class="form-control-feedback">
                    <i class="icon-stack text-muted"></i>
                </div>
            </div>

            <legend class="text-bold">Video</legend>

            <label for="">Image réduite</label>
            <div class="form-group has-feedback">
                <input type="file" name="thumbnail" value="{{ $course->thumbnail }}" class="form-control file-styled" placeholder="Choisissez titre du cours">
                <div class="form-control-feedback">
                    <i class="icon-stack text-muted"></i>
                </div>
            </div>
            <label for="">Le lien vidéo</label>
            <div class="form-group has-feedback">
                <input type="text" name="link" value="{{ $course->link }}" class="form-control file-styled" placeholder="Choisissez le lien vidéo">
                <div class="form-control-feedback">
                    <i class="icon-stack text-muted"></i>
                </div>
            </div>
            

            {{-- <legend class="text-bold">Image</legend>
            <label for="">Image</label>
            <div class="form-group has-feedback">
                <input type="file" name="photo" value="{{$course->photo }}" class="form-control file-styled" placeholder="Choisissez titre du cours">
                <div class="form-control-feedback">
                    <i class="icon-stack text-muted"></i>
                </div>
            </div> --}}


            <legend class="text-bold">Description</legend>

            <textarea id="summernote" name="text"></textarea>


            <legend class="text-bold">pièce jointe</legend>

            <table class="table" id="fileTable">
                <tr>
                    <th>nom du fichier</th>
                    <th colspan="2">fichier</th>
                </tr>
                <tr class="file-row">
                    <td>nom example</td>
                    <td>
                        <input type="file" name="file[]" class="file-input">
                    </td>
                    <td>
                        <a class="add-button">+</a>
                    </td>
                </tr>
            </table>
            

           
            <div class="text-right">
                <button type="submit" class="btn bg-teal-400 btn-labeled btn-labeled-right ml-10"><b><i class=" icon-pencil"></i></b> modifier le cours</button>
            </div>
    </form>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
      var addButton = document.querySelectorAll('.add-button');
      addButton.forEach(function(button) {
          button.addEventListener('click', function() {
              var fileRow = document.querySelector('.file-row');
              var newRow = fileRow.cloneNode(true); // Clone the first row
              newRow.querySelector('.file-input').value = ''; // Clear the file input value if needed
              var tbody = document.querySelector('#fileTable tbody'); // Get the table body
              tbody.appendChild(newRow); // Append the new row to the table body
          });
      });
  });
  </script>
  <script>
      setTimeout(() => {
          document.querySelector("body > div.tox.tox-silver-sink.tox-tinymce-aux > div > div > button").click()
      }, 4000);
  </script>
 
    <script>
            let level_input = document.querySelector("#level_id");
            let subject_input = document.querySelector("#subject_id");
            level_input.addEventListener('change',()=>{
                fetch(`https://school.takiddine.art/admin/sections/fetchdata/${level_input.value}`).then(res=>res.json()).then(data=>{
                console.log(data)
                subject_input.innerHTML = ''
                data.forEach(content=>{
                    console.log(content['name']);
                    var option = document.createElement("option");
                    option.value = content['id'];  
                    option.textContent = content['name'];
                    subject_input.appendChild(option);
                });
            })
            })
    </script>

@endsection