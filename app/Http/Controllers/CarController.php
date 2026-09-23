<?php
namespace App\Http\Controllers;

use App\Models\Car;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class CarController extends Controller
{
    public function home()
    {
        $cars = Car::with('images')->where('published', true)->latest()->take(8)->get();
        return view('cars.home', compact('cars'));
    }

    public function index(Request $request)
    {
        $query = Car::with('images')->where('published', true);
        $this->applyFilters($query, $request);
        $cars = $query->latest()->paginate(12)->withQueryString();
        return view('cars.index', compact('cars'));
    }

    public function show(Car $car)
    {
        abort_unless($car->published || auth()->id() === $car->user_id, 404);
        $car->load('images','user');
        return view('cars.show', compact('car'));
    }

    public function myCars()
    {
        $cars = auth()->user()->cars()->with('images')->latest()->paginate(10);
        return view('cars.my-cars', compact('cars'));
    }

    public function create()
    {
        return view('cars.create');
    }

    public function store(Request $request)
    {
        $car = $this->saveCar(new Car(), $request);
        return redirect()->route('cars.mine')->with('success','Car listed successfully.');
    }

    public function edit(Car $car)
    {
        $this->authorizeCar($car);
        $car->load('images');
        return view('cars.edit', compact('car'));
    }

    public function update(Request $request, Car $car)
    {
        $this->authorizeCar($car);
        $this->saveCar($car, $request, true);
        return redirect()->route('cars.mine')->with('success','Car updated successfully.');
    }

    public function destroy(Car $car)
    {
        $this->authorizeCar($car);
        foreach ($car->images as $image) Storage::disk('public')->delete($image->path);
        $car->delete();
        return back()->with('success','Car deleted.');
    }

    public function toggleWatchlist(Car $car)
    {
        $car->watchlistedBy()->toggle([auth()->id()]);
        return back()->with('success','Watchlist updated.');
    }

    public function watchlist()
    {
        $cars = auth()->user()->watchlistCars()->with('images')->latest()->paginate(12);
        return view('cars.watchlist', compact('cars'));
    }

    public function images(Car $car)
    {
        $this->authorizeCar($car);
        $car->load('images');
        return view('cars.images', compact('car'));
    }

    public function uploadImages(Request $request, Car $car)
    {
        $this->authorizeCar($car);
        $request->validate(['images'=>'required|array|max:10','images.*'=>'image|max:5120']);
        $position = ((int)$car->images()->max('position')) + 1;
        foreach ($request->file('images') as $file) {
            $path = $file->store('cars/'.$car->id, 'public');
            $car->images()->create(['path'=>$path,'position'=>$position++]);
        }
        return back()->with('success','Images uploaded.');
    }

    private function authorizeCar(Car $car): void
    {
        abort_unless(auth()->id() === $car->user_id, 403);
    }

    private function saveCar(Car $car, Request $request, bool $updating=false): Car
    {
        $data = $request->validate([
            'maker'=>'required|string|max:100',
            'model'=>'required|string|max:100',
            'year'=>'required|integer|min:1900|max:'.(date('Y')+1),
            'car_type'=>'required|in:sedan,hatchback,suv',
            'fuel_type'=>'required|in:gasoline,diesel,electric,hybrid',
            'price'=>'required|numeric|min:0',
            'mileage'=>'required|integer|min:0',
            'state'=>'nullable|string|max:100',
            'city'=>'nullable|string|max:100',
            'description'=>'nullable|string|max:5000',
            'features'=>'nullable|array',
            'published'=>'nullable|boolean',
            'images'=>'nullable|array|max:10',
            'images.*'=>'image|max:5120',
        ]);
        if (!$updating) $data['user_id']=auth()->id();
        $data['published']=$request->boolean('published');
        $features = $request->input('features', []);
        $data['features']=$features;
        unset($data['images']);
        $car->fill($data)->save();

        if ($request->hasFile('images')) {
            $position = ((int)$car->images()->max('position')) + 1;
            foreach ($request->file('images') as $file) {
                $path = $file->store('cars/'.$car->id, 'public');
                $car->images()->create(['path'=>$path,'position'=>$position++]);
            }
        }
        return $car;
    }

    private function applyFilters($query, Request $request): void
    {
        foreach (['maker','model','state','city','car_type','fuel_type'] as $field) {
            if ($request->filled($field)) $query->where($field, $request->input($field));
        }
        if ($request->filled('year_from')) $query->where('year','>=',$request->integer('year_from'));
        if ($request->filled('year_to')) $query->where('year','<=',$request->integer('year_to'));
        if ($request->filled('price_from')) $query->where('price','>=',$request->input('price_from'));
        if ($request->filled('price_to')) $query->where('price','<=',$request->input('price_to'));
        if ($request->filled('mileage')) $query->where('mileage','<=',$request->integer('mileage'));
    }
}