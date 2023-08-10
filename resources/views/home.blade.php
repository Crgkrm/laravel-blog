
<x-app-layout meta-title="The Laravel Blog"
              meta-description="Lorem ipsum dolor sit amet, consectetur adipisicing elit">
<div class="container max-w-3xl mx-auto  py-6">
  <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
     <!--  Latest Posts  -->
    <div class="col-span-2">
    <h2 class="text-lg sm:text-xl font-bold text-blue-500 uppercase pb-1 border-b-2 border-blue-500 mb-3">
      Latest Post
   </h2>
   <div>
    <x-post-item :post="$latestPost"/>
   </div>
  </div>
  <!-- popular top 3 post -->
  <div>
  <h2 class="text-lg sm:text-xl font-bold text-blue-500 uppercase pb-1 border-b-2 border-blue-500 mb-3">
      Popular post
   </h2>
   <div>
    @foreach($popularPosts as $post)
    <div class="grid grid-cols-4 gap-2 mb-4">
     <a class="pt-3" href="{{route('view',$post)}}">
     <img src="{{$post->getThumbnails()}}" alt="{{$post->title}}">
   </a>
     <div class="col-span-3">
      <a href="{{route('view',$post)}}">
      <h3 class="text-semibold">{{$post->title}}</h3>
      </a> 
      <div class="text-sm">
       {{$post-> shortBody(10)}}
      </div>
      <a href="{{route('view',$post)}}" class=" text-xs uppercase text-gray-800 hover:text-black">Continue Reading <i class="fas fa-arrow-right"></i></a>
     </div>
   </div>
     @endforeach
     </div>
</div>
<div>
</div>
</div>
</x-app-layout>

