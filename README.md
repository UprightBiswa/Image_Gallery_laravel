# Image_Gallery_laravel
using laravel made a image gallery 
![image](https://user-images.githubusercontent.com/90900262/216684950-bf1e81da-562d-4f6a-a3fa-5537baf4c9b3.png)
In this posts, i am going to share with you how to make bootstrap photo gallery with validation and fancybox in laravel 5, laravel 6, laravel 7, laravel 8 and laravel 9 application.
As we know, we almost require to develop image gallery module for user. Photo album will help to easily upload image and remove that with proper validation. So we always want to built good bootstrap layout with image gallery. However in this example, we will implement photo gallery from scratch with good layout that way you can simply built it with your project.
In this example i created "image_gallery" table with main 'title' and 'image' columns. I created one controller and view file for display form and error messages, validation etc. After finish this example you will find layout as like bellow preview:
Preview:



Step 1 : Install Laravel Application
This tutorial is from scratch, So we require to get fresh Laravel 5.4 application using bellow command, So open your terminal OR command prompt and run bellow command:
composer create-project --prefer-dist laravel/laravel blog
Step 2: Database Configuration
In this step we have to make database configuration for example database name, username, password etc. So let's open .env file and fill all details like as bellow:
.env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=here your database name(blog)
DB_USERNAME=here database username(root)
DB_PASSWORD=here database password(root)
Step 3: Create ImageGallery Table and Model
In this step we have to create migration for image_gallery table using Laravel 5.4 php artisan command, so first fire bellow command:
php artisan make:migration create_image_gallery_table
After this command you will find one file in following path database/migrations and you have to put bellow code in your migration file for create Image_gallery table.
<?php


use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;


return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('image_gallery', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->string('image');
            $table->timestamps();
        });
    }


    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('image_gallery');
    }
};



After creating table we have to create model for "image_gallery" table so just run bellow command and create new model:
php artisan make:model ImageGallery
Ok, so after run bellow command you will find app/ImageGallery.php and put bellow content in ImageGallery.php file:




app/ImageGallery.php


<?php


namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class ImageGallery extends Model
{
    use HasFactory;
    protected $table = 'image_gallery';
    protected $fillable =['title','image'];
}



Step 4: Create Route
In this is step we need to create route for image listing, upload and delete. so open your routes/web.php file and add following route.
routes/web.php
Route::get('/image-gallery',[ImageGalleryController::class,'index']);
Route::post('/image-gallery',[ImageGalleryController::class,'upload']);
Route::delete('/image-gallery/{id}',[ImageGalleryController::class,'destroy']);

Step 5: Create Controller
In this point, now we should create new controller as ImageGalleryController. So run bellow command and create new controller.
php artisan make:controller ImageGalleryController
After bellow command you will find new file in this path app/Http/Controllers/ImageGalleryController.php.
In this controller we will write three method for listing, upload and delete as listed bellow methods:
1)index()
2)upload()
3)destroy()
So, let's copy bellow code and put on ImageGalleryController.php file.
app/Http/Controllers/ImageGalleryController.php
<?php


namespace App\Http\Controllers;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ImageGallery;


class ImageGalleryController extends Controller
{
    // public function index(){
    //     $image = ImageGallery::get();
    //     return view('image-gallery',compact('image'));
    // }
    public function index()
{
    $images = ImageGallery::all();
    return view('image-gallery', compact('images'));
}




    public function upload(Request $request){
        $this->validate($request, [
            'title' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:10048',
        ]);
        $input['image'] = time().'.'. $request->image->getClientOriginalExtension();
        $request->image->move(public_path('images'),$input['image']);


        $input['title']= $request->title;
        ImageGallery::create($input);


        return back()->with('success','Image Uploaded SuccessFully.');


    }


    public function destroy ($id){
        ImageGallery::find($id)->delete();
        return back()->with('success','Image removed successfully.');
    }




}



Step 6: Create View
In Last step, let's create image-gallery.blade.php(resources/views/image-gallery.blade.php) for layout and we will write design code and image upload, delete code as well,so put following code:
resources/views/image-gallery.blade.php
<!DOCTYPE html>
<html>
<head>
    <title>Image Gallery Example</title>
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <!-- References: https://github.com/fancyapps/fancyBox -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/2.1.5/jquery.fancybox.min.css" media="screen">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fancybox/2.1.5/jquery.fancybox.min.js"></script>




    <style type="text/css">
    .gallery
    {
        display: inline-block;
        margin-top: 20px;
    }
    .close-icon{
        border-radius: 50%;
        position: absolute;
        right: 5px;
        top: -10px;
        padding: 5px 8px;
    }
    .form-image-upload{
        background: #e8e8e8 none repeat scroll 0 0;
        padding: 15px;
    }
    </style>
</head>
<body>




<div class="container">




    <h3>Laravel - Image Gallery CRUD Example</h3>
    <form action="{{ url('image-gallery') }}" class="form-image-upload" method="POST" enctype="multipart/form-data">




        {!! csrf_field() !!}




        @if (count($errors) > 0)
            <div class="alert alert-danger">
                <strong>Whoops!</strong> There were some problems with your input.<br><br>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif




        @if ($message = Session::get('success'))
        <div class="alert alert-success alert-block">
            <button type="button" class="close" data-dismiss="alert">×</button>
                <strong>{{ $message }}</strong>
        </div>
        @endif




        <div class="row">
            <div class="col-md-5">
                <strong>Title:</strong>
                <input type="text" name="title" class="form-control" placeholder="Title">
            </div>
            <div class="col-md-5">
                <strong>Image:</strong>
                <input type="file" name="image" class="form-control">
            </div>
            <div class="col-md-2">
                <br/>
                <button type="submit" class="btn btn-success">Upload</button>
            </div>
        </div>




    </form>




    <div class="row">
    <div class='list-group gallery'>




            @if($images->count())
                @foreach($images as $image)
                <div class='col-sm-4 col-xs-6 col-md-3 col-lg-3'>
                    <a class="thumbnail fancybox" rel="ligthbox" href="/images/{{ $image->image }}">
                        <img class="img-responsive" alt="" src="/images/{{ $image->image }}" />
                        <div class='text-center'>
                            <small class='text-muted'>{{ $image->title }}</small>
                        </div> <!-- text-center / end -->
                    </a>
                    <form action="{{ url('image-gallery',$image->id) }}" method="POST">
                    <input type="hidden" name="_method" value="delete">
                    {!! csrf_field() !!}
                    <button type="submit" class="close-icon btn btn-danger"><i class="glyphicon glyphicon-remove"></i></button>
                    </form>
                </div> <!-- col-6 / end -->
                @endforeach
            @endif




        </div> <!-- list-group / end -->
    </div> <!-- row / end -->
</div> <!-- container / end -->




</body>




<script type="text/javascript">
    $(document).ready(function(){
        $(".fancybox").fancybox({
            openEffect: "none",
            closeEffect: "none"
        });
    });
</script>
</html>

Make sure to create images folder on your public directory.
Because images will save on that directory.
Now we are ready to run our example so run bellow command for quick run:
php artisan serve
Now you can open bellow URL on your browser:
http://localhost:8000/image-gallery
