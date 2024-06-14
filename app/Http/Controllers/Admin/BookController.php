<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Book;
use App\Models\Category;
use App\Models\Author;
use ZipArchive;
use Illuminate\Support\Str;

use Illuminate\Support\Facades\Storage;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $books = Book::with('author')->paginate(10);
        
        return view('admin.books.index', compact('books'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        $authors = Author::all();
        return view('admin.books.create', compact('categories', 'authors'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        //dd($request);
        $validatedData = $request->validate([
            'title' => 'required|string|max:50',
            'categories' => 'required',
            'author_id' => 'exists:authors,id',
            'year' => 'required|integer|min:0',
            'file' => 'required|file|mimes:epub',
            'synopsis' => 'nullable|string',
        ]);
        
       
        
       $book = Book::create($request->all());
       $book->categories()->sync($request->categories);
       $book->file_path = Storage::put(('books'), $request->file('file'));  
       $book->save();
       $this->saveCover($request->file('file'), $book->file_path);

       
        return redirect()->route('admin.books.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $book = Book::findOrFail($id);
        $categories = $book->categories()->pluck('name')->toArray();
        return view('admin.books.show', compact('book', 'categories'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {   
        $book = Book::findOrFail($id);
        $categories = Category::all();
        $authors = Author::all();

        return view('admin.books.edit', compact('book', 'categories','authors'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validatedData = $request->validate([
            'title' => 'required|string|max:50',
            'categories' => 'required',
            'author_id' => 'exists:authors,id',
            'year' => 'required|integer|min:0',
            'file' => 'file|mimes:epub',
            'synopsis' => 'nullable|string',
        ]);

        $book = Book::findOrFail($id);
        $book->fill($request->only('title', 'author_id', 'year', 'synopsis'));
       $book->categories()->sync($request->categories);
       
       if($request->hasFile('file')){
            $book->file_path = Storage::put(('books'), $request->file('file'));
            $book->update();       
            $this->saveCover($request->file('file'), $book->file_path);
        }
        $book->update();
        //dd($request);
        return redirect()->route('admin.books.show', $book->id);
        
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Book::destroy($id);
        return redirect()->route('admin.books.index');
    }
    public function download($id)
    {
        $book = Book::findOrFail($id);
    
        if ($book->file_path !== null) {
            if (!Storage::exists($book->file_path)) {
                return redirect()->route('admin.books.show', $book->id)->withErrors(['El archivo no existe']);
            } else {
                return Storage::download($book->file_path);
            }
        }
        
        return redirect()->route('admin.books.show', $book->id)->withErrors(['El archivo no existe']);
    }
    

    private function saveCover($file, $path)
    {
        
        $zip = new ZipArchive();
        if($zip->open($file)===TRUE){
            $unzipedBookPath= $zip->extractTo('/tmp'.'/'.$path);
            if($unzipedBookPath){

                $coverPath = $this->buscarImagenCover('/tmp'.'/'.$path);
                if($coverPath===null){
                    $coverPath = $this->buscarImagenCover('/tmp'.'/'.$path.'/OEBPS');
                }
                if($coverPath===null){
                    $coverPath = $this->buscarImagenCover('/tmp'.'/'.$path.'/OEBPS/image');
                }
                if($coverPath===null){
                    $coverPath = $this->buscarImagenCover('/tmp'.'/'.$path.'/OEBPS/images');
                }


                $imagePath = 'covers/'.Str::uuid().'.jpg';
                $book = Book::where('file_path', $path)->first();

                if($coverPath===null){
                    $book->cover_path = null;
                }else{

                    Storage::put($imagePath, file_get_contents($coverPath));
                    $book->cover_path = $imagePath;
                }
                

                
                
                $book->update();
                return true;
                
            }
            $zip->close();
        }
        return false;
        
    }

    private function buscarImagenCover($directorio) {

    $archivos = scandir($directorio);
    $imagenes = [];


    foreach ($archivos as $archivo) {
        if ($archivo === '.' || $archivo === '..') {
            continue;
        }

        $extension = strtolower(pathinfo($archivo, PATHINFO_EXTENSION));
        if (in_array($extension, ['jpg', 'jpeg', 'png'])) {
            $imagenes[] = $archivo;
        }
    }

    if (empty($imagenes)) {
        return null;
    }

    foreach ($imagenes as $imagen) {
        if ((stripos($imagen, 'cover') !== false)) {
            return $directorio . DIRECTORY_SEPARATOR . $imagen;
        }
    }

    return $directorio . DIRECTORY_SEPARATOR . $imagenes[0];
    }
    
    

}
