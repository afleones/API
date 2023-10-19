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
        $students->State= $data['CategoryId'];
        $students->State= $data['State'];

        // Guardamos el objeto en la base de datos
        $students->save();

        $insertedId = $students->id;
    
    
        // Retornamos una respuesta de éxito
        return response()->json(['message' => 'Datos insertados correctamente', 'inserted_id' => $insertedId]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request)
    {
        $data = $request->all();   
              

        $Course = AcademyCourse::where(function($query) use ($data) {
                            if (isset($data['id'])) {
                                $query->Where('id', $data['id']);
                            }
                            if (isset($data['Author'])) {
                                $query->Where('Author', $data['Author']);
                            }
                            if (isset($data['State'])) {
                                $query->Where('State', $data['State']);
                            }
                         })
                         ->get();     

                                         
        
        return $Course;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, AcademyCourse $AcademyCourse)
    {
        $data = $request->all();
        $Id = $data['Id'];
        $Title = $data['Title'] ?? '';
        $Author = $data['Author'] ?? 0;
        $Image = $data['Image'] ?? 0;
        $Description = $data['Description'] ?? '';
        $CategoryId = $data['CategoryId'] ?? '';
        $State = $data['State'] ?? 0;

        try {
            AcademyCourse::where('id', $Id)->update([
                'Title' => $Title,
                'Author' => $Author,
                'Image' => $Image,
                'Description' => $Description,
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
