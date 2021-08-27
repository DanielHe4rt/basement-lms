<div class="row justify-content-center">
    <div class="col-12 col-md-10">
        <div id="accordion" role="tablist" >
            @forelse($module->lessons()->orderBy('created_at')->get() as $key => $lesson)
                <div class="card-collapse">
                    <div class="card-header" role="tab" id="headingOne">
                        <h5 class="mb-0">
                            <a data-toggle="collapse" href="#collapse-{{ $lesson->id }}" aria-expanded="false"
                               aria-controls="collapseOne"
                               class="collapsed">
                                @switch($lesson->type_id)
                                    @case($video = 1)
                                        🎥
                                        @break;
                                    @case($article = 2)
                                        📃
                                        @break;
                                    @case($quiz = 3)
                                        🤔
                                        @break;
                                @endswitch
                                 Aula {{ $key + 1 }} - {{ $lesson->title }}
                                <i class="material-icons">keyboard_arrow_down</i>
                            </a>
                        </h5>
                    </div>
                    <div id="collapse-{{ $lesson->id }}" class="collapse" role="tabpanel" aria-labelledby="headingOne"
                         data-parent="#accordion">
                        <div class="card-body">
                            @switch($lesson->type_id)
                                @case($video = 1)
                                    <x-lessons::types.video :lesson="$lesson"/>
                                    @break
                                @case($text = 2)
                                    <x-lessons::types.article :lesson="$lesson"/>
                                    @break
                                @case($quiz = 3)
                                    <x-lessons::types.quiz/>
                                    @break
                            @endswitch
                        </div>
                    </div>
                </div>

            @empty
                Nenhuma aula ainda =/
            @endforelse
                <button class="btn btn-primary btnNewLesson" data-id="{{ $module->id }}">Criar lição</button>
        </div>
    </div>
</div>
