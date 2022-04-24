<div class="row mt-2 vh-60">
    <div class="col-sm-6 border-end">
        <strong>Onderdelen</strong>
        <div id="sections" class="mt-2">
        </div>
    </div>
    <div class="col-sm-6">
        <strong>Vragen</strong>
        <div id="questions" class="mt-2">

        </div>
    </div>
</div>
<script>
    window.values = {!! json_encode($questionSections) !!};
</script>
<script src="{{ asset('js/sectionAnswers.js') }}"></script>
