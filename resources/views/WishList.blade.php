<x-profile-layout>
    <h2 class="font-semibold text-3xl font-epilogue">WishList</h2>
    <ul class="mt-5 space-y-4">
        @foreach($listHotel as $hotel)
            <li class="flex items-center rounded-lg px-6 py-8 bg-white shadow-lg">
                <img src="{{ asset($hotel->image) }}" alt="" class="w-20 h-20 rounded-lg">

                <div class="mx-8 pr-8 border-r-2 border-slate-500/50">
                    <p class="font-semibold">{{ $hotel->name }}</p>
                    <p class="mt-1.5 line-clamp-2 max-w-lg">{{ $hotel->description }}</p>
                </div>

                <ul class="grid grid-cols-2 grid-rows-2 gap-y-3 gap-x-6">
                    <li class="flex items-center gap-2 col-span-1 row-span-1">
                        <div class="w-8 h-8 rounded-lg bg-mint-green/20 flex-center">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24"><path fill="rgb(141, 211, 187)" d="M6.5 14h1.55q.2 0 .388-.088t.312-.212l5.6-5.55q.15-.15.15-.375t-.15-.375L12.6 5.65q-.15-.15-.375-.15t-.375.15l-5.55 5.6q-.125.125-.212.313T6 11.95v1.55q0 .2.15.35t.35.15Zm4 0H17q.425 0 .713-.288T18 13q0-.425-.288-.713T17 12h-4.5l-2 2ZM6 18l-2.3 2.3q-.475.475-1.088.213T2 19.575V4q0-.825.588-1.413T4 2h16q.825 0 1.413.588T22 4v12q0 .825-.588 1.413T20 18H6Z"/></svg>
                        </div>
                        <div class="text-sm">
                            <p class="font-semibold text-gray-400">Reviews</p>
                            <span class="font-medium">{{ $hotel->countRating }}</span>
                        </div>
                    </li>
                    <li class="flex items-center gap-2 col-span-1 row-span-1">
                        <div class="w-8 h-8 rounded-lg bg-mint-green/20 flex-center">
                            <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24"><path fill="rgb(141, 211, 187)" d="m5.825 22l1.625-7.025L2 10.25l7.2-.625L12 3l2.8 6.625l7.2.625l-5.45 4.725L18.175 22L12 18.275L5.825 22Z"/></svg>
                        </div>
                        <div class="text-sm">
                            <p class="font-semibold text-gray-400">Stars</p>
                            <span class="font-medium">{{ $hotel->level }}</span>
                        </div>
                    </li>
                    <li class="flex items-center gap-2 col-span-1 row-span-1">
                        <div class="w-8 h-8 rounded-lg bg-mint-green/20 flex-center">
                            <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24"><g fill="rgb(141, 211, 187)"><path fill-rule="evenodd" d="M12 16a7 7 0 1 0 0-14a7 7 0 0 0 0 14Zm0-10c-.284 0-.474.34-.854 1.023l-.098.176c-.108.194-.162.29-.246.354c-.085.064-.19.088-.4.135l-.19.044c-.738.167-1.107.25-1.195.532c-.088.283.164.577.667 1.165l.13.152c.143.167.215.25.247.354c.032.104.021.215 0 .438l-.02.203c-.076.785-.114 1.178.115 1.352c.23.174.576.015 1.267-.303l.178-.082c.197-.09.295-.135.399-.135c.104 0 .202.045.399.135l.178.082c.691.319 1.037.477 1.267.303c.23-.174.191-.567.115-1.352l-.02-.203c-.021-.223-.032-.334 0-.438c.032-.103.104-.187.247-.354l.13-.152c.503-.588.755-.882.667-1.165c-.088-.282-.457-.365-1.195-.532l-.19-.044c-.21-.047-.315-.07-.4-.135c-.084-.064-.138-.16-.246-.354l-.098-.176C12.474 6.34 12.284 6 12 6Z" clip-rule="evenodd"/><path d="M4.495 12.995L2.992 14.55c-.54.56-.81.839-.904 1.076c-.213.54-.03 1.138.433 1.422c.204.124.57.163 1.305.24c.414.044.622.066.795.133c.389.149.69.462.835.864c.064.18.085.394.127.823c.075.76.113 1.14.233 1.351c.274.48.853.669 1.374.448c.228-.096.498-.376 1.039-.935l2.482-2.57a8.508 8.508 0 0 1-6.216-4.408Zm8.795 4.408l2.482 2.57c.54.56.81.839 1.038.936c.521.22 1.1.031 1.374-.449c.12-.21.157-.59.232-1.35c.043-.43.064-.644.128-.824c.144-.402.446-.715.835-.864c.173-.067.38-.088.795-.132c.734-.078 1.101-.117 1.305-.241c.463-.284.646-.883.433-1.422c-.094-.237-.364-.517-.904-1.076l-1.503-1.556a8.508 8.508 0 0 1-6.216 4.408Z"/></g></svg>
                        </div>
                        <div class="text-sm">
                            <p class="font-semibold text-gray-400">Rating</p>
                            <span class="font-medium">{{ $hotel->stars }}</span>
                        </div>
                    </li>
                    <li class="flex items-center gap-2 col-span-1 row-span-1">
                        <div class="w-8 h-8 rounded-lg bg-mint-green/20 flex-center">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24"><g fill="none" stroke="rgb(141, 211, 187)" stroke-width="1.5"><path d="M17.414 10.414C18 9.828 18 8.886 18 7c0-1.886 0-2.828-.586-3.414m0 6.828C16.828 11 15.886 11 14 11h-4c-1.886 0-2.828 0-3.414-.586m10.828 0Zm0-6.828C16.828 3 15.886 3 14 3h-4c-1.886 0-2.828 0-3.414.586m10.828 0Zm-10.828 0C6 4.172 6 5.114 6 7c0 1.886 0 2.828.586 3.414m0-6.828Zm0 6.828ZM13 7a1 1 0 1 1-2 0a1 1 0 0 1 2 0Z"/><path stroke-linecap="round" d="M18 6a3 3 0 0 1-3-3m3 5a3 3 0 0 0-3 3M6 6a3 3 0 0 0 3-3M6 8a3 3 0 0 1 3 3m-4 9.388h2.26c1.01 0 2.033.106 3.016.308a14.85 14.85 0 0 0 5.33.118c.868-.14 1.72-.355 2.492-.727c.696-.337 1.549-.81 2.122-1.341c.572-.53 1.168-1.397 1.59-2.075c.364-.582.188-1.295-.386-1.728a1.887 1.887 0 0 0-2.22 0l-1.807 1.365c-.7.53-1.465 1.017-2.376 1.162c-.11.017-.225.033-.345.047m0 0a8.176 8.176 0 0 1-.11.012m.11-.012a.998.998 0 0 0 .427-.24a1.492 1.492 0 0 0 .126-2.134a1.9 1.9 0 0 0-.45-.367c-2.797-1.669-7.15-.398-9.779 1.467m9.676 1.274a.524.524 0 0 1-.11.012m0 0a9.274 9.274 0 0 1-1.814.004"/><rect width="3" height="8" x="2" y="14" rx="1.5"/></g></svg>
                        </div>
                        <div class="text-sm">
                            <p class="font-semibold text-gray-400">Starting From</p>
                            <span class="font-medium">{{ number_format($hotel->price / 1000, 3) }} VND</span>
                        </div>
                    </li>
                </ul>

                <div class="flex-1 text-right mr-24">
                    <a href="{{ route('hotelsDetail', ['id' => $hotel->id]) }}">
                        <button class="px-4 py-2 border bg-mint-green rounded leading-tight font-medium text-base text-white">
                            >
                        </button>
                    </a>
                </div>
            </li>
        @endforeach
    </ul>
    <div class="mt-4 flex justify-end">
        <div class="demo-inline-spacing">
            <!-- Outline rounded Pagination -->
            <nav aria-label="Page navigation">
                {{ $wishList->render('admin.partials.paging') }}
            </nav>
            <!--/ Outline rounded Pagination -->
        </div>
    </div>
</x-profile-layout>