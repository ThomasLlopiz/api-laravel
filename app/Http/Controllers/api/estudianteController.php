<?php
namespace App\Http\Controllers\api;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Estudiante;
use App\Http\Controllers\Controller;
class estudianteController extends Controller
{
    public function index()
    {
        $estudiante = Estudiante::all();
        if ($estudiante->isEmpty()) {
            $data = [
                'mensaje' => 'NO se encontro nada',
                'status' => 200,
            ];
            return response()->json($data, 200);
        }
        return response()->json($estudiante, 200);
    }
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nombre' => 'required|max:50',
            'email' => 'required|email|unique:estudiantes',
            'telefono' => 'required|digits:10',
            'lenguaje' => 'required|in:English,Spanish,French',
        ]);
        if ($validator->fails()) {
            $data = [
                'menssage' => 'Error en la validacion de los datos',
                'errors' => $validator->errors(),
                'status' => 400,
            ];
            return response()->json($data, 400);
        }
        $estudiante = Estudiante::create([
            'nombre' => $request->nombre,
            'email' => $request->email,
            'telefono' => $request->telefono,
            'lenguaje' => $request->lenguaje,
        ]);
        if (!$estudiante) {
            $data = [
                'menssage' => 'Error al crear estudiante',
                'status' => 400,
            ];
            return response()->json($data, 500);
        }
        $data = [
            'menssage' => $estudiante,
            'status' => 201,
        ];
        return response()->json($data, 201);
    }
    public function show($id)
    {
        $estudiante = Estudiante::find($id);
        if (!$estudiante) {
            $data = [
                'message' => 'estudiante no encontrado',
                'status' => 404
            ];
            return response()->json($data, 404);
        }
        $data = [
            'estudiante' => $estudiante,
            'status' => 200
        ];
        return response()->json($data, 200);
    }
    public function destroy($id)
    {
        $estudiante = Estudiante::find($id);
        if (!$estudiante) {
            $data = [
                'message' => 'Estudiante no encontrado',
                'status' => 404
            ];
            return response()->json($data, 404);
        }
        $estudiante->delete();
        $data = [
            'message' => 'Estudiante eliminado',
            'status' => 200
        ];
        return response()->json($data, 200);
    }
    public function update(Request $request, $id)
    {
        $estudiante = Estudiante::find($id);
        if (!$estudiante) {
            $data = [
                'message' => 'Estudiante no encontrado',
                'status' => 404
            ];
            return response()->json($data, 404);
        }
        $validator = Validator::make($request->all(), [
            'nombre' => 'required|max:50',
            'email' => 'required|email|unique:estudiantes',
            'telefono' => 'required|digits:10',
            'lenguaje' => 'required|in:English,Spanish,French',
        ]);
        if ($validator->fails()) {
            $data = [
                'message' => 'Error en la validación de los datos',
                'error' => $validator->errors(),
                'status' => 400
            ];
            return response()->json($data, 400);
        }
        $estudiante->nombre = $request->nombre;
        $estudiante->email = $request->email;
        $estudiante->telefono = $request->telefono;
        $estudiante->lenguaje = $request->lenguaje;
        $estudiante->save();

        $data = [
            'message' => 'estudiante actualizado',
            'estudiante' => $estudiante,
            'status' => 200

        ];
        return response()->json($data, 200);
    }
    public function updatePartial(Request $request, $id)
    {
        $estudiante = Estudiante::find($id);
        if (!$estudiante) {
            $data = [
                'message' => 'Estudiante no encontrado',
                'status' => 404
            ];
            return response()->json($data, 404);
        }
        $validator = Validator::make($request->all(), [
            'nombre' => 'max:50',
            'email' => 'email|unique:estudiantes',
            'telefono' => 'digits:10',
            'lenguaje' => 'in:English,Spanish,French',
        ]);
        if ($validator->fails()) {
            $data = [
                'message' => 'Error en la validación de los datos',
                'error' => $validator->errors(),
                'status' => 400
            ];
            return response()->json($data, 400);
        }
        if ($request->has('nombre')) {
            $estudiante->nombre = $request->nombre;
        }
        if ($request->has('email')) {
            $estudiante->email = $request->email;
        }
        if ($request->has('telefono')) {
            $estudiante->telefono = $request->telefono;
        }
        if ($request->has('lenguaje')) {
            $estudiante->lenguaje = $request->lenguaje;
        }


        $estudiante->save();

        $data = [
            'message' => 'estudiante actualizado',
            'estudiante' => $estudiante,
            'status' => 200

        ];
        return response()->json($data, 200);
    }

}
