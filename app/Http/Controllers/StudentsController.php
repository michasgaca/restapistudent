<?php

namespace App\Http\Controllers;

use App\Models\Students;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class StudentsController extends Controller
{
    public function index()
    {
        $students = Students::all();

        if ($students->count() > 0) {

            return response()->json(
                [
                    'status' => 200,
                    'students' => $students
                ],
                200
            );
        } else {

            return response()->json(
                [
                    'status' => 404,
                    'students' => 'lack of students'
                ],
                404
            );
        }
    }

    public function destroy($id)
    {
        $student = Students::find($id);

        if ($student) {

            $student->delete();

            return response()->json([
                'status' => 200,
                'message' => 'Successfully deleted'

            ], 200);

        } else {
            return response()->json(
                [
                    'status' => 404,
                    'students' => 'lack of students'
                ],
                404
            );
        }
    }

    public function show($id)
    {
        $student = Students::find($id);

        if ($student) {

            return response()->json([
                'status' => 200,
                'student' => $student

            ], 200);

        } else {
            return response()->json(
                [
                    'status' => 404,
                    'students' => 'lack of students'
                ],
                404
            );
        }
    }

    public function edit($id)
    {
        $student = Students::find($id);

        if ($student) {

            return response()->json([
                'status' => 200,
                'student' => $student

            ], 200);

        } else {
            return response()->json(
                [
                    'status' => 404,
                    'students' => 'lack of students'
                ],
                404
            );
        }
    }

    public function store(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:100',
            'phoneNumber' => 'required|integer|min:6',
            'age' => 'required|integer|min:3',
        ]);

        if ($validator->fails()) {

            return response()->json(
                [
                    'status' => 422,
                    'error' => $validator->messages()
                ],
                422
            );
        } else {

            $student = Students::create([
                'name' => $request->name,
                'phoneNumber' => $request->phoneNumber,
                'age' => $request->age,
            ]);

            if ($student) {

                return response()->json([
                    'status' => 200,
                    'message' => 'student create'

                ], 200);

            } else {

                return response()->json([
                    'status' => 404,
                    'message' => 'cant create students'

                ], 404);
            }
        }
    }

    public function update($id, Request $request)
    {

        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:100',
            'phoneNumber' => 'required|integer|min:6',
            'age' => 'required|integer|min:3',
        ]);

        if ($validator->fails()) {

            return response()->json(
                [
                    'status' => 422,
                    'error' => $validator->messages()
                ],
                422
            );
        } else {

            $student = Students::find($id);

            if ($student) {

                $student->update([
                    'name' => $request->name,
                    'phoneNumber' => $request->phoneNumber,
                    'age' => $request->age,
                ]);

                return response()->json([
                    'status' => 200,
                    'message' => 'student updated successfully'

                ], 200);

            } else {

                return response()->json([
                    'status' => 404,
                    'message' => 'cant update students'

                ], 404);
            }
        }
    }
}