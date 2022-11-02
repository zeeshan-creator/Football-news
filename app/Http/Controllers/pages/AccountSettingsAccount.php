<?php

namespace App\Http\Controllers\pages;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AccountSettingsAccount extends Controller
{
  public function index()
  {
    return  view('content.pages.pages-account-settings-account');
  }
  public function news()
  {
    return  view('content.news.index');
  }
  public function newsedit()
  {
    return  view('content.news.edit');
  }
  public function profile()
  {
    return  view('content.pages.profile');
  }
  public function promotion()
  {
    return  view('content.promotion.index');
  }
  public function promotionedit()
  {
    return  view('content.promotion.edit');
  }
  public function user()
  {
    return  view('content.user.index');
  }
  public function useredit()
  {
    return  view('content.user.edit');
  }
}
