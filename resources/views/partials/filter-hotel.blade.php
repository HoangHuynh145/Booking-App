<div>
    <h2 class="font-medium text-lg">Filter</h2>
    <ul class="space-y-8 mt-8">
        <li>
            <h3 class="mb-1.5">Price</h3>
            <div class="flex items-center">
                <input 
                    type="text" 
                    placeholder="đ Từ" 
                    name="minPrice" 
                    class="flex-1 h-8 w-28 border border-slate-600 px-1.5 rounded-md" 
                    value="{{$minPrice ? $minPrice : ''}}"
                />
                <div class="h-px bg-gray-600 w-2.5 mx-3"></div>
                <input 
                    type="text" 
                    placeholder="đ Đến" 
                    name="maxPrice" 
                    class="flex-1 h-8 w-28 border border-slate-600 px-1.5 rounded-md"
                    value="{{$maxPrice ? $maxPrice : ''}}"
                />
            </div>
        </li>

        <li>
            <h3 class="mb-1.5">Rating</h3>
            <ul class="flex gap-4 rating">
                @for($i = 0; $i < 5; $i++)
                    <li onclick="handleSelecteRating(event, '{{$i}}')">
                        <label 
                            for="rating{{$i}}" 
                            class="customInput {{ $i == $rating ? 'active' : '' }}"
                        >
                            {{$i}}+
                        </label>    
                        <input 
                            type="radio" 
                            name="rating" 
                            id="rating{{$i}}" 
                            value="{{$i}}" 
                            hidden
                            @if($rating == $i) checked @endif
                        />
                    </li>
                @endfor
            </ul>
        </li>

        <li>
            <h3 class="mb-1.5">Star</h3>
            <ul class="flex gap-4 star">
                @for($i = 1; $i <= 5; $i++)
                    <li onclick="handleSelecteStar(event, '{{$i}}')">
                        <label 
                            for="star{{$i}}" 
                            class="customInput {{ $i == $star ? 'active' : '' }}"
                        >
                            @if($i == 5)
                                {{$i}}
                            @else
                                {{$i}}+
                            @endif
                        </label>    
                        <input 
                            type="radio" 
                            name="star" 
                            id="star{{$i}}" 
                            value="{{$i}}"
                            @if($star == $i) checked @endif 
                            hidden
                        />

                    </li>
                @endfor
            </ul>
        </li>

        <li class="border-t border-slate-600/50">
            <button type="submit" class="mt-4 w-full bg-mint-green rounded-lg font-medium h-12">
                Search
            </button>
        </li>
    </ul>
</div>

<script>
    const handleSelecteRating = (e, index) => {
        const activeItem = document.querySelector('.rating .customInput.active')
        const labelElement = document.querySelector(`label[for="rating${index}"]`)
        activeItem.classList.remove('active')
        labelElement.classList.add('active')
    }

    const handleSelecteStar = (e, index) => {
        const activeItem = document.querySelector('.star .customInput.active')
        const labelElement = document.querySelector(`label[for="star${index}"]`)
        activeItem.classList.remove('active')
        labelElement.classList.add('active')
    }

</script>