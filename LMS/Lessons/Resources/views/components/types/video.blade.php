<div class="row">
    <div class="col-12">
        <form action="">
            @csrf
            <div class="form-group">
                <label for="inputVideo-{{$lesson->id}}" class="btn btn-primary btn-block">Clique aqui pra subir a porra do arquivo</label>
                <input id="inputVideo-{{$lesson->id}}" data-lessonId="{{$lesson->id}}" data-moduleId="{{$lesson->module_id}}" type="file" class="form-control inputUpload" style="border: 1px solid black;">
            </div>
        </form>
        <table class="table table-striped">
            <thead>
                <tr>
                    <td>Nome do Arquivo</td>
                    <td>Tipo</td>
                    <td>Status</td>
                    <td>Data</td>
                </tr>
            </thead>
            <tbody id="lesson-upload-{{$lesson->id}}">
            @if($media = $lesson->getFirstMedia())
                <tr>
                    <td>
                        <img src="{{ $media->getUrl('thumb') }}" class="img-thumbnail">
                        {{ $media->file_name }}
                    </td>
                    <td>{{ $media->mime_type }}</td>
                    <td>{{ $lesson->video['info']['status'] }} {{ $lesson->video['info']['status'] == 'encoding' ? $lesson->video['info']['percent'] . "%" : "" }}</td>
                    <td>{{ $lesson->updated_at->format('Y-m-d H:i:s') }}</td>
                </tr>
            @else
                <tr>
                    <td colspan="4" class="text-center">
                        Aguardando upload
                    </td>
                </tr>
            @endif
            </tbody>
        </table>
    </div>
</div>
