<html>

<head>

 
</head>

<body>
  <h1>Image_gallery</h1>
  <p>In this posts, i am going to share with you how to make bootstrap photo gallery with validation and fancybox in laravel 5, laravel 6, laravel 7, laravel 8 and laravel 9 application.
As we know, we almost require to develop image gallery module for user. Photo album will help to easily upload image and remove that with proper validation. So we always want to built good bootstrap layout with image gallery. However in this example, we will implement photo gallery from scratch with good layout that way you can simply built it with your project.
In this example i created "image_gallery" table with main 'title' and 'image' columns. I created one controller and view file for display form and error messages, validation etc. After finish this example you will find layout as like bellow preview:
.![image](https://user-images.githubusercontent.com/90900262/216687637-a74bd544-89f5-412b-ad5e-9c678e4af88d.png)</p>


 
 <li>Step 1:: Install Laravel Application
This tutorial is from scratch, So we require to get fresh Laravel 5.4 application using bellow command, So open your terminal OR command prompt and run bellow command:
composer create-project --prefer-dist laravel/laravel blog
</li>
    <code>git clone https://github.com/username/repository.git</code>
    <li>Step 2:Database Configuration
In this step we have to make database configuration for example database name, username, password etc. So let's open .env file and fill all details like as bellow:
.env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=here your database name(blog)
DB_USERNAME=here database username(root)
DB_PASSWORD=here database password(root)
</li>
    
 
  <li>Step 3:Create ImageGallery Table and Model
In this step we have to create migration for image_gallery table using Laravel 5.4 php artisan command, so first fire bellow command:
php artisan make:migration create_image_gallery_table
After this command you will find one file in following path database/migrations and you have to put bellow code in your migration file for create Image_gallery table.
   app/ImageGallery.php
</li>

  <p>After creating table we have to create model for "image_gallery" table so just run bellow command and create new model:
php artisan make:model ImageGallery
Ok, so after run bellow command you will find app/ImageGallery.php and put bellow content in ImageGallery.php file:
</p>
 <p>Step 4: Create Route
In this is step we need to create route for image listing, upload and delete. so open your routes/web.php file and add following route.
routes/web.php
Route::get('/image-gallery',[ImageGalleryController::class,'index']);
Route::post('/image-gallery',[ImageGalleryController::class,'upload']);
Route::delete('/image-gallery/{id}',[ImageGalleryController::class,'destroy']);
 </p>
  <p>Step 5: Create Controller
In this point, now we should create new controller as ImageGalleryController. So run bellow command and create new controller.
php artisan make:controller ImageGalleryController
After bellow command you will find new file in this path app/Http/Controllers/ImageGalleryController.php.
In this controller we will write three method for listing, upload and delete as listed bellow methods:
1)index()
2)upload()
3)destroy()
So, let's copy bellow code and put on ImageGalleryController.php file.
app/Http/Controllers/ImageGalleryController.php
</p>
 
    <li>Step 6: Create View
In Last step, let's create image-gallery.blade.php(resources/views/image-gallery.blade.php) for layout and we will write design code and image upload, delete code as well,so put following code:
resources/views/image-gallery.blade.php
</li>
    <code>npm start</code>
    <li>Make sure to create images folder on your public directory.
Because images will save on that directory.
Now we are ready to run our example so run bellow command for quick run:
php artisan serve
Now you can open bellow URL on your browser:
http://localhost:8000/image-gallery
</li>
   



</body>

</html>
