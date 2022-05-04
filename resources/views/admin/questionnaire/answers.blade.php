<div class="row mt-2 vh-60">
    <div class="col-sm-4 border-end">
        <strong>Onderdelen</strong>
        <div id="sections" class="mt-2">
            @if(count($results) == 0)
                <span>Geen onderdelen</span>
            @endif
        </div>
    </div>
    <div class="col-sm-4 border-end">
        <strong>Vragen</strong>
        <div id="questions" class="mt-2">
            <span id="noQuestions" hidden>Geen vragen</span>
        </div>
    </div>
    <div class="col-sm-4">
        <strong>Participanten</strong>
        <div id="answers" class="mt-2">
            <span id="noAnswers" hidden>Geen participanten</span>
        </div>
    </div>
</div>
<script>
    window.url = window.location.origin + '{!! "/researches/$research->id/questionnaires/$questionnaire->id/sections" !!}';
    window.values = {!! json_encode($results) !!};
</script>
<script src="{{ asset('js/sectionAnswers.js') }}"></script>
