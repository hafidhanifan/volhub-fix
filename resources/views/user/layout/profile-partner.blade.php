@include('user.layout.templates.header')
@include('user.layout.templates.navbar')
<section class="mt-20 md:flex md:pt-4 gap-4 flex-wrap justify-center">
    <!-- Mitra Card -->
    <?php $no = 1 ?>
    @foreach($mitra as $mitra)
    <a href="" class="block p-2 border-b hover:bg-gray-100 cursor-pointer md:w-5/12 md:border lg:w-1/4">
        <div class="flex items-center gap-2 px-2">
            @if(!empty($mitra->logo))
            <img src="{{ asset('storage/foto-profile/'.$mitra->logo)}}" alt=""
                class="w-14 h-14 object-cover rounded-full" />
            @else
            <img class="h-14 w-14 object-cover rounded-full" src="{{asset('img/default-profile.png')}}" alt="Avatar" />
            @endif
            <div>
                <p class="font-semibold">{{$mitra->nama_mitra}}</p>
                @if(!empty($mitra->alamat))
                <p class="text-gray-500 text-sm">{{ $mitra->alamat }}</p>
                @else
                <p class="text-gray-500 text-sm">Employer has not entered the data</p>
                @endif
            </div>
        </div>
        <div class="flex flex-col px-4 mt-4">
            <div class="flex items-end gap-2">
                <svg class="w-6 fill-slate-500" fill="#000000" viewBox="0 -4.91 122.88 122.88" version="1.1"
                    id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                    style="enable-background: new 0 0 122.88 113.05" xml:space="preserve">
                    <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                    <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                    <g id="SVGRepo_iconCarrier">
                        <style type="text/css">
                            .st0 {
                                fill-rule: evenodd;
                                clip-rule: evenodd;
                            }
                        </style>
                        <g>
                            <path class="st0"
                                d="M0,100.07h14.72V1.57c0-0.86,0.71-1.57,1.57-1.57h49.86c0.86,0,1.57,0.71,1.57,1.57V38.5h44.12 c0.86,0,1.57,0.71,1.57,1.57v59.99h9.47v12.99H0V100.07L0,100.07z M27.32,14.82h10.2c0.31,0,0.57,0.26,0.57,0.57v12.36 c0,0.31-0.26,0.57-0.57,0.57h-10.2c-0.31,0-0.57-0.26-0.57-0.57V15.39C26.75,15.08,27.01,14.82,27.32,14.82L27.32,14.82z M44.6,76.3h10.2c0.31,0,0.57,0.26,0.57,0.57v12.36c0,0.31-0.26,0.57-0.57,0.57H44.6c-0.31,0-0.57-0.26-0.57-0.57V76.87 C44.03,76.55,44.29,76.3,44.6,76.3L44.6,76.3z M27.32,76.3h10.2c0.31,0,0.57,0.26,0.57,0.57v12.36c0,0.31-0.26,0.57-0.57,0.57 h-10.2c-0.31,0-0.57-0.26-0.57-0.57V76.87C26.75,76.55,27.01,76.3,27.32,76.3L27.32,76.3z M44.6,55.8h10.2 c0.31,0,0.57,0.26,0.57,0.57v12.36c0,0.31-0.26,0.57-0.57,0.57H44.6c-0.31,0-0.57-0.26-0.57-0.57V56.38 C44.03,56.06,44.29,55.8,44.6,55.8L44.6,55.8z M27.32,55.8h10.2c0.31,0,0.57,0.26,0.57,0.57v12.36c0,0.31-0.26,0.57-0.57,0.57 h-10.2c-0.31,0-0.57-0.26-0.57-0.57V56.38C26.75,56.06,27.01,55.8,27.32,55.8L27.32,55.8z M44.6,35.31h10.2 c0.31,0,0.57,0.26,0.57,0.57v12.36c0,0.31-0.26,0.57-0.57,0.57H44.6c-0.31,0-0.57-0.26-0.57-0.57V35.88 C44.03,35.57,44.29,35.31,44.6,35.31L44.6,35.31z M27.32,35.31h10.2c0.31,0,0.57,0.26,0.57,0.57v12.36c0,0.31-0.26,0.57-0.57,0.57 h-10.2c-0.31,0-0.57-0.26-0.57-0.57V35.88C26.75,35.57,27.01,35.31,27.32,35.31L27.32,35.31z M44.6,14.82h10.2 c0.31,0,0.57,0.26,0.57,0.57v12.36c0,0.31-0.26,0.57-0.57,0.57H44.6c-0.31,0-0.57-0.26-0.57-0.57V15.39 C44.03,15.08,44.29,14.82,44.6,14.82L44.6,14.82z M23.17,7.32h35.92c0.62,0,1.13,0.61,1.13,1.35v85.87c0,0.74-0.51,1.35-1.13,1.35 H23.17c-0.62,0-1.13-0.61-1.13-1.35V8.67C22.04,7.93,22.55,7.32,23.17,7.32L23.17,7.32z M72.61,53.43h10.2 c0.31,0,0.57,0.26,0.57,0.57v12.36c0,0.31-0.26,0.57-0.57,0.57h-10.2c-0.31,0-0.57-0.26-0.57-0.57V54 C72.04,53.69,72.3,53.43,72.61,53.43L72.61,53.43z M89.89,76.3h10.2c0.31,0,0.57,0.26,0.57,0.57v12.36c0,0.31-0.26,0.57-0.57,0.57 h-10.2c-0.31,0-0.57-0.26-0.57-0.57V76.87C89.32,76.55,89.58,76.3,89.89,76.3L89.89,76.3z M72.61,76.3h10.2 c0.31,0,0.57,0.26,0.57,0.57v12.36c0,0.31-0.26,0.57-0.57,0.57h-10.2c-0.31,0-0.57-0.26-0.57-0.57V76.87 C72.04,76.55,72.3,76.3,72.61,76.3L72.61,76.3z M89.89,53.43h10.2c0.31,0,0.57,0.26,0.57,0.57v12.36c0,0.31-0.26,0.57-0.57,0.57 h-10.2c-0.31,0-0.57-0.26-0.57-0.57V54C89.32,53.69,89.58,53.43,89.89,53.43L89.89,53.43z M68.86,45.82h35.92 c0.62,0,1.13,0.61,1.13,1.35v47.37c0,0.74-0.51,1.35-1.13,1.35H68.86c-0.62,0-1.13-0.61-1.13-1.35V47.17 C67.73,46.43,68.24,45.82,68.86,45.82L68.86,45.82z">
                            </path>
                        </g>
                    </g>
                </svg>
                <span class="block leading-none">Automotive</span>
            </div>
            <div class="flex items-end gap-2">
                <svg class="w-6 fill-slate-500" fill="#000000" viewBox="0 0 32 32" version="1.1"
                    xmlns="http://www.w3.org/2000/svg">
                    <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                    <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                    <g id="SVGRepo_iconCarrier">
                        <title>suitcase1</title>
                        <path
                            d="M27 29h-23c-1.105 0-2-0.896-2-2v-12c0 0 5.221 2.685 10 3.784v1.216c0 0.553 0.447 1 1 1h5c0.552 0 1-0.447 1-1v-1.216c4.778-1.099 10-3.784 10-3.784v12c0 1.104-0.896 2-2 2zM17 17c0.552 0 1 0.447 1 1v1c0 0.553-0.448 1-1 1h-3c-0.553 0-1-0.447-1-1v-1c0-0.553 0.447-1 1-1h3zM19 17c0-0.553-0.448-1-1-1h-5c-0.553 0-1 0.447-1 1v0.896c-4.779-1.132-10-3.896-10-3.896v-4c0-1.104 0.895-2 2-2h6v-2c0-1.104 0.896-2 2-2h7c1.104 0 2 0.896 2 2v2h6c1.104 0 2 0.896 2 2v4c0 0-5.222 2.764-10 3.896v-0.896zM19 7c0-0.553-0.448-1-1-1h-5c-0.553 0-1 0.447-1 1 0 0.552 0 1 0 1h7c0 0 0-0.448 0-1z">
                        </path>
                    </g>
                </svg>
                <span class="block leading-none">9 Lowongan</span>
            </div>
        </div>
    </a>
    @endforeach
</section>