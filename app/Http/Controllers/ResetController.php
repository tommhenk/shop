<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ResetController extends Controller
{
    public function reset(){
        dd('reset');
        \Artisan::call('migrate:fresh --seed');
        \Storage::deleteDirectory('categories');
        \Storage::makeDirectory('categories');
        $filesCategory = \Storage::disk('reset')->files('categories');

        foreach($filesCategory as $file){
            \Storage::put($file, \Storage::disk('reset')->get($file));
        }


        \Storage::deleteDirectory('products');
        \Storage::makeDirectory('products');
        $filesProduct = \Storage::disk('reset')->files('categories');

        foreach($filesProduct as $file){
            \Storage::put($file, \Storage::disk('reset')->get($file));
        }

        return redirect()->route('home')->with('status', 'Прект сброшен в начальное состояние');
    }
}
