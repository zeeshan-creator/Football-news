@extends('layouts/contentNavbarLayout')

@section('title', 'Account settings - Account')

@section('page-script')
<script src="{{asset('assets/js/pages-account-settings-account.js')}}"></script>
@endsection

@section('content')
<h4 class="fw-bold py-3 mb-4">
  <span class="text-muted fw-light">News /</span> Edits
</h4>
<div class="row">
  <div class="col-md-12">
  
    <div class="card mb-4">
      <h5 class="card-header">Edit News</h5>
      <!-- Account -->
      <div class="card-body">
        <div class="d-flex align-items-start align-items-sm-center gap-4">
          <img src="{{asset('assets/img/avatars/1.png')}}" alt="user-avatar" class="d-block rounded" height="100" width="100" id="uploadedAvatar" />
          <div class="button-wrapper">
            <label for="upload" class="btn btn-primary me-2 mb-4" tabindex="0">
              <span class="d-none d-sm-block">Upload</span>
              <i class="bx bx-upload d-block d-sm-none"></i>
              <input type="file" id="upload" class="account-file-input" hidden accept="image/png, image/jpeg" />
            </label>
          </div>
        </div>
      </div>
      <hr class="my-0">
      <div class="card-body">
        <form id="formAccountSettings" method="POST" onsubmit="return false">
          <div class="row">
            <div class="mb-3 col-md-6">
              <label for="Title" class="form-label">Title</label>
              <input class="form-control" type="text" id="Title" name="Title" value="Title" autofocus />
            </div>
            <div class="mb-3 col-md-6">
              <label for="Status" class="form-label">Status</label>
              <select id="country" class="select2 form-select">
                <option value="">Select</option>
                <option value="">Completed</option>
                <option value="">Pending</option>
              </select>
            </div>
            
            <div class="mb-3 col-md-12">
              <label for="Description" class="form-label">Description</label>
              <textarea class="form-control" name="" id="" cols="30" rows="3" placeholder="Description"></textarea>
            </div>
          </div>
          <div class="mt-2">
            <button type="submit" class="btn btn-primary me-2">Save changes</button>
            <button type="reset" class="btn btn-outline-secondary">Cancel</button>
          </div>
        </form>
      </div>
      <!-- /Account -->
    </div>
  </div>
</div>
@endsection