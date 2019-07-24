@extends('layouts.app1')

@section('content')
<div class="input-group mb-3">
        <div class="input-group-prepend">
          <span class="input-group-text" id="inputGroupFileAddon01">Upload</span>
        </div>
        <div class="custom-file">
          <input type="file" class="custom-file-input" id="inputGroupFile0123" aria-describedby="inputGroupFileAddon01">
          <label class="custom-file-label" for="inputGroupFile0123">Choose file</label>
        </div>
      </div>
      <div class="input-group mb-3">
            <div class="input-group">
                <div class="custom-file">
                    <input type="file" class="custom-file-input" id="inputGroupFilePDF" aria-describedby="inputGroupFilePDF" name="report" required>
                    <label class="custom-file-label" for="inputGroupFilePDF" id="labePDF">Choose pdf</label>
                </div>
            </div>
        </div>

@endsection
