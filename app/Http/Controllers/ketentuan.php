<?php

namespace App\Http\Controllers;

class ketentuan extends Controller
{
  public function loadModal()
  {
    //return view for specified action
    //if action is delete, call this view, etc...
    // return View::make('layananspln/ketentuan')->render();

    $view=\View::make('layananspln/ketentuan');
    return ['html'=>$view->render()];
  }
}