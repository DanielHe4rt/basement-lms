<form class="articleForm"
      action="{{ route('instructor-course-lesson-update', ['course' => $lesson->module->course_id, 'module' => $lesson->module_id, 'lesson' => $lesson]) }}">
    <div id="summernote"></div>
    <button class="btn btn-primary">Salvar Artigo</button>
</form>
