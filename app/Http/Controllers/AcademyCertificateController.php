<?php

namespace App\Http\Controllers;

use PDF;
use App\Models\AcademyCourse;
use App\Models\AcademyExamCertificateStudent;
use App\Models\AcademyCertificate;

use Illuminate\Http\Request;

class AcademyCertificateController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $Class = AcademyCertificate::selectRaw("id,
        CustomTitle,
        CourseId,
        ExamId,
        created_at,
        updated_at
        ")->get();
        return $Class;
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        

        // Ejemplo de cómo podrías crear un nuevo recurso:
        $newResource = new AcademyCertificate();
        $newResource->CustomTitle = $request->input('CustomTitle');
        $newResource->CourseId = $request->input('CourseId');
        $newResource->ExamId = $request->input('ExamId');
        $newResource->Signature1 = $request->input('Signature1');
        $newResource->Signature2 = $request->input('Signature2');
        $newResource->Author = $request->input('Author');
        $newResource->save();

        //return response()->json($newResource, 201); // Devuelve una respuesta JSON con el nuevo recurso y el código de estado 201 (creado).
        $insertedId = $newResource->Id;
        return response()->json(['message' => 'Datos insertados correctamente', 'inserted_id' => $insertedId]);
    }

    public function storeExamCertificateStudent(Request $request)
    {
        $newResource = new AcademyExamCertificateStudent();
        $newResource->ExamId = $request->input('ExamId');
        $newResource->StudentId = $request->input('StudentId');
        $newResource->Approved = $request->input('Approved');
        $newResource->save();
        $insertedId = $newResource->Id;
        return response()->json(['message' => 'Datos insertados correctamente', 'inserted_id' => $insertedId]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // Aquí debes implementar la lógica para mostrar un recurso específico
        $resource = AcademyCertificate::find($id);

        if (!$resource) {
            return response()->json(['message' => 'Recurso no encontrado'], 404);
        }

        return response()->json($resource, 200); 
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
{
    // Obtén los datos de la solicitud
    $data = $request->all();

    try {
        // Encuentra el recurso por su ID
        $resource = AcademyCertificate::where('Id', $data['Id'])->first();

        if (!$resource) {
            return response()->json(['error' => 'Recurso no encontrado'], 404);
        }

        // Actualiza los campos con los datos de la solicitud
        $resource->CustomTitle = $data['CustomTitle'];
        $resource->CourseId = $data['CourseId'];
        $resource->ExamId = $data['ExamId'];
        $resource->Signature1 = $data['Signature1'];
        $resource->Signature2 = $data['Signature2'];
        $resource->Author = $data['Author'];

        // Guarda los cambios en la base de datos
        $resource->save();

        return response()->json(['message' => 'Datos actualizados correctamente']);
    } catch (\Exception $e) {
        return response()->json(['error' => 'Error al actualizar los datos: ' . $e->getMessage()], 500);
    }
}

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function showCertificateStudent(Request $request)
    {
        $data = $request->all();   

        $certificateStudents = AcademyExamCertificateStudent::where(function($query) use ($data) {
            if (isset($data['id'])) {
                $query->Where('Exam_Certificate_Student.id', $data['id']);
            }
            if (isset($data['StudentId'])) {
                $query->Where('StudentId', $data['StudentId']);
            }
            if (isset($data['Approved'])) {
                $query->Where('Approved', $data['Approved']);
            }
            if (isset($data['ExamId'])) {
                $query->Where('ExamId', $data['ExamId']);
            }
            })
            //->join('Category', 'Category.id', '=', 'Category_Course_Class_Student.CategoryId')
            //->join('Course', 'Course.id', '=', 'Category_Course_Class_Student.CourseId')
            //->join('Class', 'Class.id', '=', 'Category_Course_Class_Student.ClassId')
            ->join('maite_backend.users', 'users.id', '=', 'Exam_Certificate_Student.StudentId')
            ->selectRaw("Exam_Certificate_Student.Id, ExamId, 
            StudentId, users.name, Approved
            ")
            ->get();

            return $certificateStudents; 
    }

    public function ViewPDF($certificate){

        //$data = $request->all();   
       // var_dump($certificate);exit();

        $certificateStudents = AcademyExamCertificateStudent::where(function($query) use ($certificate) {
            if (isset($certificate)) {
                $query->Where('Exam_Certificate_Student.Id', $certificate);
            }
            })
            //->join('Category', 'Category.id', '=', 'Category_Course_Class_Student.CategoryId')
            //->join('Course', 'Course.id', '=', 'Certificate.CourseId')
            ->join('Certificate', 'Certificate.ExamId', '=', 'Exam_Certificate_Student.ExamId')
            ->join('maite_backend.users', 'users.id', '=', 'Exam_Certificate_Student.StudentId')

            ->selectRaw("Exam_Certificate_Student.Id, Exam_Certificate_Student.ExamId, 
            Exam_Certificate_Student.StudentId,CustomTitle, users.name,Signature1,Signature2,Exam_Certificate_Student.created_at, Approved
            ")
            ->first();
            //return $certificateStudents; 


        $info_data = [
            'username' => $certificateStudents->name,
            'coursename' => $certificateStudents->CustomTitle,
            'Signature1' => $certificateStudents->Signature1,
            'logo' => 'logo.jpeg',
            'Signature2' => $certificateStudents->Signature2,
            'approvaldate' => $certificateStudents->created_at,
            'coursehour' => '',
        ];
        
        $pdf = PDF::loadView('invoix.quote.template_1', ['info_data' => $info_data])
             ->setPaper('letter', 'landscape'); // Cambiar a orientación horizontal

            //return $pdf->download('maite.pdf');
            return $pdf->stream('maite.pdf');

            
    }

}
