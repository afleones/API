<?php

namespace App\Http\Controllers;

use App\Models\AcademyCategory;

use App\Models\AcademyCourse;
use App\Models\AcademyClass;
use App\Models\AcademyStudent;

use Illuminate\Http\Request;

class AcademyCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $Category = AcademyCategory::selectRaw("id,
                                    Title,
                                    Author,
                                    State
        ")->get();
        return $Category;
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->all();

        
        // Creamos un nuevo objeto del modelo
        $Category = new AcademyCategory();

        // Asignamos los datos a las propiedades del objeto
        $Category->Title= $data['Title'];
        $Category->Author= $data['Author'];
        $Category->State= $data['State'];


        // Guardamos el objeto en la base de datos
        $Category->save();
    
        $insertedId = $Category->Id;
    
        // Retornamos una respuesta de éxito
        return response()->json(['message' => 'Datos insertados correctamente', 'inserted_id' => $insertedId]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request)
    {
        $data = $request->all();   
              

        $Category = AcademyCategory::where(function($query) use ($data) {
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

                                         
        
        return $Category;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $data = $request->all();
        $Id = $data['Id'];
        $Title = $data['Title'] ?? '';
        $Author = $data['Author'] ?? 0;
        $State = $data['State'] ?? 0; 
        
        
       
        
        try {
            AcademyCategory::where('id', $Id)->update([
                'Title' => $Title,
                'Author' => $Author,
                'State' => $State
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


    public function showCoursexCategory(Request $request){
        //$data = $request->json()->all();
        $data = $request->all(); 

        //var_dump($data);exit();
        //$userid = $data['userid'];

        $Categories = AcademyCategory::join('maite_backend.users', 'users.id', '=', 'Category.Author')
                         ->where(function($query) use ($data) {  
                            if (isset($data['Category.Id'])) {
                                $query->Where('Category.Id', $data['Id']);
                            }
                            if (isset($data['role']) and $data['role'] <> '1') {
                                if (isset($data['Author'])) {
                                    $query->Where('Author', $data['Author']);
                                }
                            }
                            if (isset($data['State'])) {
                                $query->Where('State', $data['State']);
                            }

                         })
                         
                         ->selectRaw('Category.Id,Author,name,Title,State')

                         
                         ->get();

        
                         $payload = []; // Inicializa el arreglo de resultados

                        foreach ($Categories as $Category) {
                            $detalleCourses = AcademyCourse::join('maite_backend.users', 'users.id', '=', 'Course.Author')
                                                             ->where('CategoryId', $Category->Id)->get();
                            $coursesData = [];

                            foreach ($detalleCourses as $Course) {
                                $detalleClasses = AcademyClass::join('maite_backend.users', 'users.id', '=', 'Class.Author')
                                                              ->where('CourseId', $Course->Id)
                                                              ->selectRaw('Class.Id,Title,Author,name,Image,CourseId,Video,Description,State,Class.created_at,Class.updated_at')
                                                              ->get();

                                                              $detalleClassList=[];
                                                                    foreach ($detalleClasses as $detalleClassDetail) {

                                                                       

                                                                            $detalleClassList[] =[
                                                                                'Id' => $detalleClassDetail->Id,
                                                                                'Title' => $detalleClassDetail->Title,
                                                                                'AuthorId' => $detalleClassDetail->Author,
                                                                                'Author' => $detalleClassDetail->name,
                                                                                'Image' => $detalleClassDetail->Image,
                                                                                'CourseId' => $detalleClassDetail->CourseId,
                                                                                'Video' => $detalleClassDetail->Video,
                                                                                'Description' => $detalleClassDetail->Description,
                                                                                'State' => $detalleClassDetail->State,
                                                                                'created_at' => $detalleClassDetail->created_at,
                                                                                'updated_at' => $detalleClassDetail->updated_at,
                                                                            ];
                                                                    }




                                $coursesData[] = [
                                    'Id' => $Course->Id,
                                    'Title' => $Course->Title,
                                    'AuthorId' => $Course->Author,
                                    'Author' => $Course->name,
                                    'Image' => $Course->Image,
                                    'Description' => $Course->Description,
                                    'CategoryId' => $Course->CategoryId,
                                    'State' => $Course->State,
                                    'classes' => $detalleClassList
                                ];
                            }

                            $payload[] = [
                                'Id' => $Category->Id,
                                'AuthorId' => $Category->Author,
                                'Author' => $Category->name,
                                'Title' => $Category->Title,
                                'State' => $Category->State,
                                'courses' => $coursesData
                            ];
                        }

        return $payload;
    }

    public function showCoursexCategoryStudent(Request $request){
        //$data = $request->json()->all();
        $data = $request->all(); 

        //var_dump($data);exit();
        //$userid = $data['userid'];

        $Categories = AcademyCategory::join('maite_backend.users', 'users.id', '=', 'Category.Author')
                                       //->join('Category_Course_Class_Student', 'CategoryId', '=', 'Category.Id')
                         ->where(function($query) use ($data) {  
                            if (isset($data['Category.Id'])) {
                                $query->Where('Category.Id', $data['Id']);
                            }
                            if (isset($data['Author'])) {
                                $query->Where('Author', $data['Author']);
                            }
                            if (isset($data['State'])) {
                                $query->Where('Category.State', $data['State']);
                            }
                            /*if (isset($data['StudentId'])) {
                                $query->Where('StudentId', $data['StudentId']);
                            }*/
                            if (isset($data['fecha1']) and isset($data['fecha2'])) {
                                $query->whereBetween(\DB::raw('DATE(Category_Course_Class_Student.created_at)'), [$data['fecha1'], $data['fecha2']]);
                            }

                         })
                         ->distinct() 
                         ->selectRaw('Category.Id,Author,name,Title,Category.State')

                         
                         ->get();

        
                         $payload = []; // Inicializa el arreglo de resultados

                        foreach ($Categories as $Category) {
                            $detalleCourses = AcademyCourse::join('maite_backend.users', 'users.id', '=', 'Course.Author')
                                                             ->where('CategoryId', $Category->Id)->get();
                            $coursesData = [];

                            foreach ($detalleCourses as $Course) {
                                $detalleClasses = AcademyClass::join('maite_backend.users', 'users.id', '=', 'Class.Author')
                                                              ->where('CourseId', $Course->Id)
                                                              ->selectRaw('Class.Id,Title,Author,name,Image,CourseId,Video,Description,State,Class.created_at,Class.updated_at')
                                                              ->get();

                                                              $detalleClassList=[];
                                                                    foreach ($detalleClasses as $detalleClassDetail) {
                                                                        
                                                                        $detalleStudent = AcademyStudent::join('maite_backend.users', 'users.id', '=', 'Category_Course_Class_Student.StudentId')
                                                                                                        ->where('ClassId', $detalleClassDetail->Id)
                                                                                                        ->where(function($query) use ($data) {
                                                                                                            if (isset($data['StudentId'])) {
                                                                                                                $query->Where('StudentId', $data['StudentId']);
                                                                                                            }
                                                                                                            
                                                                                                        })
                                                                                                        ->selectRaw('Category_Course_Class_Student.StudentId,users.name,Category_Course_Class_Student.State as ViewedStatus,Category_Course_Class_Student.created_at,Category_Course_Class_Student.updated_at')
                                                                                                        ->get();

                                                                                                        //$detalleStudent=[];


                                                                       



                                                                            $detalleClassList[] =[
                                                                                'Id' => $detalleClassDetail->Id,
                                                                                'Title' => $detalleClassDetail->Title,
                                                                                'AuthorId' => $detalleClassDetail->Author,
                                                                                'Author' => $detalleClassDetail->name,
                                                                                'Image' => $detalleClassDetail->Image,
                                                                                'CourseId' => $detalleClassDetail->CourseId,
                                                                                'Video' => $detalleClassDetail->Video,
                                                                                'Description' => $detalleClassDetail->Description,
                                                                                'State' => $detalleClassDetail->State,
                                                                                'created_at' => $detalleClassDetail->created_at,
                                                                                'updated_at' => $detalleClassDetail->updated_at,
                                                                                'Students' => $detalleStudent
                                                                            ];
                                                                    }




                                $coursesData[] = [
                                    'Id' => $Course->Id,
                                    'Title' => $Course->Title,
                                    'AuthorId' => $Course->Author,
                                    'Author' => $Course->name,
                                    'Image' => $Course->Image,
                                    'Description' => $Course->Description,
                                    'CategoryId' => $Course->CategoryId,
                                    'State' => $Course->State,
                                    'classes' => $detalleClassList
                                ];
                            }

                            $payload[] = [
                                'Id' => $Category->Id,
                                'AuthorId' => $Category->Author,
                                'Author' => $Category->name,
                                'Title' => $Category->Title,
                                'State' => $Category->State,
                                'courses' => $coursesData
                            ];
                        }

        return $payload;
    }

}
