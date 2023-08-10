<div  x-data="{ focused:false,
         init() {
                    $wire.on('createComment', () => {
                    console.log('createComment')
                    this.focused = false;
                })
            }
                              

}" class="mb-4">
    <div>
        {{$comment}}
    <textarea wire:model="comment" @click="focused=true" class="block w-full rounded-md border-0 px-3.5 py-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6 " :rows="focused ?'4':'1'" placeholder="Leave a comment">

    </textarea>
    </div>
    <div :class="focused ? '' :'hidden'">
    <button wire:click="createComment" type="submit"
                    class="rounded-md bg-indigo-600 px-3.5 py-2.5 text-center text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">
                Submit
            </button>
    <button type="button" @click="focused=false" class="">
        cancel
    </button>
    </div>
</div>
