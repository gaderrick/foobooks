<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Config;
use App;
use Debugbar;
use IanLChapman\PigLatinTranslator\Parser;

class PracticeController extends Controller
{
    public function practice1()
    {
        dump('This is the first example.');
    }

    public function practice3()
    {
        echo Config::get('app.supportEmail');
        echo config('app.supportEmail');
        dump(config('database.connections.mysql'));
    }

    public function practice4()
    {
        $data = ['foo' => 'bar'];
        Debugbar::info($data);
        Debugbar::info('Current environment: '.App::environment());
        Debugbar::error('Error!');
        Debugbar::warning('Watch out…');
        Debugbar::addMessage('Another message', 'mylabel');

        return 'Demoing some of the features of Debugbar';
    }

    public function practice5()
    {
        $translator = new Parser();
        $translation = $translator->translate('Hello world!');
        dump($translation);
    }

    /**
     * ANY (GET/POST/PUT/DELETE)
     * /practice/{n?}
     * This method accepts all requests to /practive/ and
     * invokes the appropriate method.
     * http://foobooks.loc/practice/1 => Invokes practice1
     * http://foobooks.loc/practice/999 => 404 not found
     */

    public function index($n = null)
    {
        $methods = [];

        if (is_null($n)) {
            foreach (get_class_methods($this) as $method) {
                if (strstr($method, 'practice')) {
                    $methods[] = $method;
                }
            }
            return view('practice')->with(['methods' => $methods]);
        } else {
            $method='practice'.$n;
            return (method_exists($this,$method))?$this->$method():abort(404);
        }
    }
}
