<x-app-layout>
 <div class="flex">
        <!-- Post Section -->
        <section class="w-full md:w-2/3 flex flex-col px-3">
        <article class="flex flex-col shadow my-4">
                <!-- Article Image -->
                <a href="#" class="hover:opacity-75">
                    <img src="/storage/{{$widget->image}}">
                </a>
                <div class="bg-white flex flex-col justify-start p-6">
                    <div class="flex gap-4">
                
                    </div>
                    <h1 class="text-3xl font-bold hover:text-gray-700 pb-4">
                        {{$widget->title}}
                    </h1>
                      <div>
                        {!!$widget->content!!}
                      </div>
                    <div>
                 </div>
                </div>
            </article>

            <div class="w-full flex pt-6">
                <div class="w-1/2">
                    </div>
                <div class="w-1/2">
            </div>
        </section>
</x-app-layout>