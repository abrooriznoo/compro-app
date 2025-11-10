<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LearningController extends Controller
{
    public function index()
    {
        return view('learn');
        // return "Hello, Learning Index Page!";
    }

    public function addition()
    {
        return view('Form.addition');
    }

    // Methods for additional arithmetic operations
    public function additionMethods(Request $request)
    {
        $angka1 = $request->input('number1');
        $angka2 = $request->input('number2');

        $hasil = $angka1 + $angka2;
        return view('Form.addition', ['result' => $hasil]);
    }

    public function subtraction()
    {
        return view('Form.subtraction');
    }

    // Methods for subtraction
    public function subtractionMethods(Request $request)
    {
        $angka1 = $request->input('number1');
        $angka2 = $request->input('number2');

        $hasil = $angka1 - $angka2;
        return view('Form.subtraction', ['result' => $hasil]);
    }

    public function multiplication()
    {
        return view('Form.multiplication');
    }

    // Methods for multiplication
    public function multiplicationMethods(Request $request)
    {
        $angka1 = $request->input('number1');
        $angka2 = $request->input('number2');

        $hasil = $angka1 * $angka2;
        return view('Form.multiplication', ['result' => $hasil]);
    }

    public function division()
    {
        return view('Form.division');
    }

    // Methods for division
    public function divisionMethods(Request $request)
    {
        $angka1 = $request->input('number1');
        $angka2 = $request->input('number2');

        $hasil = $angka1 / $angka2;
        return view('Form.division', ['result' => $hasil]);
    }
}
