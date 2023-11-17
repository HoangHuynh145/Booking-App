
@if(Session::has('success'))
    <div class="fixed top-[20%] right-10 z-40 bg-white rounded-lg" id="popup-success">
        <div class="p-5 border border-green-400 bg-green-400/20 rounded-lg">
            <p class="absolute top-0 right-2 text-xl cursor-pointer" onclick="handleClosePopupSuccess()">&times;</p>
            <p> {{ Session::get('success') }}</p>
        </div>
    </div>
@elseif (Session::has('error'))
    <div class="fixed top-[20%] right-10 z-40 bg-white rounded-lg" id="popup-error">
        <div class="p-5 border border-red-700 bg-red-400/20 rounded-lg">
            <p class="absolute top-0 right-2 text-xl cursor-pointer" onclick="handleClosePopupError()">&times;</p>
            <p> {{ Session::get('error') }}</p>
        </div>
    </div>
@endif


<script>
    const popupError = document.getElementById("popup-error")
    const popupSuccess = document.getElementById("popup-success")
    
    const timeErrorId = setTimeout(() => {
        popupError.classList.add('hidden')
    }, 2500);

    const timeSuccessId = setTimeout(() => {
        popupSuccess.classList.add('hidden')
    }, 2500);
    

    const handleClosePopupError = () => {
        popupError.classList.add('hidden');
        clearTimeout(timeId)
    }

    const handleClosePopupSuccess = () => {
        popupError.classList.add('hidden');
        clearTimeout(timeId)
    }

</script>