<?php

namespace App\Http\Controllers;

use App\Models\AcademyStudent;
use Illuminate\Http\Request;

class AcademyStudentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $students = AcademyStudent::join('Category', 'Category.id', '=', 'Category_Course_Class_Student.CategoryId')
                                    ->join('Course', 'Course.id', '=', 'Category_Course_Class_Student.CourseId')
                                    ->join('Class', 'Class.id', '=', 'Category_Course_Class_Student.ClassId')
                                    ->join('maite_backend.users', 'users.id', '=', 'Category_Course_Class_Student.StudentId')
            ->selectRaw("Category_Course_Class_Student.CategoryId,Category.Title as Title_Category,
            Category_Course_Class_Student.CourseId, Course.Title as Title_Course, 
                        ClassId, Class.Title as Title_Class,
                        StudentId, users.name, 
                        Category_Course_Class_Student.State")
            ->get();

        return $students;
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->all();

        
        // Creamos un nuevo objeto del modelo
        $students = new AcademyStudent();

        // Asignamos los datos a las propiedades del objeto
        $students->CategoryId= $data['CategoryId'];
        $students->CourseId= $data['CourseId'];
        $students->ClassId= $data['ClassId'];
        $students->StudentId= $data['StudentId'];
        $students->State= $data['State'];

        // Guardamos el objeto en la base de datos
        $students->save();

        $insertedId = $students->Id;
    
    
        // Retornamos una respuesta de éxito
        return response()->json(['message' => 'Datos insertados correctamente', 'inserted_id' => $insertedId]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request)
    {
        $data = $request->all();   
              

        $students = AcademyStudent::where(function($query) use ($data) {
                                        if (isset($data['id'])) {
                                            $query->Where('Category_Course_Class_Student.id', $data['id']);
                                        }
                                        if (isset($data['StudentId'])) {
                                            $query->Where('StudentId', $data['StudentId']);
                                        }
                                        
                                    })
                                    ->join('Category', 'Category.id', '=', 'Category_Course_Class_Student.CategoryId')
                                    ->join('Course', 'Course.id', '=', 'Category_Course_Class_Student.CourseId')
                                    ->join('Class', 'Class.id', '=', 'Category_Course_Class_Student.ClassId')
                                    ->join('maite_backend.users', 'users.id', '=', 'Category_Course_Class_Student.StudentId')
            ->selectRaw("Category_Course_Class_Student.CategoryId,Category.Title as Title_Category,
            Category_Course_Class_Student.CourseId, Course.Title as Title_Course, 
                        ClassId, Class.Title as Title_Class,
                        StudentId, users.name, 
                        Category_Course_Class_Student.State")
            ->get();


       

                                         
        
        return $students;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, AcademyStudent $AcademyStudent)
    {
        $data = $request->all();


        $Id = $data['Id'];
        $CategoryId = $data['CategoryId'] ?? 0;
        $CourseId = $data['CourseId'] ?? 0;
        $ClassId = $data['ClassId'] ?? 0;
        $StudentId = $data['StudentId'] ?? 0;
        $State = $data['State'] ?? 0;

       
        try {
            AcademyStudent::where('id', $Id)->update([
                'CategoryId' => $CategoryId,
                'CourseId' => $CourseId,
                'ClassId' => $ClassId,
                'StudentId' => $StudentId,
                'CategoryId' => $CategoryId,
                'State' => $State,
                // Agrega otros campos que quieras actualizar aquí
            ]);
    
            // Actualización exitosa
            return response()->json(['message' => 'Datos actualizados correctamente']);
        } catch (\Exception $e) {
            // Error durante la actualización
            return response()->json(['error' => 'Error al actualizar los datos' . $e->getMessage()], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
