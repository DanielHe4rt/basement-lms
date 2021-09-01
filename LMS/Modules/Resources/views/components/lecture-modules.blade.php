@php
$modulesCount = 1;
$lessonCount = 1;
@endphp

<div id="accordion" role="tablist">
    @foreach($course->modules()->orderBy('order')->get() as $module)
        <div class="card card-collapse">
            <div class="card-header" role="tab" id="heading-{{$module->id}}">
                <h5 class="mb-0">
                    <a data-toggle="collapse" href="#collapse{{ $module->id }}" aria-expanded="true"
                       aria-controls="collapse{{ $module->id }}">
                        {{ $modulesCount++ }} - {{ $module->name }}
                        <i class="material-icons">keyboard_arrow_down</i>
                    </a>
                </h5>
            </div>

            <div id="collapse{{ $module->id }}" class="collapse {{ $module->id == $lesson->module_id ? 'show' : '' }}"
                 role="tabpanel" aria-labelledby="heading-{{$module->id}}" data-parent="#accordion">
                <div class="card-body">
                    <table class="table">
                        <tbody>
                        @foreach($module->lessons as $lesson)
                            <tr class="funcionacaralho" data-url="{{ route('course-lesson',['slug' => $course->slug, 'lesson' => $lesson->id]) }}" style="cursor: pointer;">
                                <td id="lecture-{{ $lesson->id }}">
                                    {{ Auth::user()->watched()->find($lesson) ? "✅" : "❌" }}
                                </td>
                                <td>
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
                                    Aula {{ $lessonCount++ }} - {{ $lesson->title }}
                                </td>
                                <td>
                                    {{ $lesson->duration }}
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    @endforeach
</div>
