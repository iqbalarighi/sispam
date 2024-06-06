@extends('layouts.side')

@section('content')
<head>
    <meta charset="utf-8">
  
    <!-- CSRF Token -->
  
    <title>{{ config('app.name', 'File Manager') }}</title>
  
    <!-- Styles -->

    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.2/css/all.css">
    <link href="{{ asset('vendor/file-manager/css/file-manager.css') }}" rel="stylesheet">
</head>

@if(Auth::user()->role == "user")
    {{abort(403)}}
@endif

<div class="container">
        <h2>File Manager</h2>
        <div class="row">
            <div class="col-md-12" id="fm-main-block">
                <div id="fm"></div>
            </div>
        </div>
    </div>
  
    <!-- File manager -->
    <script src="{{ asset('vendor/file-manager/js/file-manager.js') }}"></script>
    <script>
      document.addEventListener('DOMContentLoaded', function() {
        document.getElementById('fm-main-block').setAttribute('style', 'height:' + window.innerHeight + 'px');
  
        fm.$store.commit('fm/setFileCallBack', function(fileUrl) {
          window.opener.fmSetLink(fileUrl);
          window.close();
        });
      });
    </script>
                
            </div>
        </div>
    </div>
</div>
@endsection