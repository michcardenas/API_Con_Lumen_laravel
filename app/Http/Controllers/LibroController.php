<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Libro;


class LibroController extends Controller{

    public function index(){
        $libros = Libro::all();
        return response()->json($libros);
    }

    public function guardar(Request $request){
     
         $libro = new Libro();
         if($request->hasFile('imagen')){
             $file = $request->file('imagen');
             $name = time().$file->getClientOriginalName();
            $destino ='./upload';
            $request->file('imagen')->move($destino, $name);      
            $libro->titulo = $request->titulo;
            $libro->imagen =ltrim($destino.'/'.$name,'.');
        //  $libro->editorial = $request->editorial;
            $libro->save();
           }
       ;
          
         return response()->json(   $name );
    }
    public function ver($id){
    
        $datoslibro = Libro::find($id);
        return response()->json($datoslibro);
    }
    public function eliminar($id){
         $libro = Libro::find($id);

        if ($libro) {
            $rutaArchivo=base_path().'/public'.$libro->imagen;
            if (file_exists($rutaArchivo)) {
                unlink($rutaArchivo);
            }
            $libro->delete();
        }
        return response()->json('Libro eliminado');
    }
    public function actualizar(Request $request, $id){
        $libro = Libro::find($id);
        if($request->input('titulo')){
            $libro->titulo = $request->titulo;
            // $libro->imagen = $request->imagen;
        }
    

        if($request->hasFile('imagen')){
            $rutaArchivo=base_path().'/public'.$libro->imagen;
            if (file_exists($rutaArchivo)) {
                unlink($rutaArchivo);
            }
            $libro->delete();
            $file = $request->file('imagen');
            $name = time().$file->getClientOriginalName();
           $destino ='./upload';
           $request->file('imagen')->move($destino, $name);      
           $libro->imagen =ltrim($destino.'/'.$name,'.');
       //  $libro->editorial = $request->editorial;
           $libro->save();
          }
          $libro->save();
          return response()->json($libro);

    }

}