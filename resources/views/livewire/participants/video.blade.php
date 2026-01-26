<div>
    <p class="font-bold text-center text-md">Vous n'avez pas de video</p>

    <form class="mt-5">

        <input class="simple-file-upload" type="hidden" name="video_url" id="video_url" data-accepted="video/*" data-maxFileSize="50">

    </form>
</div>

<script>

    const el = document.getElementById('video_url')

    el.addEventListener("fileUploadSuccess", function (e){
        Livewire.emit('addVideo', this.value)
    })

</script>