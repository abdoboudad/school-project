@extends('admin.layouts.layout')
@section('content')
<style>
    @media only screen and (max-width: 600px) {
        .panel-body img{
            width: 100%;
        }
    }
</style>
<link href="https://vjs.zencdn.net/8.3.0/video-js.css" rel="stylesheet" />
{{ $course }}
<div class="panel panel-flat">
    <div class="panel-heading">
        <h5 class="panel-title">{{ $course->title }}</h5>
        <div class="heading-elements">
            <ul class="icons-list">
                <li>{{ $course->subjects->name }}</li>
                <li><a data-action="reload"></a></li>
                <li>{{ $course->subjects->levels->name }}</li>
            </ul>
        </div>
    <a class="heading-elements-toggle"><i class="icon-menu"></i></a></div>
    <div style="text-align: center;margin:0 10px;">
        <iframe style="width:90%;" height="515" src="https://www.youtube.com/embed/ndTi9x40Si8" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>
    </div>
    <video
    id="my-video"
    class="video-js"
    controls
    preload="auto"
    width="640"
    height="264"
    poster="MY_VIDEO_POSTER.jpg"
    data-setup="{}"
  >
    <source src="https://www.w3schools.com/html/mov_bbb.mp4" type="video/mp4" />
    <source src="https://www.w3schools.com/html/mov_bbb.mp4" type="video/webm" />
    <p class="vjs-no-js">
      To view this video please enable JavaScript, and consider upgrading to a
      web browser that
      <a href="https://videojs.com/html5-video-support/" target="_blank"
        >supports HTML5 video</a
      >
    </p>
  </video>
    <div id="change" style="display: none;">{{ $course->text }}</div>
    <div class="panel-body">
    </div>

    <div class="table-responsive">
        <table class="table">
            <thead>
                <tr>
                    <th>First Name</th>
                    <th>Last Name</th>
                </tr>
            </thead>
            <tbody>
                @forelse(explode('docs/',$course->file) as $file)
                    <tr>
                        <td>{{ $file }}</td>
                        <td><a href="{{ asset('files/docs').'/'.$file }}">first</a></td>
                    </tr>
                @empty

                @endforelse
    
            </tbody>
        </table>
    </div>
</div>
<script src="https://vjs.zencdn.net/8.3.0/video.min.js"></script>

<script>
    document.querySelector(".panel-body").innerHTML = document.querySelector("#change").textContent
    document.querySelector("#change") = ''
</script>
@endsection