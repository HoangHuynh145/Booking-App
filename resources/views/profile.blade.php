<x-profile-layout>
    <h2 class="font-semibold text-3xl font-epilogue">Profiles</h2>
    @include('partials.notification')
    <form action="{{ route('user.update', [$user]) }}" method="POST">
        @csrf
        @method('PATCH')
        <ul class="mt-5 space-y-3.5 bg-white py-6 px-8 rounded-lg divide-y-2 divide-slate-800/20">
            <li class="flex justify-between items-center">
                <div class="flex flex-col">
                    <span class="text-sm text-gray-600 font-semibold">Name</span>
                    <input 
                        type="text"
                        class="p-1.5 mt-1.5 rounded-lg border border-slate-200"
                        value="{{ $user->fullName }}"
                        name="fullName"
                    />
                </div>
                <button type="submit" class="flex-center gap-1 px-4 py-2 border border-mint-green rounded leading-tight font-medium text-black text-sm">
                    <svg xmlns="http://www.w3.org/2000/svg" class="mb-0.5" width="16" height="16" viewBox="0 0 24 24"><path fill="currentColor" d="M5 23.7q-.825 0-1.413-.587T3 21.7v-14q0-.825.588-1.413T5 5.7h8.925L7 12.625V19.7h7.075L21 12.75v8.95q0 .825-.588 1.413T19 23.7H5Zm4-6v-4.25l7.175-7.175l4.275 4.2l-7.2 7.225H9Zm12.875-8.65L17.6 4.85l1.075-1.075q.6-.6 1.438-.6t1.412.6l1.4 1.425q.575.575.575 1.4T22.925 8l-1.05 1.05Z"/></svg>
                    <p class="mt-0.5">Change</p>
                </button>
            </li>
            <li class="flex justify-between items-center pt-3">
                <div class="flex flex-col">
                    <span class="text-sm text-gray-600 font-semibold">Email</span>
                    <input 
                        type="email"
                        class="p-1.5 mt-1.5 rounded-lg border border-slate-200"
                        value="{{ $user->email }}"
                        name="email"
                    />
                </div>
                <button type="submit" class="flex-center gap-1 px-4 py-2 border border-mint-green rounded leading-tight font-medium text-black text-sm">
                    <svg xmlns="http://www.w3.org/2000/svg" class="mb-0.5" width="16" height="16" viewBox="0 0 24 24"><path fill="currentColor" d="M5 23.7q-.825 0-1.413-.587T3 21.7v-14q0-.825.588-1.413T5 5.7h8.925L7 12.625V19.7h7.075L21 12.75v8.95q0 .825-.588 1.413T19 23.7H5Zm4-6v-4.25l7.175-7.175l4.275 4.2l-7.2 7.225H9Zm12.875-8.65L17.6 4.85l1.075-1.075q.6-.6 1.438-.6t1.412.6l1.4 1.425q.575.575.575 1.4T22.925 8l-1.05 1.05Z"/></svg>
                    <p class="mt-0.5">Change</p>
                </button>
            </li>
            <li class="flex justify-between items-center pt-3">
                <div class="flex flex-col gap-2">
                    <div class="flex items-center gap-3.5">
                        <span class="text-sm text-gray-600 font-semibold">Current Password</span>
                        <input 
                            type="password"
                            class="p-1.5 mt-1.5 rounded-lg border border-slate-200"
                            name="password"
                        />
                    </div>
                    <div class="flex items-center gap-3.5">
                        <span class="text-sm text-gray-600 font-semibold">New Password</span>
                        <input 
                            type="password"
                            class="p-1.5 mt-1.5 rounded-lg border border-slate-200"
                            value=""
                            name="newPassword"
                        />
                    </div>
                </div>
                <button type="submit" class="flex-center gap-1 px-4 py-2 border border-mint-green rounded leading-tight font-medium text-black text-sm">
                    <svg xmlns="http://www.w3.org/2000/svg" class="mb-0.5" width="16" height="16" viewBox="0 0 24 24"><path fill="currentColor" d="M5 23.7q-.825 0-1.413-.587T3 21.7v-14q0-.825.588-1.413T5 5.7h8.925L7 12.625V19.7h7.075L21 12.75v8.95q0 .825-.588 1.413T19 23.7H5Zm4-6v-4.25l7.175-7.175l4.275 4.2l-7.2 7.225H9Zm12.875-8.65L17.6 4.85l1.075-1.075q.6-.6 1.438-.6t1.412.6l1.4 1.425q.575.575.575 1.4T22.925 8l-1.05 1.05Z"/></svg>
                    <p class="mt-0.5">Change</p>
                </button>
            </li>
            <li class="flex justify-between items-center pt-3">
                <div class="flex flex-col">
                    <span class="text-sm text-gray-600 font-semibold">Phone number</span>
                    <input 
                        type="number"
                        class="p-1.5 mt-1.5 rounded-lg border border-slate-200"
                        value="{{ $user->phone }}"
                        name="phone"
                    />
                </div>
                <button type="submit" class="flex-center gap-1 px-4 py-2 border border-mint-green rounded leading-tight font-medium text-black text-sm">
                    <svg xmlns="http://www.w3.org/2000/svg" class="mb-0.5" width="16" height="16" viewBox="0 0 24 24"><path fill="currentColor" d="M5 23.7q-.825 0-1.413-.587T3 21.7v-14q0-.825.588-1.413T5 5.7h8.925L7 12.625V19.7h7.075L21 12.75v8.95q0 .825-.588 1.413T19 23.7H5Zm4-6v-4.25l7.175-7.175l4.275 4.2l-7.2 7.225H9Zm12.875-8.65L17.6 4.85l1.075-1.075q.6-.6 1.438-.6t1.412.6l1.4 1.425q.575.575.575 1.4T22.925 8l-1.05 1.05Z"/></svg>
                    <p class="mt-0.5">Change</p>
                </button>
            </li>
        </ul>
    </form>
</x-profile-layout>